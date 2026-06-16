@extends('layouts.app')

@section('title', 'Saved Items - Sports Warehouse')

@section('content')

@include('partials._Logo_search')

@include('partials._categories')

<div class="mainRegDiv">

    <div class="formDiv">

        @if($items->isEmpty())

            <div class="empty-cart">
                <h3>Your cart is empty</h3>
                <p>Browse our products and add some items to get started.</p>
            </div>

        @else

            <div class="cart-summary">
                <h3>Order Summary</h3>
                <p>Total Items: {{ $items->count() }}</p>
            </div>

            <div class="cart-grid">

                @foreach($items as $item)

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
                            $
                            {{ number_format($item->salePrice ?? $item->price, 2) }}
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