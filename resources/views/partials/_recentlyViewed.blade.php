@if (count($recentlyViewed) > 0)
    <div class="white-background">
        <h2 class="orange-bar">Recently Viewed Products</h2>
    </div>

    <div class="featured-products">
            @foreach ($recentlyViewed as $item)
                <a href="{{ route('product.show', $item->itemId) }}" class="item-link">
                            <article>
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
    </div>
@endif