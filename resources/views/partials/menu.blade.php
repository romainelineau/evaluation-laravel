<nav class="navbar sticky-top navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand font-weight-bold" href="{{ route('home-front') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <!-- Admin Links -->
                @if (Route::is('produits.*') || Route::is('categories.*'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('produits.index') }}">Produits</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('categories.index') }}">Catégories</a>
                </li>
                <!-- Front Links -->
                @else
                    @if (!Route::is('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('soldes') }}">Soldes</a>
                    </li>
                    @foreach ($categoriesMenu as $key => $categorieMenu)
                    <li class="nav-item">
                        <a class="nav-link" href="/categorie/{{ $key }}">{{ ucfirst($categorieMenu) }}</a>
                    </li>
                    @endforeach
                    @endif
                @endif
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Homepage Link -->
                @if (Route::is('produits.*') || Route::is('categories.*'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home-front') }}">Retour sur le site</a>
                </li>
                @endif
                <!-- Logout Link -->
                @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Se déconnecter</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                        {{ csrf_field() }}
                    </form>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

{{--
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{ route('home-front') }}">We Fashion</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            @if (Route::is('produits.*') || Route::is('categories.*'))
            <a class="nav-item nav-link" href="{{ route('produits.index') }}">Produits</a>
            <a class="nav-item nav-link" href="{{ route('categories.index') }}">Catégories</a>
            <a class="nav-item nav-link" href="{{ route('home-front') }}">Retour sur le site</a>
            <li><a
                class="nav-item nav-link"
                href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
            >Se déconnecter</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                {{ csrf_field() }}
            </form>
            @else
            <a class="nav-item nav-link" href="{{ route('soldes') }}">Soldes</a>
            @foreach ($categoriesMenu as $key => $categorieMenu)
            <a class="nav-item nav-link" href="/categorie/{{ $key }}">{{ ucfirst($categorieMenu) }}</a>
            @endforeach
            @endif
        </div>
    </div>
</nav>
--}}
