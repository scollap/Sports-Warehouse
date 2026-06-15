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
            <p>Please enter your email and password to continue.</p>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <fieldset>
                    <legend>Sports Warehouse Login</legend>
                    <div class="form-row">
                        <label for="email">Email*:</label>
                        <input class="form-input" id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                        @error('email')
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

