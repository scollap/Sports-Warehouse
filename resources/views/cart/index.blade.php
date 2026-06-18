@extends('layouts.app')

@section('title', 'Saved Items - Sports Warehouse')

@section('content')

@include('partials._Logo_search')

@include('partials._categories')

<div class="mainRegDiv">

    <div class="formDiv">

        @if(empty($items_with_qty))

            <div class="empty-cart">
                <h3>Your cart is empty</h3>
                <p>Browse our products and add some items to get started.</p>
            </div>

        @else

            <div class="cart-summary">
                <h3>Order Summary</h3>
                @php 
                    $totalItems = 0;
                    $totalPrice = 0;
                    foreach($items_with_qty as $data) {
                        $totalItems += $data['qty'];
                        if($data['item']->salePrice) {
                            $totalPrice += ($data['item']->salePrice * $data['qty']);
                        } else {
                            $totalPrice += ($data['item']->price * $data['qty']);
                        }
                    }
                @endphp
                <p>Total Items in cart: {{ $totalItems }}</p>
                <p>Total Order Price: ${{ number_format($totalPrice, 2) }}</p>
            </div>

            <div class="cart-grid">

                @foreach($items_with_qty as $data)
                    @php 
                        $item = $data['item'];
                        $qty = $data['qty'];
                    @endphp
                    <div class="cart-card">

                        <a href="{{ route('product.show', $item->itemId) }}">
                            <img
                                src="{{ asset('images/product/' . $item->photo) }}"
                                alt="{{ $item->itemName }}"
                            >

                            <h3>
                                {{ \Illuminate\Support\Str::limit($item->itemName, 50, '...') }}
                            </h3>
                        </a>

                        <p class="price orange">
                            {!! $data['item']->salePrice ? '$' . number_format($data['item']->salePrice, 2) : '$' . number_format($data['item']->price, 2)  !!}
                        </p>
                        
                        <p style="margin: 10px 0;">
                            <strong>Quantity: {{ $qty }}</strong>
                        </p>

                        <p>
                            Sub-total: {!! $data['item']->salePrice ? '$' . number_format($data['item']->salePrice * $qty, 2) : '$' . number_format($data['item']->price * $qty, 2)  !!}
                        </p>

                        <form action="{{ route('cart.remove', $item->itemId) }}" method="POST">
                            @csrf
                            <button type="submit" class="remove-btn">
                                Remove
                            </button>
                        </form>

                    </div>

                @endforeach

            </div>

            <div class="checkout-section">

                <a href="{{ route('items.checkout_form') }}" class="buttonBlue">
                    Proceed to Checkout
                </a>

            </div>

        @endif

    </div>

</div>

@include('partials._brands')

@endsection