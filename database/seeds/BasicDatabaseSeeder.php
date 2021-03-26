<?php

use Illuminate\Database\Seeder;

class BasicDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        App\Category::create([
            'categoryName'=>'Online Shop',
        	'categoryStatus'=>'1',
        	'categoryType'=>'1',
        ]);

        echo "All Database Seeded Successfully!";
    }
}