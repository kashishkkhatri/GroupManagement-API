<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach(range(1,20) as $index){
            // ID are auto-incrementing so have not included in the make.
            DB::table('users')->insert([
                'name'=> $faker->name,
                'email'=>$faker->unique()->safeEmail,
                'password' => Hash::make('password'),
            ]);
        }
    }
}
