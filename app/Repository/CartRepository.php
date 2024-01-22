<?php

namespace App\Repository;

use App\Models\CartItem;

class CartRepository
{
    public function create($data)
    {
        return CartItem::create($data);
    }

    public function getCartItemUser($id_user)
    {
        $data = CartItem::where('user_id', '=', $id_user)->get();

        return $data;
    }

    public function firstCartItemProductUser($id_product, $id_user){
        $data = CartItem::where('product_id', '=', $id_product)
            ->where('user_id', '=', $id_user)
            ->first();

        return $data;
    }

    public function removeCartItemId($id)
    {
        $data = CartItem::find($id);

        return $data->delete();
    }

    public function subTotalCartUserId($user_id)
    {
        $total = 0;
        $data = CartItem::where('user_id', '=', $user_id)->get();
        foreach ($data as $item){
            $total += $item->qty * $item->product_price;
        }
        return $total;
    }

    public function removeCartUser($user_id)
    {
        $data = CartItem::where('user_id', 'like', $user_id)->delete();

        return $data;
    }
}
