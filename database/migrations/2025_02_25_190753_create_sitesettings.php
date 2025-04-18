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
        Schema::create('sitesettings', function (Blueprint $table) {
            $table->increments('siteSettingsId');
            $table->string('siteTitle')->nullable();
            $table->string('welComeMessage')->nullable();
            $table->string('copyRightText')->nullable();
            $table->string('logoPath')->nullable();
            $table->string('faviconPath')->nullable();
            $table->string('appBarColor')->nullable();
            $table->string('headerColor')->nullable();
            $table->string('footerColor')->nullable();
            $table->string('bodyColor')->nullable();
            $table->boolean('allowWelcomeEmail')->default(true)->nullable();
            $table->boolean('allowFaq')->default(true)->nullable();
            $table->boolean('allowRightClick')->default(true)->nullable();
            $table->string('clientUrl')->nullable();
            $table->string('defaultEmail')->nullable();
            $table->string('displayName')->nullable();
            $table->string('password')->nullable();
            $table->string('host')->nullable();
            $table->integer('port')->nullable();
            $table->integer('version')->nullable();
            $table->text('homeHeader1')->nullable();
            $table->text('homeDetail1')->nullable();
            $table->text('homePicture')->nullable();
            $table->text('homeHeader2')->nullable();
            $table->text('homeDetail2')->nullable();
            $table->text('homeBox1Header')->nullable();
            $table->text('homeBox1Detail')->nullable();
            $table->text('homeBox2Header')->nullable();
            $table->text('homeBox2Detail')->nullable();
            $table->text('homeBox3Header')->nullable();
            $table->text('homeBox3Detail')->nullable();
            $table->text('homeBox4Header')->nullable();
            $table->text('homeBox4Detail')->nullable();
            $table->text('feature1Header')->nullable();
            $table->text('feature1Detail')->nullable();
            $table->text('feature1Picture')->nullable();
            $table->text('feature2Header')->nullable();
            $table->text('feature2Detail')->nullable();
            $table->text('feature2Picture')->nullable();
            $table->text('feature3Header')->nullable();
            $table->text('feature3Detail')->nullable();
            $table->text('feature3Picture')->nullable();
            $table->text('feature4Header')->nullable();
            $table->text('feature4Detail')->nullable();
            $table->text('feature4Picture')->nullable();
            $table->text('registrationText')->nullable();
            $table->text('contactUsText')->nullable();
            $table->text('contactUsTelephone')->nullable();
            $table->text('contactUsEmail')->nullable();
            $table->text('footerText')->nullable();
            $table->text('footerFacebook')->nullable();
            $table->text('footerTwitter')->nullable();
            $table->text('footerLinkedin')->nullable();
            $table->text('footerInstagram')->nullable();
            $table->text('forgetPasswordEmailSubject')->nullable();
            $table->text('forgetPasswordEmailHeader')->nullable();
            $table->text('forgetPasswordEmailBody')->nullable();
            $table->text('welcomeEmailSubject')->nullable();
            $table->text('welcomeEmailHeader')->nullable();
            $table->text('welcomeEmailBody')->nullable();
            $table->boolean('isActive')->default(true);
            $table->integer('addedBy')->nullable();
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
        Schema::dropIfExists('sitesettings');
    }
};
