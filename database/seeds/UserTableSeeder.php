<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Model\User::create([
            'name'=>'Author',
            'email'=>'author@gmail.com',
            'username'=>'author',
            'role'=>'1',
            'role_name'=>'Super user',
            'role_level'=>'1',
            'status'=>'1',
            'password'=>bcrypt('123456'),
        ]);
    }
}
