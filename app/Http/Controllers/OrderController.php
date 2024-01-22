<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Repository\CartRepository;
use App\Repository\OrderItemRepository;
use App\Repository\OrderRepository;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $order = new OrderRepository();
        $orders = $order->getOrderUser(auth()->user()->id);
        // show orders user login
        return view('order.index', ['orders' => $orders]);
    }

    public function store(Request $request)
    {
        $order = new OrderRepository();
        $order->create();

        return redirect()->back();
    }

    public function show($order_id)
    {
        $orderItemRep = new OrderItemRepository();
        $orderItem = $orderItemRep->getOrderIDItem($order_id);
        // show order item user
        return view('order.show', ['orderItem' => $orderItem]);
    }

    public function destroy(Order $order)
    {
        //
    }
}
