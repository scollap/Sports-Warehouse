@if($items->isEmpty())
    <p>No products found.</p>
@else
    @foreach($items as $item)
        <a href="{{ route('product.show', $item->itemId) }}" class="item-link">
            <article>
                @if($item->photo)
                    <img src="{{ asset('images/product/' . $item->photo) }}" alt="{{ $item->itemName }}">
                @else
                    <img src="{{ asset('images/placeholder.png') }}" alt="Placeholder">
                @endif
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

