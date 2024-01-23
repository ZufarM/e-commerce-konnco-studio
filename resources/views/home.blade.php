@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">Selamat Datang dan Selamat Belanja</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-borderless table-hover">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Stock</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->description }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>{{ $product->price }}</td>
                                <td>
                                    <form method="POST" action="{{ route('cart.store') }}">
                                        @csrf
                                        @method('POST')
                                        <input type="hidden" value="{{ $product->id }}" name="id">
                                        <input type="hidden" value="{{ $product->name }}" name="name">
                                        <input type="hidden" value="{{ $product->price }}" name="price">
                                        <input type="hidden" value="1" name="quantity">
                                        <button type="submit" class="btn btn-sm btn-outline-info ">Add to Cart</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            @auth
            <div class="card mt-5">
                <div class="card-header">Keranjang Belanja</div>

                <div class="card-body">
                    <table class="table table-borderless table-hover">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $total = 0; @endphp
                        @foreach ($cart as $cart_item)
                            <tr>
                                <td>{{ $cart_item->product_name }}</td>
                                <td>{{ $cart_item->qty }}</td>
                                <td>{{ $cart_item->qty * $cart_item->product_price }}</td>
                                <td>
                                    <form method="POST" action="{{ route('cart.remove', $cart_item->id ) }}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" value="{{ $cart_item->id }}" name="id">
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Remove</button>
                                    </form>
                                </td>
                            </tr>

                            @php $total += $cart_item->qty * $cart_item->product_price; @endphp
                        @endforeach
                        <tr>
                            <th>Total</th>
                            <th></th>
                            <th>{{$total}}</th>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <th></th>
                            <th colspan="3">: {{auth()->user()->name}}</th>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <th></th>
                            <th colspan="3">: {{auth()->user()->email}}</th>
                        </tr>
                        <tr>
                            <th>Metode Pembayaran</th>
                            <th></th>
                            <th colspan="3">: VA BNI</th>
                        </tr>
                        @if($delivery_address != null)
                            <tr>
                                <th>Address delivery</th>
                                <th></th>
                                <th colspan="3">: {{$delivery_address}}</th>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    @if($cart->count() > 0)
                        @if($delivery_address == null)
                            <form method="POST" action="{{ route('addDeliveryAddress') }}">
                                @csrf
                                @method('POST')
                                <input type="text" value="" name="delivery_address" placeholder="Address delivery">
                                <button type="submit" class="btn btn-sm btn-info text-white">Submit</button>
                                <button class="btn btn-sm btn-success text-white" disabled>Checkout to Order</button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('checkout') }}">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn btn-sm btn-success text-white">Checkout to Order</button>
                            </form>
                        @endif
                    @endif
                </div>
            </div>
            @endauth
        </div>
    </div>
</div>
@endsection
