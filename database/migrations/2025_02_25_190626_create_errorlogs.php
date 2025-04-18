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
        Schema::create('errorlogs', function (Blueprint $table) {
            $table->increments('errorLogId');
            $table->string('status');
            $table->string('statusText');
            $table->string('url');
            $table->text('message');
            $table->integer('addedBy')->nullable();
            $table->timestamp('dateAdded');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('errorlogs');
    }
};
