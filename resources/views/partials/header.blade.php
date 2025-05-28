<header>
  <div class="logo">🧸 HugsyWugsy</div>

  <!-- Hamburger toggle button, visible only on small screens -->
  <button class="nav-toggle" aria-label="Toggle navigation" aria-expanded="false">
    <span class="hamburger"></span>
  </button>

  <nav>
    <ul>
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
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" title="Logout">
            <i class="fas fa-sign-out-alt" style="font-size: 4vh; color: #ff69b4;"></i>
          </button>
        </form>
      </li>
      @else
      <li><a href="{{ url('/login') }}" class="login-btn">Login</a></li>
      @endauth
    </ul>
  </nav>
</header>

<style>
  /* Base styles for header */
  header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
    background-color: #161b22;
    color: white;
    position: relative;
  }

  .logo {
    font-size: 1.8rem;
    font-weight: bold;
  }

  /* Navigation ul styling */
  nav ul {
    display: flex;
    align-items: center;
    gap: 15px;
    list-style: none;
    padding-left: 0;
    margin: 0;
  }

  /* Nav links */
  nav ul li a,
  nav ul li form button {
    color: white;
    text-decoration: none;
    font-size: 1.2rem;
    transition: color 0.3s;
    background: none;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
  }

  nav ul li a:hover,
  nav ul li form button:hover {
    color: #ff69b4;
  }

  /* Icons size adjustment */
  nav ul li i {
    vertical-align: middle;
  }

  /* Hamburger button - hidden by default */
  .nav-toggle {
    display: none;
    background: none;
    border: none;
    cursor: pointer;
    padding: 5px;
    z-index: 1100;
  }

  .hamburger,
  .hamburger::before,
  .hamburger::after {
    content: "";
    display: block;
    background-color: white;
    height: 3px;
    width: 25px;
    border-radius: 2px;
    position: relative;
    transition: all 0.3s ease;
  }

  .hamburger::before,
  .hamburger::after {
    position: absolute;
    left: 0;
  }

  .hamburger::before {
    top: -8px;
  }

  .hamburger::after {
    top: 8px;
  }

  /* Toggle hamburger to X when open */
  .nav-toggle.open .hamburger {
    background-color: transparent;
  }

  .nav-toggle.open .hamburger::before {
    transform: rotate(45deg);
    top: 0;
  }

  .nav-toggle.open .hamburger::after {
    transform: rotate(-45deg);
    top: 0;
  }

  /* Responsive styles for small screens */
  @media (max-width: 600px) {
    /* Show hamburger button */
    .nav-toggle {
      display: block;
    }

    /* Hide nav menu by default */
    nav ul {
      flex-direction: column;
      position: absolute;
      top: 100%;
      right: 0;
      background-color: #161b22;
      width: 100%;
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.3s ease;
      gap: 10px;
      padding: 0 20px;
      z-index: 1000;
    }

    /* Show nav menu when open */
    nav ul.open {
      max-height: 500px; /* enough height for menu items */
      padding: 10px 20px;
    }

    nav ul li a,
    nav ul li form button {
      font-size: 1.4rem;
      padding: 10px 0;
      width: 100%;
    }
  }
  @media (max-width: 600px) {
  nav ul.open li a,
  nav ul.open li form button {
    color: white;
  }
}
</style>

<script>
  const navToggle = document.querySelector('.nav-toggle');
  const navUl = document.querySelector('nav ul');

  navToggle.addEventListener('click', () => {
    navUl.classList.toggle('open');
    navToggle.classList.toggle('open');

    // Update aria-expanded attribute for accessibility
    const expanded = navToggle.getAttribute('aria-expanded') === 'true' || false;
    navToggle.setAttribute('aria-expanded', !expanded);
  });
</script>
