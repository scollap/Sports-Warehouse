@extends('layouts.app')


@section('title', 'Saved Items - Sports Warehouse')

@section('content')


    <!-- Main Content -->
    {{-- use to display saved items  --}}
    <p>Here is the items in your cart, you currently have {{ $items->count() }}.</p>
    <div class="featured-products">
        @if($items->isEmpty())
            <p>No saved items yet.</p>
        @else
            @foreach($items as $item)
                <a href="{{ route('product.show', $item->itemId) }}" class="item-link">
                    <article >
                        <img src="{{ asset('images/product/' . $item->photo) }}" alt="{{ $item->itemName }}">
                        <div>
                            @if($item->salePrice)
                                <p class="price orange">
                                    ${{ number_format($item->salePrice, 2) }}
                                </p>
                            @else
                                <p class="price orange">
                                    ${{ number_format($item->price, 2) }}
                                </p>
                            @endif
                        </div>
                        <h3>{{ \Illuminate\Support\Str::limit($item->itemName, 50, '...') }}</h3>
                        <form action="{{ route('cart.remove', $item->itemId) }}" method="POST">
                            @csrf
                            <button type="submit" class="button">
                                Remove
                            </button>
                        </form>
                    </article>
                </a>
            @endforeach
        @endif
    </div>

@endsection
