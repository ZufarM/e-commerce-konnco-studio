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

                        <table class="table table-borderless table-hover">
                            <thead>
                            <tr>
                                <th>Time</th>
                                <th>Name</th>
                                <th>Address delivery</th>
                                <th>Order status</th>
                                <th>Payment status</th>
                                <th>Amount</th>
                                <th>Order ID</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->created_at }}</td>
                                    <td>{{ auth()->user()->name }}</td>
                                    <td>{{ $order->delivery_address }}</td>
                                    <td>{{ $order->order_status }}</td>
                                    <td>{{ $order->payment_status }}</td>
                                    <td>Rp.{{ $order->total }}</td>
                                    <td>
                                        <a href="{{ route('order', $order->order_id) }}">{{ $order->order_id }}</a>
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
