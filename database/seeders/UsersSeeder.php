<?php

namespace Database\Seeders;

use App\Repository\UserRepository;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $userRepository = new UserRepository();

        $userRepository->create([
            'name' => 'Zufar',
            'email' => 'muhamad.zufar2@gmail.com',
            'password' => '123123123',
            'level' => 'customer',
            'delivery_address' => 'Betokan Tirtoadi Mlati Sleman Yogyakarta',
            'remember_token' => Str::random(32),
        ]);

        $userRepository->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => '123123123',
            'level' => 'admin',
            'delivery_address' => 'Betokan Tirtoadi Mlati Sleman Yogyakarta',
            'remember_token' => Str::random(32),
        ]);
    }
}
