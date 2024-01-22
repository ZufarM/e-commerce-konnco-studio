<?php

namespace App\Repository;

use App\Models\Product;

class ProductsRepository
{
    public function create($data)
    {
        return Product::create($data);
    }
}
