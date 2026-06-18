@extends('layouts.app')

@section('title', 'Edit ' . $item->itemName)

@section('content')

@include('partials._Logo_search')
@include('partials._categories')

<div class="white-background">
    <h2 class="orange-bar">
        Edit Product
    </h2>
</div>

<form action="{{ route('admin.items.update', $item->itemId) }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf
    @method('PUT')

    <section class="item-details">

        <div class="item-details__image">

            <img id="imagePreview"
                    src="{{ asset('images/product/' . $item->photo) }}"
                    alt="{{ $item->itemName }}">

            <label for="photo">
                Upload New Image
            </label>

            <input type="file"
                   id="photo"
                   name="photo"
                   class="form-input">

        </div>

        <div class="item-details__content">

            <div class="item-details__header">

                <label for="itemName">Product Name</label>

                <input
                    type="text"
                    id="itemName"
                    name="itemName"
                    class="form-input"
                    value="{{ old('itemName', $item->itemName) }}"
                >

            </div>

            <div class="item-details__pricing">

                <div>
                    <label for="price">Price</label>

                    <input
                        type="number"
                        step="0.01"
                        id="price"
                        name="price"
                        class="form-input"
                        value="{{ old('price', $item->price) }}"
                    >
                </div>

                <div>
                    <label for="salePrice">Sale Price</label>

                    <input
                        type="number"
                        step="0.01"
                        id="salePrice"
                        name="salePrice"
                        class="form-input"
                        value="{{ old('salePrice', $item->salePrice) }}"
                    >
                </div>

            </div>

            <div class="item-details__description">

                <h3>Description</h3>

                <textarea
                    id="description"
                    name="description"
                    class="form-input"
                    rows="6"
                >{{ old('description', $item->description) }}</textarea>

            </div>

            <div class="item-details__description">

                <h3>Category</h3>

                <select
                    id="categoryId"
                    name="categoryId"
                    class="form-input">

                    @foreach($categories as $id => $name)
                        <option value="{{ $id }}"
                            {{ old('categoryId', $item->categoryId) == $id ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach

                </select>

            </div>

            <div class="item-details__description">

                <label>
                    <input
                        type="checkbox"
                        name="featured"
                        value="1"
                        {{ old('featured', $item->featured) ? 'checked' : '' }}>
                    Featured Product
                </label>

            </div>

            <div class="item-details__actions">

                <a href="{{ route('admin.items.index') }}"
                   class="button button-secondary">
                    Cancel
                </a>

                <button type="submit"
                        class="button button-primary cursor-pointer">
                    Update Product
                </button>

            </div>

        </div>

    </section>

</form>

@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const photoInput = document.getElementById('photo');
        const preview = document.getElementById('imagePreview');

        photoInput.addEventListener('change', function () {
            const file = this.files[0];

            if (file) {
                preview.src = URL.createObjectURL(file);
            }
        });
    });
</script>