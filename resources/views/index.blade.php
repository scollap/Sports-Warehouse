@extends('layouts.app')

@section('title', 'Home - Sports Warehouse')

@section('content')


            <!-- Main Content -->
            <!-- Logo and search products section -->
            @include('partials._Logo_search')

            {{-- Add section to display all categories --}} 
            @include('partials._categories')

            @include('partials._hero')


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
{{-- display featured items --}}
@include('partials._cards_items')
</div>
<div class="flex justify-center mt-8">
    {{ $items->links() }}
</div>

{{-- display recently viewed items --}}
@include('partials._recentlyVieded')
            <!-- Brands -->
        @include('partials._brands')

@endsection