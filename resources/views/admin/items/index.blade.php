@extends('layouts.app')

@section('title', 'Manage Categories')

@section('content')
<div class="mainRegDiv">

    <h1 class="orange-bar">Manage Products</h1>

    @include('partials._flash-messages')
    <div class="mb-4">
        <div class="flex justify-between mt-4">

                <a href="{{ route('admin.items.create') }}" class="buttonBlue">
                    Add Product
                </a>

                <a href="{{ route('dashboard') }}" class="buttonBlue">
                    Back to Dashboard
                </a>

        </div>
    </div>

    <div class="formDiv">

        @if ($items->count() === 0)

            <p>No products found.</p>

        @else

            <table class="adminTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Sale</th>
                        <th>Featured</th>
                        <th class="actions-column">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td>
                                <div class="product-cell">
                                {{ $item->itemId }}
                                <img
                                    src="{{ $item->photo ? asset('images/product/' . $item->photo) : asset('images/placeholder.png') }}"
                                    alt="{{ $item->itemName }}"
                                    class="product-thumb">
                                </div>
                            </td>
                            <td>{{ $item->itemName }}</td>
                            <td>
                                @if($item->salePrice)
                                    <del>${{ number_format($item->price, 2) }}</del>
                                @else
                                    ${{ number_format($item->price, 2) }}
                                @endif
                            </td>
                            <td>
                                {{ $item->salePrice ? '$' . number_format($item->salePrice, 2) : '' }}
                            </td>
                            <td>{!! $item->featured ? '<i class="fa-regular fa-circle-check"></i>' : '' !!}</td>
                            <td>
                                <div class="actions-cell">
                                <a href="{{ route('admin.items.edit', $item->itemId) }}"
                                   class="buttonBlue">
                                    <i class="fa-solid fa-sliders"></i>
                                </a>

                                <form action="{{ route('admin.items.destroy', $item->itemId) }}"
                                      method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="button"
                                            onclick="return confirm('Are you sure you want to delete this product?')">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>

            <div class="flex justify-center mt-8">
                {{ $items->links() }}
            </div>

        @endif

    </div>
</div>
@endsection