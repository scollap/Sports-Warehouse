@extends('layouts.app')

@section('title', 'Home - Sports Warehouse')

@section('content')


            <!-- Main Content -->

                <!-- Logo and search products section -->
            @include('partials.logo_search')

                {{-- Add section to display all categories --}} 
            @include('partials.categories')



    <!-- Featured Products -->
        <div class="white-background">
            <h2 class="orange-bar">{{ $category ? $category->categoryName : 'No Category'  }}</h2>
        </div>
        <div class="featured-products">
@if($items->isEmpty())
    <p>No products found.</p>
@else
    @foreach($items as $item)
        <article>
            <img src="{{ asset('images/product/' . $item->photo) }}" alt="{{ $item->itemName }}">
            <div>
                <p class="price orange">
                    ${{ number_format($item->price, 2) }}
                </p>
                @if($item->salePrice)
                    <p class="discount">
                        was <del>${{ number_format($item->salePrice, 2) }}</del>
                    </p>
                @endif
            </div>
            <h3>{{ \Illuminate\Support\Str::limit($item->itemName, 50, '...') }}</h3>
        </article>
    @endforeach
@endif
        </div>
<div class="flex justify-center mt-8">
    {{ $items->links() }}
</div>
            <!-- Brands -->
        @include('partials.brands')

@endsection