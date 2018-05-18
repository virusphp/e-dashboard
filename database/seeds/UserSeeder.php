<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\User::create([
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);
        
        App\User::create([
            'name' => 'Operator',
            'email' => 'operator@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'operator'
        ]);
    }
}
