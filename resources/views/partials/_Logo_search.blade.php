<section class="logo-and-search">
    <h1 class="logo-and-search__logo" aria-label="SW Sports Warehouse">
        <a href="{{ route('home') }}">
            <img src="{{ asset('images/sports-warehouse-logo.svg') }}" alt="Sports Warehouse Logo">
        </a>
    </h1>
    <form class="product-search" role="search" aria-label="Product Search" action="{{ route('search') }}" method="GET">
        <label for="search-input" class="visually-hidden">Search products</label>
        <input type="search" id="search-input" name="search" placeholder="Search products">
        <button type="submit" class="search-button" aria-label="Submit search">
            <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
        </button>
    </form>
</section>