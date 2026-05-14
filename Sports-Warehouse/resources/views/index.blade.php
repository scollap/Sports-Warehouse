<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SW Sports Warehouse</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/modern-normalize@3.0.1/modern-normalize.min.css">
        <link rel="stylesheet" href="styles/style.css">
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
                        <li class="nav-item"><a class="nav-link" href="#"><i class="fa-regular fa-circle"></i> Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#"><i class="fa-regular fa-circle"></i> About SW</a></li>
                        <li class="nav-item"><a class="nav-link" href="#"><i class="fa-regular fa-circle"></i> Contact Us</a></li>
                        <li class="nav-item"><a class="nav-link" href="#"><i class="fa-regular fa-circle"></i> View Products</a></li>
                        <li class="nav-item login-item"><a class="nav-link" href="#"><i class="fas fa-lock"></i> Login</a></li>
                        <li class="cart-item"><a class="nav-link" href="#"><i class="fas fa-shopping-cart"></i> View Cart</a></li>
                        <li class="items-count"><span>0 Items</span></li>
                    </ul>
                </nav>
            </header>
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

        <!-- Footer -->
        <footer>
            <section class="footer-container">
                <div class="footer-nav">
                    <h3>Site navigation</h3>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About SW</a></li>
                        <li><a href="#">Contact US</a></li>
                        <li><a href="#">View products</a></li>
                        <li><a href="#">Privacy policy</a></li>
                    </ul>
                </div>
                <div class="footer-categories">
                <h3>Product categories</h3>
                    <ul>
                        <li><a href="#">Shoes</a></li>
                        <li><a href="#">Helmets</a></li>
                        <li><a href="#">Tops</a></li>
                        <li><a href="#">Balls</a></li>
                        <li><a href="#">Equipment</a></li>
                        <li><a href="#">Training Gear</a></li>
                    </ul>
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
                <p>&copy; Copyright 222 Sports Warehouse.</p>
                <p>All rights reserved. </p>
                <p>Website made by Awesomesauce Design and Thomas Scollay</p>
            </div>
        </footer>
        <script src="scripts/script.js"></script>
        </div>
    </body>
</html>