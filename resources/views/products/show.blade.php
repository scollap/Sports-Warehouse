@extends('layouts.app')


@section('title', $item->itemName . ' - Sports Warehouse')

@section('content')


    <!-- Main Content -->
    @include('partials._Logo_search')
    @include('partials._categories')

    <div class="white-background">
        <h2 class="orange-bar">{{ $item->category?->categoryName ?? 'Uncategorized' }}</h2>
    </div>

    <section class="item-details">
        <div class="item-details__image">
            @if($item->photo)
                    <img src="{{ asset('images/product/' . $item->photo) }}" alt="{{ $item->itemName }}">
                @else
                    <img src="{{ asset('images/placeholder.png') }}" alt="Placeholder">
                @endif
        </div>
        <div class="item-details__content">

            <div class="item-details__header">
                <h1>{{ $item->itemName }}</h1>

                <div class="item-details__pricing">
                    @if($item->salePrice)
                        <span class="item-details__price">
                            Sale Price: ${{ number_format($item->salePrice, 2) }}
                        </span>
                        <span class="item-details__sale-price">
                            Was: ${{ number_format($item->price, 2) }}
                        </span>
                    @else
                    <span class="item-details__price">
                        Price: ${{ number_format($item->price, 2) }}
                    </span>
                    @endif
                </div>
            </div>

            <div class="item-details__description">
                <h3>Description:</h3>
                <p>{{ $item->description }}</p>
            </div>

            <div class="item-details__actions">
                <a href="{{ url()->previous() }}" class="button button-secondary">Back</a>

                @if ($item->isSaved)
                    <div class="flex flex-col gap-2">
                        <form action="{{ route('cart.remove', $item->itemId) }}" method="POST">
                            @csrf
                            <button type="submit" class="button button-primary cursor-pointer button-muted">
                                Remove from Cart
                            </button>
                        </form>
                        
                        {{-- Even if saved, maybe they want to add more? --}}
                        <form action="{{ route('cart.add', $item->itemId) }}" method="POST" class="mt-4">
                            @csrf
                            <div style="margin-bottom: 10px;">
                                <label for="quantity">Add more quantity:</label>
                                <input type="number" name="quantity" id="quantity" value="1" min="1" class="form-input quantity-input">
                            </div>
                            <button type="submit" class="button button-primary cursor-pointer">
                                Add to Cart
                            </button>
                        </form>
                    </div>
                @else
                    <form action="{{ route('cart.add', $item->itemId) }}" method="POST">
                        @csrf
                        <div style="margin-bottom: 10px;">
                            <label for="quantity">Quantity:</label>
                            <input type="number" name="quantity" id="quantity" value="1" min="1" class="form-input quantity-input">
                        </div>
                        <button type="submit" class="button button-primary cursor-pointer">
                            Add to Cart
                        </button>
                    </form>
                @endif
            </div>

        </div>
    </section>

    @include('partials._brands')

@endsection
