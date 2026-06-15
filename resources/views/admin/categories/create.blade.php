@extends('layouts.app')
@section('title', 'Add new category')
@section('content')
    <div class="container">
        <h1>Add New Category</h1>
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="categoryName">Category Name</label>
                <input type="text" class="form-control" id="categoryName" name="categoryName" value="{{ old('categoryName') }}" required>
                @error('categoryName')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Add Category</button>
                <a href="{{ route('admin.categories.index') }}" class="button">Cancel</a>
            <div>
        </form>
    </div>
@endsection
