<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items=[
            ['menuID'=>1,'parentID'=>0,'menuTitle'=>'Menus','url'=>'','isSubMenu'=>1,'sortOrder'=>2,'iconClass'=>'mdi-menu','isActive'=>true,'addedBy'=>1,'isMigrationData'=>true],
            ['menuID'=>2,'parentID'=>1,'menuTitle'=>'All Menu','url'=>'/menu','isSubMenu'=>0,'sortOrder'=>0,'iconClass'=>'','isActive'=>true,'addedBy'=>1,'isMigrationData'=>true],
            ['menuID'=>3,'parentID'=>1,'menuTitle'=>'Menu Group','url'=>'/menu-group','isSubMenu'=>0,'sortOrder'=>0,'iconClass'=>'','isActive'=>true,'addedBy'=>1,'isMigrationData'=>true],
            ['menuID'=>4,'parentID'=>0,'menuTitle'=>'Users','url'=>'','isSubMenu'=>1,'sortOrder'=>3,'iconClass'=>'mdi-account','isActive'=>true,'addedBy'=>1,'isMigrationData'=>true],
            ['menuID'=>5,'parentID'=>4,'menuTitle'=>'All User','url'=>'/users','isSubMenu'=>0,'sortOrder'=>0,'iconClass'=>'','isActive'=>true,'addedBy'=>1,'isMigrationData'=>true],
            ['menuID'=>6,'parentID'=>4,'menuTitle'=>'Roles','url'=>'/user-role','isSubMenu'=>0,'sortOrder'=>0,'iconClass'=>'','isActive'=>true,'addedBy'=>1,'isMigrationData'=>true],
            ['menuID'=>7,'parentID'=>0,'menuTitle'=>'Logs','url'=>'','isSubMenu'=>1,'sortOrder'=>4,'iconClass'=>'mdi-history','isActive'=>true,'addedBy'=>1,'isMigrationData'=>true],
            ['menuID'=>8,'parentID'=>7,'menuTitle'=>'Browsing Log','url'=>'/browse-log','isSubMenu'=>0,'sortOrder'=>0,'iconClass'=>'','isActive'=>true,'addedBy'=>1,'isMigrationData'=>true],
            ['menuID'=>9,'parentID'=>7,'menuTitle'=>'Error Log','url'=>'/error-log','isSubMenu'=>0,'sortOrder'=>0,'iconClass'=>'','isActive'=>true,'addedBy'=>1,'isMigrationData'=>true],
            ['menuID'=>10,'parentID'=>0,'menuTitle'=>'Dashboard','url'=>'/dashboard','isSubMenu'=>0,'sortOrder'=>1,'iconClass'=>'mdi-home','isActive'=>true,'addedBy'=>1,'isMigrationData'=>true],
            ['menuID'=>11,'parentID'=>0,'menuTitle'=>'FAQ','url'=>'/faq','isSubMenu'=>0,'sortOrder'=>5,'iconClass'=>'mdi-frequently-asked-questions','isActive'=>true,'addedBy'=>1,'isMigrationData'=>true],
            ['menuID'=>12,'parentID'=>0,'menuTitle'=>'Contact','url'=>'/contact','isSubMenu'=>0,'sortOrder'=>6,'iconClass'=>'mdi-contacts','isActive'=>true,'addedBy'=>1,'isMigrationData'=>true],
            ['menuID'=>13,'parentID'=>0,'menuTitle'=>'App Settings','url'=>'/settings','isSubMenu'=>0,'sortOrder'=>7,'iconClass'=>'mdi-cog','isActive'=>true,'addedBy'=>1,'isMigrationData'=>true],
        ];

        foreach($items as $item){
            Menu::create($item);
        }
        
    }
}
