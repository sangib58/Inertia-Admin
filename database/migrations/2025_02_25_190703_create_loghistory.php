<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('loghistory', function (Blueprint $table) {
            $table->bigIncrements('logId');
            $table->string('logCode');
            $table->timestamp('logDate');
            $table->integer('userId');
            $table->timestamp('logInTime');
            $table->timestamp('logOutTime')->nullable();
            $table->string('ip')->nullable();
            $table->string('browser')->nullable();
            $table->string('browserVersion')->nullable();
            $table->string('platform')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loghistory');
    }
};
