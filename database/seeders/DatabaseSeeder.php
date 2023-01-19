<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Faker\Factory as F;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = F::create('lt_LT');
        $time = Carbon::now();
        DB::table('users')->insert([
            'name' => 'Bebras',
            'email' => 'bebras@gmail.com',
            'password' => Hash::make('123'),
            'created_at' => $time,
            'updated_at' => $time,
            'role'=> 1,
        ]);
        DB::table('users')->insert([
            'name' => 'Briedis',
            'email' => 'briedis@gmail.com',
            'password' => Hash::make('123'),
            'created_at' => $time,
            'updated_at' => $time,
            'role'=> 10,
        ]);

    $title = ['GOT', 'Harry pottter', 'Wizards', 'Balta drobule', 'Dievu miskas', 'LOTR', 'Kliudziau', 'MAN', 'Ford', 'WIKI', 'Tesla'];


    foreach(range(1,5) as $_){
        DB::table('goals')->insert([
            'title' => $title[rand(0, count($title)-1)],
            'days' => rand(1, 17),
            'user_id' => 2,
            'done' => rand(1,2),
            'about' => $faker->paragraph(1),
            'created_at' => $time,
            'updated_at' => $time,
        ]);
    }
}
}
