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
