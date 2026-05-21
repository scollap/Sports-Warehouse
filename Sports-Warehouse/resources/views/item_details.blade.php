@extends('layouts.app')

@section('title', $item->itemName . ' - Sports Warehouse')

@section('content')

{{-- <style>
.item-details {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 40px;
    padding: 30px;
    align-items: start;
}

/* IMAGE */
.item-details__image img {
    width: 100%;
    max-height: 450px;
    object-fit: contain;
    border-radius: 10px;
    background: #fff;
    padding: 10px;
    border: 1px solid #eee;
}

/* CONTENT */
.item-details__content {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

/* CATEGORY */
.item-details__category {
    font-size: 14px;
    color: #777;
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* TITLE */
.item-details__header h1 {
    font-size: 28px;
    margin: 10px 0;
}

/* PRICING */
.item-details__pricing {
    display: flex;
    gap: 15px;
    align-items: center;
    font-size: 18px;
}

.item-details__price {
    font-weight: bold;
    color: #222;
}

.item-details__sale-price {
    color: #e63946;
    font-weight: bold;
}

/* DESCRIPTION */
.item-details__description {
    margin-top: 10px;
}

.item-details__description h3 {
    margin-bottom: 5px;
}

/* BUTTON */
.button {
    display: inline-block;
    padding: 10px 15px;
    border-radius: 6px;
    text-decoration: none;
}

.button-secondary {
    background: #eee;
    color: #333;
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .item-details {
        grid-template-columns: 1fr;
    }
} --}}
</style>

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
                    <span class="item-details__price">
                        Price: ${{ number_format($item->price, 2) }}
                    </span>

                    @if($item->salePrice)
                        <span class="item-details__sale-price">
                            Sale: ${{ number_format($item->salePrice, 2) }}
                        </span>
                    @endif
                </div>
            </div>

            <div class="item-details__description">
                <h3>Description</h3>
                <p>{{ $item->description }}</p>
            </div>

            <div class="item-details__actions">
                <a href="{{ url()->previous() }}" class="button button-secondary">Back</a>
            </div>
        </div>
    </section>

    @include('partials.brands')

@endsection
