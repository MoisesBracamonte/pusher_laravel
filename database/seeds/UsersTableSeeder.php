<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Moises Rodriguez',
            'email' => 'moisesrob@gmail.com',
            'password' => bcrypt('123456'),
            'image_perfil' => 'http://lorempixel.com/grey/400/400/cats/Faker/'
        ]);
        User::create([
            'name' => 'Yexabeis la cruz',
            'email' => 'yexa@gmail.com',
            'password' => bcrypt('123456'),
            'image_perfil' => 'http://lorempixel.com/grey/400/400/cats/Faker/'
        ]);
        User::create([
            'name' => 'Genesis Gil',
            'email' => 'gene@gmail.com',
            'password' => bcrypt('123456'),
            'image_perfil' => 'http://lorempixel.com/grey/400/400/cats/Faker/'
        ]);
    }
}
