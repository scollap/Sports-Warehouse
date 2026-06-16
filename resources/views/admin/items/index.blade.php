@extends('layouts.app')

@section('title', 'Manage Categories')

@section('content')
<div class="mainRegDiv">

    <h1 class="orange-bar">Manage Products</h1>

    @include('partials._flash-messages')

    <div class="mb-4">
        <a href="{{ route('admin.items.create') }}" class="buttonBlue">
            Add Product
        </a>
    </div>

    <div class="formDiv">

        @if ($items->count() === 0)

            <p>No products found.</p>

        @else

            <table class="adminTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category Name</th>
                        <th class="actions-column">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td class="product-cell">
                                {{ $item->itemId }}
                                <img
                                    src="{{ $item->photo ? asset('images/product/' . $item->photo) : asset('images/placeholder.png') }}"
                                    alt="{{ $item->itemName }}"
                                    class="product-thumb">
                            </td>
                            <td>{{ $item->itemName }}</td>

                            <td class="actions-cell">
                                <a href="{{ route('admin.items.edit', $item->itemId) }}"
                                   class="buttonBlue">
                                    Edit
                                </a>

                                <form action="{{ route('admin.items.destroy', $item->itemId) }}"
                                      method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="button"
                                            onclick="return confirm('Are you sure you want to delete this product?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>

        @endif

    </div>

</div>
@endsection