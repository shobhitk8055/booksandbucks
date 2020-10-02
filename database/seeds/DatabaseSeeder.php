<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'id'=>1,
            'name'=>'Administrator'
        ]);
        DB::table('currencies')->insert([
            'id'=>1,
            'name'=>'Rupees',
            'code'=>'inr',
            'symbol'=>'₹',
            'conversation_rate'=>1.00,
            'status'=>'ENABLED'
        ]);
        DB::table('categories')->insert([
            'name'=>'book',
            'slug'=>'book',
            'meta_title'=>'book',
            'meta_description'=>'book'
        ]);
        DB::table('genres')->insert(['name'=>'fantasy']);
        DB::table('genres')->insert(['name'=>'drama']);
        // $this->call(UsersTableSeeder::class);
    }
}
