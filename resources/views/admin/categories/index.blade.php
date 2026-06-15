@extends('layouts.app')
@section('title', 'Manage categories')
@section('content')
    <div class="container">
        <h1>Categories</h1>
        {{-- add button to add new category --}}
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary mb-3">Add Category</a>
        @if ($categoryList->count() === 0)
            <div class="container">
                <h1>Categories</h1>
                <p>No categories found.</p>
            </div>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categoryList as $category)
                        <tr>
                            <td>{{ $category->categoryId }}</td>
                            <td>{{ $category->categoryName }}</td>
                            <td>
                                <a href="{{ route('admin.categories.edit', $category->categoryId) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('admin.categories.destroy', $category->categoryId) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection