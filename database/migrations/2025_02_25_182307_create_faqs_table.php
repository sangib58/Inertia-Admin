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
        Schema::create('faqs', function (Blueprint $table) {
            $table->increments('faqId');
            $table->string('title')->unique();
            $table->string('description');
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
        Schema::dropIfExists('faqs');
    }
};
