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
@if($items->total() > 5)
    <div class="mb-6">
        <form method="GET">

            @if(request('search'))
                <input type="hidden" name="search" value="{{ request('search') }}">
            @endif
            <label>Items per page:</label>
            <select name="per_page" onchange="this.form.submit()">
                <option value="5" {{ $perPage == 5 ? 'selected' : '' }}>5</option>
                <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                <option value="15" {{ $perPage == 15 ? 'selected' : '' }}>15</option>
            </select>
        </form>
    </div>
@endif
<div class="featured-products">
@if($items->isEmpty())
    <p>No products found.</p>
@else
    @foreach($items as $item)
        <a href="{{ route('product.show', $item->itemId) }}" class="item-link">
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
        </a>
    @endforeach
@endif
</div>
<div class="flex justify-center mt-8">
    {{ $items->links() }}
</div>
            <!-- Brands -->
        @include('partials.brands')

@endsection