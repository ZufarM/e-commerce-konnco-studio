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
            'name' => 'Pensil Mekanik',
            'description' => 'Pensil isi ulang ukuran 0.5',
            'stock' => 100,
            'price' => 5000,
        ]);
        $productsRepository->create([
            'name' => 'Isi Pensil Mekanik',
            'description' => 'Isi ulang pensil mekanik ukuran 0.5',
            'stock' => 100,
            'price' => 5000,
        ]);
        $productsRepository->create([
            'name' => 'Buku Catatan',
            'description' => 'Buku catatan bergaris ukuran A5',
            'stock' => 100,
            'price' => 10000,
        ]);
    }
}
