<?php

namespace App\Repository;

use App\Models\Order;
use App\Models\OrderItem;

class OrderRepository
{
    public function quickRandom($length = 16)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }

    public function create(){
        // Order data
        $order_id = $this->quickRandom();
        $delivery_fee = 10000;
        // User data
        $userRepository = new UserRepository();
        $user = $userRepository->getUserById(auth()->user()->id);
        // Cart data
        $cartRepository = new CartRepository();
        $sub_total_cart = $cartRepository->subTotalCartUserId($user->id);
        $cart = $cartRepository->getCartItemUser($user->id);
        // Order Item data
        $orderItemRepository = new OrderItemRepository();

        // Insert to orders
        $data_order = [
            'order_id' => $order_id,
            'user_id' => $user->id,
            'delivery_address' => $user->delivery_address,
            'sub_total' => $sub_total_cart,
            'delivery_fee' => $delivery_fee,
            'total' => $delivery_fee + $sub_total_cart,
            'order_status' => 'waiting_payment',
            'payment_status' => 'waiting_payment',
        ];
        Order::create($data_order);

        // Insert to order_item
        foreach ($cart as $item){
            $orderItemRepository->create([
                "product_id" => $item->product_id,
                "product_name"=> $item->product_name,
                "product_price"=> $item->product_price,
                "qty"=> $item->qty,
                "user_id"=> $item->user_id,
                "order_id"=> $order_id
            ]);
        }

        // Delete Cart User
        $cartRepository->removeCartUser($user->id);
    }

    public function getOrderUser($user_id){
        $data = Order::where('user_id', '=', $user_id)->get();

        return $data;
    }
}
