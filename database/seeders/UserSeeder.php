<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items=[
            [ 'userId'=>1,'userRoleId'=>1,'fullName'=>'John Doe','email'=>'admin@vueadmin.com','password'=>Hash::make('abcd1234'),'isActive'=>true,'addedBy'=>1,'isMigrationData'=>true],
            [ 'userId'=>2,'userRoleId'=>2,'fullName'=>'Alex Hales','email'=>'user@vueadmin.com','password'=>Hash::make('abcd1234'),'isActive'=>true,'addedBy'=>1,'isMigrationData'=>true],
        ];

        foreach($items as $item){
            User::create($item);
        }
    }
}
