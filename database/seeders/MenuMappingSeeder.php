<?php

namespace Database\Seeders;

use App\Models\MenuMapping;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuMappingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items=[
            ['menuGroupWiseMenuMappingId'=>1,'menuGroupId'=>1,'menuId'=>2,'isActive'=>true,'addedBy'=>1,'isMigrationData'=>true],
            ['menuGroupWiseMenuMappingId'=>2,'menuGroupId'=>1,'menuId'=>3,'isActive'=>true,'addedBy'=>1,'isMigrationData'=>true],
            ['menuGroupWiseMenuMappingId'=>3,'menuGroupId'=>1,'menuId'=>5,'isActive'=>true,'addedBy'=>1,'isMigrationData'=>true],
            ['menuGroupWiseMenuMappingId'=>4,'menuGroupId'=>1,'menuId'=>6,'isActive'=>true,'addedBy'=>1,'isMigrationData'=>true],
            ['menuGroupWiseMenuMappingId'=>5,'menuGroupId'=>1,'menuId'=>8,'isActive'=>true,'addedBy'=>1,'isMigrationData'=>true],
            ['menuGroupWiseMenuMappingId'=>6,'menuGroupId'=>1,'menuId'=>9,'isActive'=>true,'addedBy'=>1,'isMigrationData'=>true],
            ['menuGroupWiseMenuMappingId'=>7,'menuGroupId'=>1,'menuId'=>10,'isActive'=>true,'addedBy'=>1,'isMigrationData'=>true],
            ['menuGroupWiseMenuMappingId'=>8,'menuGroupId'=>1,'menuId'=>11,'isActive'=>true,'addedBy'=>1,'isMigrationData'=>true],
            ['menuGroupWiseMenuMappingId'=>9,'menuGroupId'=>1,'menuId'=>12,'isActive'=>true,'addedBy'=>1,'isMigrationData'=>true],
            ['menuGroupWiseMenuMappingId'=>10,'menuGroupId'=>1,'menuId'=>13,'isActive'=>true,'addedBy'=>1,'isMigrationData'=>true],
            ['menuGroupWiseMenuMappingId'=>11,'menuGroupId'=>2,'menuId'=>10,'isActive'=>true,'addedBy'=>1,'isMigrationData'=>true],
        ];

        foreach($items as $item){
            MenuMapping::create($item);
        }
    }
}
