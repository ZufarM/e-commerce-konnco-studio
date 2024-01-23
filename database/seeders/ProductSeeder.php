<?php

namespace Database\Seeders;

use App\Repository\ProductsRepository;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productsRepository = new ProductsRepository();

        $productsRepository->create([
            'name' => 'Fender Stratocaster',
            'description' => 'The American Professional II Stratocaster® draws from more than sixty years of innovation, inspiration and evolution to meet the demands of todays working player.',
            'stock' => 100,
            'price' => 20000000,
        ]);
        $productsRepository->create([
            'name' => 'Fender Telecaster',
            'description' => 'Fusing classic Fender® design with player-centric features and exciting new finishes,
            the Player Plus Telecaster® delivers superb playability and unmistakable style.
            Powered by a set of Player Plus Noiseless™ pickups, the Player Plus Tele® delivers warm,
            sweet Tele® twang without hum. A push-pull switch on the tone control engages both
            pickups in series operation, delivering increased output and body.',
            'stock' => 100,
            'price' => 15000000,
        ]);
        $productsRepository->create([
            'name' => 'Jazzmaster',
            'description' => 'The American Professional II Stratocaster® draws from more than sixty years of innovation, inspiration and evolution to meet the demands of todays working player.',
            'stock' => 100,
            'price' => 25000000,
        ]);
    }
}
