<?php

namespace App\Repository;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class OrderRepository
{
    public function generateOrderId()
    {
        $orderId = Str::uuid()->toString();

        return $orderId;
    }

    public function create(){
        // Order data
        $order_id = $this->generateOrderId();
        $delivery_fee = 10000;
        $bank = 'bni';
        // User data
        $userRepository = new UserRepository();
        $user = $userRepository->getUserById(auth()->user()->id);
        // Cart data
        $cartRepository = new CartRepository();
        $sub_total_cart = $cartRepository->subTotalCartUserId($user->id);
        $cart = $cartRepository->getCartItemUser($user->id);
        // Order Item data
        $orderItemRepository = new OrderItemRepository();

        $data_order = [
            'order_id' => $order_id,
            'user_id' => $user->id,
            'delivery_address' => $user->delivery_address,
            'bank' => $bank,
            'sub_total' => $sub_total_cart,
            'delivery_fee' => $delivery_fee,
            'total' => $delivery_fee + $sub_total_cart,
            'order_status' => 'waiting_payment',
            'payment_status' => 'waiting_payment',
        ];

        try {
            DB::beginTransaction();
            $serverKey = config('midtrans.key');

            $response = Http::withBasicAuth($serverKey, '')
                ->withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ])
                ->post('https://api.sandbox.midtrans.com/v2/charge', [
                    'payment_type'          => 'bank_transfer',
                    'transaction_details'   => [
                        'order_id'      => $data_order['order_id'],
                        'gross_amount'  => $data_order['total']
                    ],
                    'bank_transfer'         => [
                        'bank'          => $data_order['bank']
                    ],
                    'customer_details'      => [
                        'email'         => $user->email,
                        'first_name'    => $user->name
                    ]
                ]);
            if ($response->failed()){
                return response()->json(['message' => 'failed charge'], 500);
            }

            $result = $response->json();
            if ($result['status_code'] != '201') //Kode selain 201 gagal
            {
                return response()->json(['message' => $result['status_message']], 500);
            }
            DB::commit();

            // Insert to orders
            $data_order['va_number'] = $result['va_numbers'][0]['va_number'];
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

            return $order_id; // order_id
        }catch (\Exception $e){
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function getOrderID($order_id)
    {
        $data = Order::where('order_id', '=', $order_id)->get();

        return $data;
    }

    public function getOrderUser($user_id){
        $data = Order::where('user_id', '=', $user_id)->get();

        return $data;
    }
}
