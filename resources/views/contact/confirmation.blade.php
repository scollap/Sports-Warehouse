
<link rel="stylesheet" href="{{ asset('css/form_style.css') }}">
@extends('layouts.app')

@section('title', 'Question Form - Sports Warehouse')

@section('content')

@include('partials._Logo_search')

<div class="mainRegDiv">
  <div class="confirmationDiv">
  <h2>Your Question has been sent 📧</h2>
  <p>Thanks you, We will get in contact with you as soon as we can!</p>
  <p>Please check that your details below are correct.</p>
  <h3>Contact detail summary:</h3>
  <ul>
    <li>Name: {{ $firstName }} {{ $lastName }}</li>
    <li>Email: {{ $email }}</li>
    @if (!empty($phone))
      <li>Phone number: {{ $phone }}</li>
    @endif  
  </ul>

</div>
@endsection