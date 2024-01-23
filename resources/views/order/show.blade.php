@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-5">
                    <div class="card-header"><h5>Detail Order</h5></div>

                    <div class="card-body">
                        <table>
                            <thead>
                            <tr>
                                <th>Order ID</th>
                                    <td>: {{ $order->order_id }}</td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td>: {{ auth()->user()->name }}</td>
                                </tr>
                                <tr>
                                    <th>Alamat Pengiriman</th>
                                    <td>: {{ $order->delivery_address }}</td>
                                </tr>
                                <tr>
                                    <th>Bank VA</th>
                                    <td>: <b>{{ $order->bank }} VA {{ $order->va_number }}</b></td>
                                </tr>
                                <tr>
                                    <th>order status</th>
                                    <td>:
                                        <b class="
                                        @if($order->payment_status == 'waiting_payment') text-warning
                                        @elseif($order->payment_status == 'delivered') text-success
                                        @else text-info
                                        @endif
                                            "
                                        >
                                            {{ $order->order_status }}
                                        </b>
                                    </td>
                                </tr>
                                <tr>
                                    <th>payment status</th>
                                    <td>:
                                        <b class="
                                        @if($order->payment_status != 'paid') text-warning @else text-success @endif
                                            "
                                        >
                                            {{ $order->payment_status }}
                                        </b> </td>
                                </tr>
                                <tr>
                                    <th>Sub total</th>
                                    <td>: {{ $order->sub_total }}</td>
                                </tr>
                                <tr>
                                    <th>Biaya pengiriman</th>
                                    <td>: {{ $order->delivery_fee }}</td>
                                </tr>
                                <tr>
                                    <th>Total Pembayaran</th>
                                    <td>: <b>Rp. {{ $order->total }}</b></td>
                                </tr>
                            </thead>
                        </table>
                        <table>
                            <h5 class="mt-3 mb-0">Detail Order Item</h5>
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($orderItem as $item)
                                <tr>
                                    <td>{{ $item->product_name }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>{{ $item->qty * $item->product_price }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <button class="btn btn-success" onClick="window.location.reload();">Check Status</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
