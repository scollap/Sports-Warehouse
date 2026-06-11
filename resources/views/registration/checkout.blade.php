@extends('layouts.app')

@section('title', 'Checkout - Sports Warehouse')

@section('content')

    {{-- Use the same stylesheet as the contact form --}}
    <link rel="stylesheet" href="{{ asset('css/form_style.css') }}">

    @include('partials._Logo_search')

    <div class="mainRegDiv">

        <div class="soonDiv">
            <h2>Checkout</h2>
            <p>
                Complete your details below to finalise your order.
                You currently have {{ $items->count() }} item(s) in your cart.
            </p>
        </div>

        <div class="formDiv">
            <h2>Cart Checkout 🛒</h2>

            <p>
                Please enter your contact information before proceeding to checkout.
            </p>

            @if ($errors->any())
                <div class="error-summary">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="/checkout" method="POST" novalidate>
                @csrf

                <fieldset>
                    <legend>Checkout Details</legend>

                    <div class="form-row">
                        <label for="customer_name">Your Name*</label>

                        <input
                            class="form-input"
                            type="text"
                            id="customer_name"
                            name="customer_name"
                            value="{{ old('customer_name') }}"
                            required
                        >

                        @error('customer_name')
                            <span class="error-message">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-row">
                        <label for="customer_email">Your Email*</label>

                        <input
                            class="form-input"
                            type="email"
                            id="customer_email"
                            name="customer_email"
                            value="{{ old('customer_email') }}"
                            required
                        >

                        @error('customer_email')
                            <span class="error-message">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
{{--  --}}
                    <div class="form-row">
                        <label for="customer_address">Your Address*</label>

                        <input
                            class="form-input"
                            type="text"
                            id="customer_address"
                            name="customer_address"
                            value="{{ old('customer_address') }}"
                            required
                        >

                        @error('customer_address')
                            <span class="error-message">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
{{--  --}}
                    <div class="form-row">
                        <label for="customer_comment">Your Comment</label>

                        <textarea
                            class="form-input"
                            id="customer_comment"
                            name="customer_comment"
                        >{{ old('customer_comment') }}</textarea>
                    </div>  

                    <div class="form-row">
                        <label>Cart Summary</label>
                        <p>{{ $items->count() }} item(s) ready for checkout.</p>
                    </div>
                    <div class="flex justify-between"> 
                        <div class="form-row">
                            <a href="{{ route('saved.show') }}" class="button">
                                Return to cart
                            </a>
                        </div>
                        <div class="form-row">
                            <button type="submit">
                                Checkout
                            </button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>

    </div>

@endsection