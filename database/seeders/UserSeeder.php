<?php

namespace Database\Seeders;

use App\Models\User;
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
        User::create([
            'name' =>'Diego Jimenez',
            'email'=>'andres96jimenez@gmail.com',
            'password'=>bcrypt('12345')
        ])->assignRole('admin');
        User::create([
            'name' =>'Mariana Ponce',
            'email'=>'mariana96jimenez@gmail.com',
            'password'=>bcrypt('12345')
        ])->assignRole('vendedor');
    }
}
