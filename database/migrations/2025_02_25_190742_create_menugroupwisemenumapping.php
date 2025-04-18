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
        Schema::create('menugroupwisemenumapping', function (Blueprint $table) {
            $table->increments('menuGroupWiseMenuMappingId');
            $table->integer('menuGroupId');
            $table->integer('menuId');
            $table->boolean('isActive')->default(true);
            $table->integer('addedBy');
            $table->integer('lastUpdatedBy')->nullable();
            $table->boolean('isMigrationData')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menugroupwisemenumapping');
    }
};
