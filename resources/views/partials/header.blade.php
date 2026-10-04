<nav class="navbar navbar-expand-lg bg-white border-bottom shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ url('/') }}">
            <img src="{{ asset('img/logo-back.svg') }}" alt="" height="40">
            <span class="d-flex flex-column lh-1">
                <span class="fs-5">{{ config('app.name', 'Holocron') }}</span>
                <small class="text-uppercase text-body-secondary"
                    style="font-size: 0.5rem; letter-spacing: 0.4em; font-family: 'Exo 2', sans-serif;">
                    Backoffice
                </small>
            </span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">
                        <i class="bi bi-house me-2"></i>{{ __('Home') }}
                    </a>
                </li>

                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-grid me-2"></i>Gestione
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="adminDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.films.index') }}">
                                    <i class="bi bi-film me-2"></i>Film
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.people.index') }}">
                                    <i class="bi bi-person-lines-fill me-2"></i>Personaggi
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.species.index') }}">
                                    <i class="bi bi-bug-fill me-2"></i>Specie
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.planets.index') }}">
                                    <i class="bi bi-globe-europe-africa me-2"></i>Pianeti
                                </a>
                            </li>
                        </ul>
                    </li>
                    <a class="btn btn-sm d-flex align-items-center gap-2"
                        href="{{ config('app.frontend_url') }}" title="Vai al sito pubblico">
                        <i class="bi bi-globe2"></i>
                        Sito pubblico
                    </a>
                @endauth
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ url('/') }}">{{ __('Dashboard') }}</a></li>
                            <li><a class="dropdown-item" href="{{ url('profile') }}">{{ __('Profile') }}</a></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
