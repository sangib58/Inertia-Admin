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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('userId');
            $table->integer('userRoleId');
            $table->string('fullName');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('mobile')->nullable();
            $table->string('dateOfBirth')->nullable();
            $table->string('imagePath')->nullable();
            $table->string('forgetPasswordRef')->nullable();
            $table->boolean('isActive')->default(true);
            $table->integer('addedBy');
            $table->timestamp('dateAdded')->default(now());
            $table->integer('lastUpdatedBy')->nullable();
            $table->timestamp('lastUpdatedDate')->nullable();
            $table->boolean('isMigrationData')->default(false);           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
