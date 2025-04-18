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
        Schema::create('menu', function (Blueprint $table) {
            $table->increments('menuID');
            $table->integer('parentID');
            $table->string('menuTitle')->unique();
            $table->string('url')->nullable();
            $table->integer('isSubMenu')->nullable();
            $table->integer('sortOrder')->nullable();
            $table->string('iconClass')->nullable();
            $table->boolean('isActive')->default(true);
            $table->integer('addedBy');
            $table->integer('lastUpdatedBy')->nullable();
            $table->boolean('isMigrationData')->default(false);
            $table->timestamp('dateAdded');
            $table->timestamp('lastUpdatedDate')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu');
    }
};
