@extends('layouts.app')

@section('title', 'Home')

@section('content')


            <!-- Main Content -->
            <main class="main-section">
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

                <!-- Hero / Banner -->
                <div class="hero-banner">
                    <img src="images/Bannerimage.svg" alt="Banner for Sports warehouse">
                    <div class="hero-banner__dots">
                        <span class="dot"></span>
                        <span class="dot"></span>
                        <span class="dot"></span>
                    </div>
                    <div class="hero-banner__promo">
                        <div class="hero-banner__text">
                            <p>View our brand<br>new range of</p>
                            <h2>Sports<br>balls</h2>
                            <a href="#" class="button">Shop now</a>
                        </div>
                    </div>
                </div>


    <!-- Featured Products -->
        <div class="white-background">
            <h2 class="orange-bar">Featured products</h2>
        </div>
        <div class="featured-products">
            <article>
                <img src="images/product/soccerBall.jpg" alt="Top Scorer Ball">
                <div>
                    <p class="price orange">$34.95</p>
                    <p class="discount">was <del>$46.00</del></p>
                </div>
                <h3>adidas Euro16 Top Soccer Ball</h3>
            </article>
            <article>
                <img src="images/product/skateHelmet.jpg" alt="Player Classic Skate Helmet">
                <p class="price">$70.00</p>
                <h3>Pro-tec Classic Skate Helmet</h3>
            </article>
            <article>
                <img src="images/product/waterBottle.jpg" alt="Water Bottle">
                <div>
                    <p class="price orange">$15.00</p>
                    <p class="discount">was <del>$17.50</del></p>
                </div>
                <h3>Nike Sport 600ml Water Bottle</h3>
            </article>
            <article>
                <img src="images/product/boxingGloves.jpg" alt="Amprotex Boxing Gloves">             
                <p class="price">$79.95</p>
                <h3>Sting ArmaPlus Boxing Gloves</h3>
            </article>
            <article>
                <img src="images/product/footyBoots.jpg" alt="Footy Boots">
                <div>
                    <p class="price orange">$15.00</p>
                    <p class="discount">was <del>$17.50</del></p>
                </div>
                <h3>Asics Gel Lethal Tigreor 8 IT Mens's</h3>
            </article>
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

        </main>

@endsection