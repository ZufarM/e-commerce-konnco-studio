@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Order Saya</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table>
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Alamat Pengiriman</th>
                                <th>order status</th>
                                <th>payment status</th>
                                <th>Sub total</th>
                                <th>Biaya pengiriman</th>
                                <th>Total Pembayaran</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ auth()->user()->name }}</td>
                                    <td>{{ $order->delivery_address }}</td>
                                    <td>{{ $order->order_status }}</td>
                                    <td>{{ $order->payment_status }}</td>
                                    <td>{{ $order->sub_total }}</td>
                                    <td>{{ $order->delivery_fee }}</td>
                                    <td>{{ $order->total }}</td>
                                    <td>
                                        <a href="{{ route('order', $order->order_id) }}">Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
