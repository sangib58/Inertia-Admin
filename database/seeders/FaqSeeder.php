<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items=[
            ['faqId'=>1,'title'=>'What are the purposes of this app?','description'=>'Vue Admin is a single page admin template developed by Vue with Laravel 12 API. It’s covered most common features that you need to start a project.','isActive'=>true,'addedBy'=>1,'isMigrationData'=>true],
            ['faqId'=>2,'title'=>'Why this app differs from others?','description'=>'The most amazing part of this template is, you have four popular Relational database connectivity options here. You have flexibility to choose Sql server, Mysql, Sqlite and PostgreSql.','isActive'=>true,'addedBy'=>1,'isMigrationData'=>true],
        ];
        foreach($items as $item){
            Faq::create($item);
        }
    }
}
