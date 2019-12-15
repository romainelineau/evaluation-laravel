@extends('layouts.app')

@section('content')

<div class="page-product">

        <a href="{{ url('/') }}" class="btn btn-outline-primary"><i class="fas fa-chevron-left"></i> Retour aux produits</a>
        <h1 class="py-4">{{ $product->name }}</h1>
        <div class="row d-flex flex-wrap">
            <div class="col-12 col-md-6">
                <img src="{{ asset('images/' . $product->picture['link']) }}" class="img-fluid rounded-lg">
            </div>
            <div class="col-12 col-md-6 mt-4 mt-md-0">
                <div class="card card-product">
                    <div class="card-header">
                        <h2 class="m-0 font-weight-bold text-uppercase">Référence : {{ $product->reference }}</h2>
                    </div>
                    <div class="card-body">
                        @if ($product->status == "sale")
                        <span class="badge badge-danger">En solde</span>
                        @endif
                        <p class="card-text mt-1">{{ $product->price }} <sup>€</sup></p>
                        <p><i class="fas fa-tags"></i> Tailles disponibles :
                            @forelse ($product->sizes as $size)<span class="size-span d-inline-block text-center px-2 py-1 mx-1">{{ $size->name }}</span>@empty
                            Aucune taille disponible
                            @endforelse
                        </p>
                        <button class="btn btn-primary font-weight-bold mb-3"><i class="fas fa-shopping-bag"></i> Ajouter au panier</button>
                    </div>
                    <div class="card-footer">
                        <p class="card-product-category m-0"><i class="fas fa-globe"></i> <a href="/categorie/{{ $product->category->id }}" class="">Consulter d'autres produits pour {{ $product->category->name }}</a></p>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-4">
                <div class="card card-description">
                    <div class="card-header">
                        <h2 class="m-0 font-weight-bold text-uppercase">Description</h2>
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{ $product->description }}</p>
                    </div>
                </div>
            </div>
        </div>

</div>

@endsection
