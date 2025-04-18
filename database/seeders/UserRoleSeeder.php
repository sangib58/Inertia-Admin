<?php

namespace Database\Seeders;

use App\Models\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items=[
            ['userRoleId'=>1,'roleName'=>'Admin','menuGroupId'=>1,'isActive'=>true,'addedBy'=>1,'isMigrationData'=>true],
            ['userRoleId'=>2,'roleName'=>'User','menuGroupId'=>2,'isActive'=>true,'addedBy'=>1,'isMigrationData'=>true]
        ];

        foreach($items as $item){
            UserRole::create($item);
        }
    }
}
