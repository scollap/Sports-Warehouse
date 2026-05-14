@extends('layouts.app')

@section('title', 'Home - Sports Warehouse')

@section('content')


            <!-- Main Content -->
                <!-- Logo and search products section -->
                <section class="logo-and-search">
                    <h1 class="logo-and-search__logo" aria-label="SW Sports Warehouse">
                        <img src="images/sports-warehouse-logo.svg" alt="Sports Warehouse Logo">
                    </h1>
                    <form class="product-search" role="search" aria-label="Product Search" action="/search" method="GET">
                        <label for="search-input" class="visually-hidden">Search products</label>
                        <input type="search" id="search-input" name="search" placeholder="Search products">
                        <button type="submit" class="search-button" aria-label="Submit search">
                            <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
                        </button>
                    </form>
                </section>

                <!-- Category Links -->
                <div class="categories">
                    <ul>
                        <li><a href="#">
                                Shoes<i class="fa-solid fa-chevron-right"></i>
                            </a>
                        </li>
                        <li><a href="#">
                                Helmets<i class="fa-solid fa-chevron-right"></i>
                            </a>
                        </li>
                        <li><a href="#">
                                Pants<i class="fa-solid fa-chevron-right"></i>
                            </a>
                        </li>
                        <li><a href="#">
                                Tops<i class="fa-solid fa-chevron-right"></i>
                            </a>
                        </li>
                        <li><a href="#">
                                Balls<i class="fa-solid fa-chevron-right"></i>
                            </a>
                        </li>
                        <li><a href="#">
                                Equipment<i class="fa-solid fa-chevron-right"></i>
                            </a>
                        </li>
                        <li><a href="#">
                                Training gear<i class="fa-solid fa-chevron-right"></i>
                            </a>
                        </li>
                    </ul> 
                </div>

            @include('partials.hero')


    <!-- Featured Products -->
        <div class="white-background">
            <h2 class="orange-bar">Featured products</h2>
        </div>
        <div class="featured-products">
        @if (empty($items))
            <p>No featured products available.</p>
        @else
                @foreach ($items as $item)

                    <article>
                        <img src="{{ $item['image'] }}" alt="{{ $item['alt'] }}">
                        <div>
                            <p class="price orange">{{ $item['Price'] }}</p>
                            @if ($item['discount'])
                                <p class="discount">was <del>{{ $item['discount'] }}</del></p>
                            @endif
                        </div>
                        <h3>{{ $item['description'] }}</h3>
                    </article>
            @endforeach
        @endif
        </div>

            <!-- Brands -->
             <section>
                <h2 class="orange-bar">Our brands and partnerships</h2>
                <div class="brands">
                    <div class="brands-div">
                        <p>These are some of our top brands and partnerships.</p>
                        <p class="brands-div__blue">The best of the best is here.</p>
                    </div>
                    <div class="brands_logo">
                        <ul>
                            <li><img src="images/logo/logo_nike.png" alt="Nike"></li>
                            <li><img src="images/logo/logo_adidas.png" alt="Adidas"></li>
                            <li><img src="images/logo/logo_skins.png" alt="Skins"></li>
                            <li><img src="images/logo/logo_asics.png" alt="Asics"></li>
                            <li><img src="images/logo/logo_newbalance.png" alt="New Balance"></li>
                            <li><img src="images/logo/logo_wilson.png" alt="Wilson"></li>
                        </ul>
                    </div>
                </div>
            </section>

@endsection