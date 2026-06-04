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
                    <article class="m-5 P-5">
                        <img src="{{ asset('images/product/' . $item->photo) }}" alt="{{ $item->itemName }}">
                        <div>
                            @if($item->salePrice)
                                <p class="price orange">
                                    ${{ number_format($item->salePrice, 2) }}
                                </p>
                                <p class="discount">
                                    was <del>${{ number_format($item->price, 2) }}</del>
                                </p>
                            @else
                                <p class="price orange">
                                    ${{ number_format($item->price, 2) }}
                                </p>
                            @endif
                        </div>
                        <h3>{{ \Illuminate\Support\Str::limit($item->itemName, 50, '...') }}</h3>
                    </article>
                </a>
            @endforeach
        @endif
    </div>

@endsection
