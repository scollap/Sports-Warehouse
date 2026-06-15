@extends('layouts.app')

@section('title', 'Add New Product')

@section('content')
<div class="mainRegDiv">

    <h1 class="orange-bar">Add New Product</h1>

    <div class="formDiv">

        <form action="{{ route('admin.items.store') }}"
              method="POST">

            @csrf

            <div>
                <label class="block font-medium text-sm text-gray-700"
                       for="itemName">
                    Product Name
                </label>

                <input
                    type="text"
                    id="itemName"
                    name="itemName"
                    class="form-input"
                    value="{{ old('itemName') }}"
                    required
                >

                @error('itemName')
                    <p class="text-danger mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-4 mt-5">
                <button type="submit" class="buttonBlue">
                    Add Product
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