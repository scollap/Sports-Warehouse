@extends('layouts.app')

@section('title', $item->itemName . ' - Sports Warehouse')

@section('content')


    <!-- Main Content -->
    @include('partials.logo_search')
    @include('partials.categories')

    <div class="white-background">
        <h2 class="orange-bar">{{ $item->itemName }}</h2>
    </div>

    <section class="item-details">
        <div class="item-details__image">
            <img src="{{ asset('images/product/' . $item->photo) }}" alt="{{ $item->itemName }}">
        </div>

        <div class="item-details__content">
            <span class="item-details__category">
                Category: {{ $item->category?->categoryName ?? 'Uncategorized' }}
            </span>

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
                        Was: ${{ number_format($item->price, 2) }}
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
            </div>
        </div>
    </section>

    @include('partials.brands')

@endsection
