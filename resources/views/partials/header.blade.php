<header>
    <div class="logo">🧸 HugsyWugsy</div>
    <nav>
        <ul style="display: flex; align-items: center; gap: 15px; list-style: none;">
            <li><a href="{{ url('/') }}">Home</a></li>
            <li><a href="{{ url('/shop') }}">Shop</a></li>
           
            <li><a href="{{ url('/about') }}">About</a></li>
            <li><a href="{{ url('/contact') }}">Contact Us</a></li>

            @auth
             
                <li>
                    <a href="{{ url('/wishlist') }}">
                        <i class="fas fa-heart" style="color: #ff69b4; font-size: 4vh;"></i>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/profile') }}" class="profile-btn">
                        <i class="fas fa-user-circle" style="font-size: 6vh;"></i>
                    </a>
                </li>
                <li>
    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
        @csrf
        <button type="submit" style="background: none; border: none; padding: 0; font: inherit; color: inherit; cursor: pointer;">
            <i class="fas fa-sign-out-alt" style="font-size: 4vh; color: #ff69b4;" title="Logout"></i>
        </button>
    </form>
</li>
            @else
                <li><a href="{{ url('/login') }}" class="login-btn">Login</a></li>
            @endauth
        </ul>
    </nav>
</header>
