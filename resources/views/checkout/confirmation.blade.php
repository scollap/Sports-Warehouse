@extends('layouts.app')

@section('title', 'Order Confirmation - Sports Warehouse')

@section('content')

    @include('partials._Logo_search')

    <div class="mainRegDiv">
        <div class="confirmation-div">
            <h2 class="confirmation-title">Order Successful! 🎉</h2>
            <p class="confirmation-message">Thank you for your purchase.</p>
            <p class="confirmation-order-num">
                Your Order Number is: <span class="text-blue">#{{ $order->id }}</span>
            </p>
            <p class="confirmation-email-note">A confirmation email has been sent to {{ $order->customer_email }}.</p>
            
            <a href="{{ route('home') }}" class="buttonBlue button-large">
                Continue Shopping
            </a>
        </div>
    </div>

@endsection
