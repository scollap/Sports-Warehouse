{{-- include the css form_style.css --}}
<link rel="stylesheet" href="{{ asset('css/form_style.css') }}">

@extends('layouts.app')

@section('title', 'Question Form - Sports Warehouse')

@section('content')

    <!-- Logo and search products section -->
    @include('partials._Logo_search')

<div class="mainRegDiv">
    <div class="soonDiv">
        <h2>Contact US form!</h2>
        <p>Were bring you a wide range of high-quality sports equipment, apparel, and accessories for all your favourite sports. have a question ask our team here!</p>
    </div>

    <div class="formDiv">
        <h2>Question form 💬</h2>

        <p>
            If you have any questions, we would love to hear from you,
            please complete the following information.
        </p>

        @if ($errors->any())
            <div class="error-summary">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register.submit') }}" method="POST" novalidate>

            @csrf

            <fieldset>
                <legend>Sports Warehouse</legend>

                <div class="form-row">
                    <label for="firstName">First name*:</label>

                    <input class='form-input'
                        type="text"
                        id="firstName"
                        name="firstName"
                        required
                        value="{{ old('firstName') }}"
                    >

                    @error('firstName')
                        <span class="error-message">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="form-row">
                    <label for="lastName">Last name*:</label>

                    <input class='form-input'
                        type="text"
                        id="lastName"
                        name="lastName"
                        required
                        value="{{ old('lastName') }}"
                    >

                    @error('lastName')
                        <span class="error-message">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="form-row">
                    <label for="phone">Phone:</label>

                    <input class='form-input'
                        type="text"
                        id="phone"
                        name="phone"
                        placeholder="0402 123 123"
                        value="{{ old('phone') }}"
                    >

                    @error('phone')
                        <span class="error-message">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="form-row">
                    <label for="email">Email*:</label>

                    <input class='form-input'
                        type="email"
                        id="email"
                        name="email"
                        placeholder="name@email.com"
                        required
                        value="{{ old('email') }}"
                    >

                    @error('email')
                        <span class="error-message">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="form-row">
                    <label for="comments">Question?:</label>

                    <textarea class='form-input'  
                        id="comments"
                        name="comments"
                        cols="30"
                        rows="4"
                    >{{ old('comments') }}</textarea>
                </div>

                <div class="form-row">
                    <button type="submit">
                        Submit
                    </button>
                </div>

            </fieldset>
        </form>
    </div>
</div>
@endsection