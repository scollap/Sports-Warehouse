@extends('layouts.app')

@section('title', '404 Not Found')

@section('content')

        <!-- Logo and search products section -->
    @include('partials.logo_search')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">404 Not Found</div>
                    <div class="card-body">
                        <p>The product you are looking for does not exist.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection