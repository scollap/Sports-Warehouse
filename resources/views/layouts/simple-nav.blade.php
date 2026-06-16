<div class="user-nav">
    <button id="userBtn" onclick="toggleDropdown()" class="nav-link user-btn">
        {{ Auth::user()->name }} ▼
    </button>

    <div id="userDropdown" class="user-dropdown">
        <a href="{{ route('profile.edit') }}">
            <i class="fas fa-user"></i> Profile
        </a>
        <a href="{{ route('admin.categories.index') }}">
            <i class="fas fa-list"></i> Categories
        </a>
        <a href="{{ route('admin.items.index') }}">
            <i class="fas fa-box"></i> Products
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
    </div>
</div>

<script>
function toggleDropdown() {
    const dropdown = document.getElementById('userDropdown');
    if (dropdown.style.display === 'none' || dropdown.style.display === '') {
        dropdown.style.display = 'block';
    } else {
        dropdown.style.display = 'none';
    }
}

// Close dropdown when clicking elsewhere
document.addEventListener('click', function(event) {
    const dropdown = document.getElementById('userDropdown');
    const button = document.getElementById('userBtn');
    
    if (event.target !== button && !button.contains(event.target)) {
        dropdown.style.display = 'none';
    }
});
</script>
