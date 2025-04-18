<?php

namespace Database\Seeders;

use App\Models\MenuGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items=[
            ['menuGroupID'=>1,'menuGroupName'=>'Super Admin Group','isActive'=>true,'addedBy'=>1,'isMigrationData'=>true],
            ['menuGroupID'=>2,'menuGroupName'=>'User Group','isActive'=>true,'addedBy'=>1,'isMigrationData'=>true]
        ];
        foreach($items as $item){
            MenuGroup::create($item);
        }
    }
}
