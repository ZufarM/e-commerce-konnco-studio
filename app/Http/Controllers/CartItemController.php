<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Repository\CartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addToCart(Request $request)
    {
        $cartRepository = new CartRepository();
        $item = $cartRepository->firstCartItemProductUser($request->id, auth()->user()->id);
        if($item){
            $item->qty += 1;
            $item->save();
        }
        else{
            $cartRepository->create([
                'product_id' => $request->id,
                'product_name' => $request->name,
                'product_price' => $request->price,
                'qty' => $request->quantity,
                'user_id' => auth()->user()->id
            ]);
        }

        return redirect()->back();
    }

    public function removeCart($id)
    {
        $cartRepository = new CartRepository();
        $cartRepository->removeCartItemId($id);

        return redirect()->back();
    }
}
