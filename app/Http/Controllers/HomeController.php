<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Repository\CartRepository;
use App\Repository\UserRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $cartItem = null;
        $delivery_address = null;

        if (auth()->user()) {
            $cart = new CartRepository();
            $userRep = new UserRepository();
            $cartItem = $cart->getCartItemUser(auth()->user()->id);
            $user = $userRep->getUserById(auth()->user()->id);
            $delivery_address = $user->delivery_address;
        }
        return view('home', [
            'products' => $products,
            'cart' => $cartItem,
            'delivery_address' => $delivery_address,
        ]);
    }

    public function addDeliveryAddress(Request $request)
    {
        $userRep = new UserRepository();
        $user = $userRep->getUserById(auth()->user()->id);
        $user->delivery_address = $request->delivery_address;
        $user->save();
        return redirect()->back();
    }
}
