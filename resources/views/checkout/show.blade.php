@extends('layouts.app')

@section('title', 'Checkout - Sports Warehouse')

@section('content')

    {{-- Use the same stylesheet as the contact form --}}
    <link rel="stylesheet" href="{{ asset('css/form_style.css') }}">

    @include('partials._Logo_search')


    <div class="mainRegDiv">

        <div class="checkoutDiv">
            <h2>Checkout</h2>
            <p>
                Complete your details below to finalise your order.
                You currently have {{ count($items_with_qty) }} unique item(s) in your cart.
                {{-- display a list of items in the cart --}}
                <div class="cart-summary">
                    <ul>
                        <p class="text-lg border-b border-[#00aced] pb-2">Cart summary:</p>
                        @php $total = 0; @endphp
                        @foreach ($items_with_qty as $data)
                            @php 
                                $itemTotal = $data['item']->price * $data['qty'];
                                $total += $itemTotal;
                            @endphp
                            <li>
                                <p class="text-sm"> 
                                    🏀 {{ $data['item']->itemName }} 
                                    (x{{ $data['qty'] }}) - 
                                    ${{ number_format($itemTotal, 2) }}
                                </p>
                            </li>
                        @endforeach
                        <p class="text-lg border-t border-[#00aced]  pb-2">Total Price: ${{ number_format($total, 2) }}</p>
                    </ul>
                </div>
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
                    <div class="flex gap-4">
                        <div class="form-row">
                            <label for="customer_firstname">First Name*</label>

                            <input
                                class="form-input"
                                type="text"
                                id="customer_firstname"
                                name="customer_firstname"
                                value="{{ old('customer_firstname') }}"
                                required
                            >

                            @error('customer_firstname')
                                <span class="error-message">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-row">
                            <label for="customer_lastname">Last Name*</label>
                            <input
                                class="form-input"
                                type="text"
                                id="customer_lastname"
                                name="customer_lastname"
                                value="{{ old('customer_lastname') }}"
                                required
                            >

                            @error('customer_lastname')
                                <span class="error-message">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="form-row">
                            <label for="customer_phone">Phone Number</label>

                            <input
                                class="form-input"
                                type="text"
                                id="customer_phone"
                                name="customer_phone"
                                value="{{ old('customer_phone') }}"
                            >
                            @error('customer_phone')
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
                    </div>
                    <div class="flex gap-4">
                        <div class="form-row">
                            <label for="address_street">Street Address*</label>
                            <input
                                class="form-input"
                                type="text"
                                id="address_street"
                                name="address_street"
                                value="{{ old('address_street') }}"
                                required
                            >
                            @error('address_street')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-row">
                            <label for="address_suburb">Suburb*</label>
                            <input
                                class="form-input"
                                type="text"
                                id="address_suburb"
                                name="address_suburb"
                                value="{{ old('address_suburb') }}"
                                required
                            >
                            @error('address_suburb')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                   </div>
                    <div class="flex gap-4">
                        <div class="form-row w-1/2">
                            <label for="address_state">State*</label>
                            <input
                                class="form-input"
                                type="text"
                                id="address_state"
                                name="address_state"
                                value="{{ old('address_state') }}"
                                required
                            >
                            @error('address_state')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-row w-1/2">
                            <label for="address_postcode">Postcode*</label>
                            <input
                                class="form-input"
                                type="text"
                                id="address_postcode"
                                name="address_postcode"
                                value="{{ old('address_postcode') }}"
                                required
                            >
                            @error('address_postcode')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <label for="customer_comment">Your Comment</label>

                        <textarea
                            class="form-input"
                            id="customer_comment"
                            name="customer_comment"
                        >{{ old('customer_comment') }}</textarea>
                    </div>

                    <fieldset class="mt-8 border-t border-[#00aced] pt-4">
                        <legend>Payment Details 💳</legend>

                        <div class="form-row">
                            <label for="card_name">Name on Card*</label>
                            <input
                                class="form-input"
                                type="text"
                                id="card_name"
                                name="card_name"
                                value="{{ old('card_name') }}"
                                required
                            >
                            <span id="card_name_error" class="error-message hidden">Please enter the name on the card.</span>
                        </div>

                        <div class="form-row">
                            <label for="card_number">Credit Card Number*</label>
                            <input
                                class="form-input"
                                type="text"
                                id="card_number"
                                name="card_number"
                                placeholder="16 digit card number"
                                maxlength="16"
                                required
                            >
                            <span id="card_number_error" class="error-message hidden">Please enter a valid 16-digit card number.</span>
                        </div>

                        <div class="form-row">
                            <label for="card_expiry">Expiry Date* (MM/YY)</label>
                            <input
                                class="form-input"
                                type="text"
                                id="card_expiry"
                                name="card_expiry"
                                placeholder="MM/YY"
                                maxlength="5"
                                required
                            >
                            <span id="card_expiry_error" class="error-message hidden">Please enter a valid expiry date (MM/YY).</span>
                        </div>
                    </fieldset>

                    <div class="flex justify-between mt-6"> 
                        <div class="form-row">
                            <a href="{{ route('cart.index') }}" class="button">
                                Return to cart
                            </a>
                        </div>
                        <div class="form-row">
                            <button type="submit" id="checkout-submit">
                                Checkout
                            </button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form[action="/checkout"]');
            const submitBtn = document.getElementById('checkout-submit');

            form.addEventListener('submit', function(e) {
                let isValid = true;

                // Reset errors
                document.querySelectorAll('.error-message').forEach(el => el.classList.add('hidden'));

                // Simple Client-side validation
                const cardName = document.getElementById('card_name');
                const cardNumber = document.getElementById('card_number');
                const cardExpiry = document.getElementById('card_expiry');

                if (cardName.value.trim().length < 3) {
                    document.getElementById('card_name_error').classList.remove('hidden');
                    isValid = false;
                }

                if (!/^\d{16}$/.test(cardNumber.value.replace(/\s/g, ''))) {
                    document.getElementById('card_number_error').classList.remove('hidden');
                    isValid = false;
                }

                if (!/^\d{2}\/\d{2}$/.test(cardExpiry.value)) {
                    document.getElementById('card_expiry_error').classList.remove('hidden');
                    isValid = false;
                }

                if (!isValid) {
                    e.preventDefault();
                    alert('Please fix the errors in the payment section before proceeding.');
                }
            });
        });
    </script>

@endsection