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
        //\Softage\Entities\User::truncate();

        \Softage\Entities\User::create([
            'name' => 'Andrey Fernandes',
            'email' => 'andrey@email.com',
            'password' => bcrypt(123456),
            'remember_token' => str_random(10),
            'active' => 1

        ]);
        
    }
}
