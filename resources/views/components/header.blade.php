<header class="navbar">
    <nav class="navbar-container">
        <div class="left">
            <a href="{{ url('/') }}">
                <img src="{{ asset('img/logoWeb.png') }}" alt="Logo" class="logo-web">
            </a>
        </div>

        <ul class="navbar-item">
            <li><a class="menu-link" href="{{ url('/flights') }}">Vuelos</a></li>
        </ul>

        <div class="right login">
            <ul class="navbar-nav ms-auto">
                <div class="right login">
                    @guest
                        @if (Route::has('login') || Route::has('register'))
                            <div class="auth-links">                                                                                                               
                                @if (Route::has('login'))
                                    <a class="menu-link auth-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                @endif
                
                                @if (Route::has('register'))
                                    <a class="menu-link auth-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                @endif
                            </div>
                        @endif
                    @else
                        <div class="dropdown">
                            <img src="{{ asset('img/user.png') }}" alt="Profile" class="profile-pic">
                            <div class="dropdown-content">
                                <a href="/mis-reservas">Mis Reservas</a>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>
            </ul>
        </div>
    </nav>
</header>
