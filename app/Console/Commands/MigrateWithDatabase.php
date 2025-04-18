<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class MigrateWithDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:migrate-with-database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the database if it does not exist and run migrations';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get DB config from .env
        $database = Config::get('database.connections.mysql.database');
        $username = Config::get('database.connections.mysql.username');
        $password = Config::get('database.connections.mysql.password');
        $host = Config::get('database.connections.mysql.host');

        // Temporarily switch to the 'mysql' database to create the target database
        Config::set('database.connections.mysql.database', null);
        DB::purge('mysql');

        try {
            DB::statement("CREATE DATABASE IF NOT EXISTS `$database`");
            $this->info("Database '$database' created or already exists.");

            // Restore the target database connection
            Config::set('database.connections.mysql.database', $database);
            DB::purge('mysql');

            // Run migrations
            $this->call('migrate',['--seed' => true]);

        } catch (\Exception $e) {
            $this->error("Failed to create database: " . $e->getMessage());
        }
    }
}
