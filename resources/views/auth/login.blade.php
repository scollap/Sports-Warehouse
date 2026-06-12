@extends('layouts.app')

@section('title', 'Login - Sports Warehouse')

@section('content')

    @include('partials._Logo_search')

    <div class="mainRegDiv">

        <div class="soonDiv">
            <h2>Login to your account</h2>
            <p>
                Access your Sports Warehouse account to view orders, manage details and checkout faster.
            </p>
        </div>

        <div class="formDiv">

            <h2>Login 💬</h2>

            <p>Please enter your email and password to continue.</p>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- LOGIN FORM -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <fieldset>
                    <legend>Sports Warehouse Login</legend>

                    <!-- Email -->
                    <div class="form-row">
                        <label for="email">Email*:</label>

                        <input class="form-input"
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                        >

                        @error('email')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="form-row">
                        <label for="password">Password*:</label>

                        <input class="form-input"
                            id="password"
                            type="password"
                            name="password"
                            required
                        >

                        @error('password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Remember -->
                    <div class="form-row">
                        <label style="display:flex; align-items:center; gap:8px;">
                            <input type="checkbox" name="remember">
                            Remember me
                        </label>
                    </div>

                    <!-- Actions -->
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

{{-- <x-guest-layout>


    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
