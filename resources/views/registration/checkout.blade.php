@extends('layouts.app')

@section('title', 'Checkout - Sports Warehouse')

@section('content')


    <!-- Main Content -->
    <!-- Logo and search products section -->
    @include('partials._Logo_search')

    <section class="checkout">
        <div>
            <h1>Cart checkout</h1>
            {{-- display errors --}}
            @if ($errors->any())
                <div class="alert alert-danger my-2">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action='/checkout' method='post'>
                @csrf
                <!-- Add checkout form fields here -->
                <div>
                    <label for="customer_name">Your Name</label>
                    <input type="text" id="customer_name" name="customer_name" value="{{ old('customer_name') }}" required>
                </div>
                                <div>
                    <label for="customer_email">Your Email</label>
                    <input type="email" id="customer_email" name="customer_email" value="{{ old('customer_email') }}" required>
                </div>
                <p>your cart has {{ $items->count() }} items.</p>
                <button class="btn btn-primary" type="submit">Proceed to Checkout</button>
            </form>
        </div>
    </section>


    @include('partials._brands')

@endsection