@extends('layouts.master')

@section('content')

<h1>Tous les articles soldés</h1>
<div class="row d-flex flex-wrap">
    <div class="col-12">{{ $products->total() }} résultat(s)</div>
    @forelse ($products as $product)
    <div class="col-4">
        <img src="{{ asset('images/' . $product->picture->link) }}">
    <h2><a href="{{ url('produit', $product->id) }}">{{ $product->name }}</a></h2>
        <a href="#">{{ $product->category->name }}</a>
        <p>{{ $product->price }}</p>
    </div>
    @empty
    <div class="col">Aucun article publié pour le moment.</div>
    @endforelse
</div>
{{ $products->links() }}

@endsection
