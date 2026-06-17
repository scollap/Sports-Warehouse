@extends('layouts.app')

@section('title', 'Order Confirmation - Sports Warehouse')

@section('content')

    @include('partials._Logo_search')

    <div class="mainRegDiv">
        <div class="confirmationDiv" style="text-align: center; padding: 50px;">
            <h2 style="color: #f60; font-size: 2.5rem; margin-bottom: 20px;">Order Successful! 🎉</h2>
            <p style="font-size: 1.2rem; margin-bottom: 10px;">Thank you for your purchase.</p>
            <p style="font-size: 1.5rem; font-weight: bold; margin-bottom: 30px;">
                Your Order Number is: <span style="color: #00aced;">#{{ $order->id }}</span>
            </p>
            <p style="margin-bottom: 40px;">A confirmation email has been sent to {{ $order->customer_email }}.</p>
            
            <a href="{{ route('home') }}" class="buttonBlue" style="padding: 10px 30px; text-decoration: none; border-radius: 5px;">
                Continue Shopping
            </a>
        </div>
    </div>

@endsection
