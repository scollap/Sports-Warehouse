@extends('layouts.app')

@section('title', 'Manage Categories')

@section('content')
<div class="mainRegDiv">

    <h1 class="orange-bar">Manage Categories</h1>

    @include('partials._flash-messages')

    <div class="flex justify-between mt-4">
        <a href="{{ route('admin.categories.create') }}" class="buttonBlue">
            Add Category
        </a>

        <a href="{{ route('dashboard') }}" class="buttonBlue">
            Back to Dashboard
        </a>
    </div>

    <div class="formDiv">

        @if ($categoryList->count() === 0)

            <p>No categories found.</p>

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
                    @foreach ($categoryList as $category)
                        <tr>
                            <td>{{ $category->categoryId }}</td>
                            <td>{{ $category->categoryName }}</td>

                            <td class="actions-cell">
                                <a href="{{ route('admin.categories.edit', $category->categoryId) }}"
                                   class="buttonBlue">
                                    Edit
                                </a>

                                <form action="{{ route('admin.categories.destroy', $category->categoryId) }}"
                                      method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="button"
                                            onclick="return confirm('Are you sure you want to delete this category?')">
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