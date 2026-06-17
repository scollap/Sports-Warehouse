@extends('layouts.app')

@section('title', 'Admin Dashboard - Sports Warehouse')

@section('content')

    @include('partials._Logo_search')
    @include('partials._categories')

    <div class="mainRegDiv">
        <h1 class="orange-bar">Staff Dashboard</h1>

        <div class="dashboard-grid">

            <div class="dashboard-card">
                <div class="dashboard-card__icon">👟</div>
                <h3 class="dashboard-card__title">Products</h3>
                <p class="dashboard-card__text">Add, update, or remove items from the store.</p>
                <a href="{{ route('admin.items.index') }}" class="buttonBlue">Manage Products</a>
            </div>

            <div class="dashboard-card">
                <div class="dashboard-card__icon">📁</div>
                <h3 class="dashboard-card__title">Categories</h3>
                <p class="dashboard-card__text">Organize your products into different categories.</p>
                <a href="{{ route('admin.categories.index') }}" class="buttonBlue">Manage Categories</a>
            </div>

            <div class="dashboard-card">
                <div class="dashboard-card__icon">👤</div>
                <h3 class="dashboard-card__title">My Profile</h3>
                <p class="dashboard-card__text">Update your personal details or change your password.</p>
                <a href="{{ route('profile.edit') }}" class="buttonBlue">Edit Profile</a>
            </div>

        </div>
    </div>

@endsection
