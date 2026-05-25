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