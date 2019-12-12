@extends('layouts.master')

@section('content')

<a href="{{ url('/') }}">Retour</a>
<h1>{{ $product->name }}</h1>
<div class="row d-flex flex-wrap">
    <div class="col">
        <img src="{{ asset('images/' . $product->picture['link']) }}" class="float-left pr-5">
        <p>Référence : {{ $product->reference }}</p>
        <p>Catégorie : <a href="#">{{ $product->category->name }}</a></p>
        <p>Tailles disponibles :
            @forelse ($product->sizes as $size)
            {{ $size->name }}
            @if ($loop->last == false)
                <span> | </span>
            @endif
            @empty
                Aucune taille disponible
            @endforelse
        </p>
        <p>Prix : {{ $product->price }} €</p>
        <button class="btn btn-primary">Ajouter au panier</button>
    </div>
    <div class="col-12">
        <h2>Description</h2>
        <hr>
        <p>{{ $product->description }}</p>
    </div>
</div>

@endsection
