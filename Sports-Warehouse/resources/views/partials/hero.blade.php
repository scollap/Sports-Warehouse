<div class="hero-banner">
    <img src="{{ asset('images/Bannerimage.svg') }}" alt="Banner for Sports warehouse">

    <div class="hero-banner__dots">
        <span class="dot"></span>
        <span class="dot"></span>
        <span class="dot"></span>
    </div>

    <div class="hero-banner__promo">
        <div class="hero-banner__text">
            <p>View our brand<br>new range of</p>

            <h2>Sports<br>balls</h2>
            <!-- link that does search for balls -->
            <a href="{{ route('search', ['search' => 'balls']) }}" class="button">Shop now</a>
        </div>
    </div>
</div>