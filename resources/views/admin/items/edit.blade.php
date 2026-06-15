@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
<div class="mainRegDiv">

    <h1 class="orange-bar">Edit Product</h1>

    <div class="formDiv">
        <form action="{{ route('admin.items.update', $item->itemId) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div>
                <label class="block font-medium text-sm text-gray-700"
                       for="categoryName">
                    Category Name
                </label>

                <input
                    id="categoryName"
                    name="categoryName"
                    type="text"
                    class="form-input"
                    value="{{ old('categoryName', $item->itemName) }}"
                    required
                >

                @error('categoryName')
                    <p class="text-danger mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-4 mt-5">
                <button type="submit" class="buttonBlue">
                    Update Product
                </button>

                <a href="{{ route('admin.items.index') }}"
                   class="button">
                    Cancel
                </a>
            </div>

        </form>
    </div>

</div>
@endsection