@extends('layouts.app')

@section('title', 'Login - Sports Warehouse')

@section('content')

    @include('partials._Logo_search')

    <div class="mainRegDiv">

        <div class="soDiv">
            <h2>Login to your account</h2>
            <p>Access your Sports Warehouse account to view orders, manage details and checkout faster.</p>
        </div>

        <div class="formDiv">

            <h2>Login 💬</h2>
            <p>Please enter your username and password to continue.</p>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <fieldset>
                    <legend>Sports Warehouse Login</legend>
                    <div class="form-row">
                        <label for="name">Username*:</label>
                        <input class="form-input" id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
                        @error('name')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-row">
                        <label for="password">Password*:</label>
                        <input class="form-input" id="password" type="password" name="password" required>
                        @error('password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-row">
                        <label style="display:flex; align-items:center; gap:8px;">
                            <input type="checkbox" name="remember">
                            Remember me
                        </label>
                    </div>
                    <div class="form-row">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">
                                Forgot password?
                            </a>
                        @endif
                        <button class="button" type="submit">
                            Log in
                        </button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>

@endsection

