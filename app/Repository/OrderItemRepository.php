<?php

namespace App\Repository;

use App\Models\Order;
use App\Models\OrderItem;

class OrderItemRepository
{
    public function create($data){

        return OrderItem::create($data);
    }

    public function getOrderIDItem($order_id)
    {
        $data = OrderItem::where('order_id', '=', $order_id)->get();

        return $data;
    }
}
