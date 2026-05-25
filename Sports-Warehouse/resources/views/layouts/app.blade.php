<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title', 'SW Warehouse')</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/modern-normalize@3.0.1/modern-normalize.min.css">
        {{-- <link rel="stylesheet" href="{{ asset('styles/style.css') }}"> not needed with tailwind --}}
        @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- to use css tailwind -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="site-wrapper">
            <!-- Header and Navigation -->
            <header> 
                <nav class="topnav" id="myTopnav">
                    <ul>
                        <li class="icon-item">
                            <a href="#" id="toggleBtn">
                                <i class="fas fa-bars" id="menuIcon"></i>
                            </a>
                        </li>
                        <li class="menu-text"><a href="#" id="toggleTxt">Menu</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}"><i class="fa-regular fa-circle"></i> Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#"><i class="fa-regular fa-circle"></i> About SW</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('register.index') }}"><i class="fa-regular fa-circle"></i> Contact Us</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('products.index') }}"><i class="fa-regular fa-circle"></i> View Products</a></li>
                        <li class="nav-item login-item"><a class="nav-link" href="#"><i class="fas fa-lock"></i> Login</a></li>
                        <li class="cart-item"><a class="nav-link" href="#"><i class="fas fa-shopping-cart"></i> View Cart</a></li>
                        <li class="items-count"><span>0 Items</span></li>
                    </ul>
                </nav>
            </header>

        {{-- add content here for all pages --}}
        <main class="main-section">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer>
            <section class="footer-container">
                <div class="footer-nav">
                    <h3>Site navigation</h3>
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="#">About SW</a></li>
                        <li><a href="{{ route('register.index') }}">Contact US</a></li>
                        {{-- make view producs link to rout that displays all products --}}
                        <li><a href="{{ route('products.index') }}">View products</a></li>
                        <li><a href="#">Privacy policy</a></li>
                    </ul>
                </div>
                <div class="footer-categories">
                {{-- Add section to display all categories in footer --}}
                @if (empty($categories))
                    <p>No categories available.</p>
                @else
                    <ul>
                        @foreach ($categories as $id => $name)
                            <li><a href="{{ route('category.show', $id) }}">{{ $name }}</a></li>
                        @endforeach
                    </ul>
                @endif
                </div> 

                <div class="footer-socials">
                    <h3>Contact Sports Warehouse</h3>
                    <ul>
                        <li>
                            <a href="#" aria-label="Facebook">
                                <i class="fa-brands fa-facebook-f"></i>
                                <span>Facebook</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" aria-label="Twitter">
                                <i class="fa-brands fa-twitter"></i>
                                <span>Twitter</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" aria-label="Email">
                                <i class="fa-solid fa-paper-plane"></i>
                                <span>Other</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </section>
            <div class="footer-copyright">
                <p>&copy; Copyright {{ date('Y') }} Sports Warehouse.</p>
                <p>All rights reserved. </p>
                <p>Website made by Awesomesauce Design and Thomas Scollay</p>
            </div>
        </footer>
        {{-- <script src="scripts/script.js"></script> not needed with tailwind --}}
        </div>
    </body>
</html>