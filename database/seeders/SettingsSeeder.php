<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Settings::create([
            'siteSettingsId'=>1,
            'siteTitle'=>'Vue Admin',
            'welComeMessage'=>'Hello there,Sign in to start your task!',
            'copyRightText'=>'© 2025 Copyright Vue Admin',
            'defaultEmail'=>'',
            'password'=>'',
            'host'=>'smtp.gmail.com',
            'port'=>587,
            'logoPath'=>'',
            'faviconPath'=>'',
            'appBarColor'=>'',
            'headerColor'=>'',
            'footerColor'=>'',
            'bodyColor'=>'',
            'allowWelcomeEmail'=>true,
            'allowFaq'=>true,
            'allowRightClick'=>true,                    
            'homeHeader1'=>"Lorem ipsum dolor sit amet !",
            'homeDetail1'=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
            'homePicture'=>"",
            'homeHeader2'=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam",
            'homeDetail2'=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
            'homeBox1Header'=>"Lorem ipsum",
            'homeBox1Detail'=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
            'homeBox2Header'=>"Lorem ipsum",
            'homeBox2Detail'=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
            'homeBox3Header'=>"Lorem ipsum",
            'homeBox3Detail'=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
            'homeBox4Header'=>"Lorem ipsum",
            'homeBox4Detail'=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
            'feature1Header'=>"Lorem ipsum",
            'feature1Detail'=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
            'feature1Picture'=>"",
            'feature2Header'=>"Lorem ipsum",
            'feature2Detail'=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
            'feature2Picture'=>"",
            'feature3Header'=>"Lorem ipsum",
            'feature3Detail'=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
            'feature3Picture'=>"",
            'feature4Header'=>"Lorem ipsum",
            'feature4Detail'=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
            'feature4Picture'=>"",
            'registrationText'=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
            'contactUsText'=>"Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste explicabo commodi quisquam asperiores dolore ad enim provident veniam perferendis voluptate, perspiciatis. ",
            'contactUsTelephone'=>"+xx (xx) xxxxx-xxxx",
            'contactUsEmail'=>"email@email.com",
            'footerText'=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.",
            'footerFacebook'=>"",
            'footerTwitter'=>"",
            'footerLinkedin'=>"",
            'footerInstagram'=>"",
            'forgetPasswordEmailSubject'=>"Forget Password",
            'forgetPasswordEmailHeader'=>"Forget Password Header",
            'forgetPasswordEmailBody'=>"Forget Password Body",
            'welcomeEmailSubject'=>"Welcome",
            'welcomeEmailHeader'=>"Welcome Header",
            'welcomeEmailBody'=>"Welcome Body",
            'version'=>1,
            'isActive'=>true,
            'dateAdded'=>now(),                       
            'addedBy'=>1,                       
            'isMigrationData'=>true
        ]);
    }
}
