<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Repository\OrderRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HandlePaymentNotifController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * Reference https://docs.midtrans.com/docs/https-notification-webhooks
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {

        $payload = $request->all();

        Log::info('incomming-midtrans', [
            'payload'   => $payload
        ]);

        $orderId = $payload['order_id'];
        $statusCode = $payload['status_code'];
        $grossAmount = $payload['gross_amount'];
        $reqSignatureKey = $payload['signature_key'];

        $signature = hash('sha512',
            $orderId
            .$statusCode
            .$grossAmount
            .config('midtrans.key')
        );

        if ($signature != $reqSignatureKey) {
            return response()->json([
                'message' => 'invalid signature'
            ], 401);
        }

        $transactionStatus = $payload['transaction_status'];

        $orderRep = new OrderRepository();
        $order = $orderRep->firstOrFailOrderID($orderId);
        if (!$order) {
            return response()->json([
                'message' => 'invalid order'
            ], 400);
        }

        if ($transactionStatus == 'settlement'){
            $order->payment_status = 'paid';
            $order->order_status = 'processing';
            $order->save();
        } else if ($transactionStatus == 'expire'){
            $order->payment_status = 'expire';
            $order->save();
        }

        return response()->json([
            'message' => 'success'
        ]);
    }
}
