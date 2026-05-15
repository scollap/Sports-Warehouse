@extends('layouts.app')

@section('title', 'Home - Sports Warehouse')

@section('content')


            <!-- Main Content -->

                <!-- Logo and search products section -->
            @include('partials.logo_search')

                {{-- Add section to display all categories --}} 
            @include('partials.categories')

            @include('partials.hero')


    <!-- Featured Products -->
        <div class="white-background">
            <h2 class="orange-bar">Featured products</h2>
        </div>
        <div class="featured-products">

        @if (!$item) 
            <p>No product found.</p>
        @else

                    <article>
                        <img src="{{ asset($item['image']) }}" alt="{{ $item['alt'] }}">
                        <div>
                            <p class="price orange">{{ $item['price'] }}</p>
                            @if ($item['discount'])
                                <p class="discount">was <del>{{ $item['discount'] }}</del></p>
                            @endif
                        </div>
                        <h3>{{ $item['description'] }}</h3>
                    </article>
        @endif
        </div>

            <!-- Brands -->
        @include('partials.brands')

@endsection