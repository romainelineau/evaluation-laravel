@extends('layouts.app')

@section('content')

<h1 class="text-uppercase text-center font-weight-bold p-2">Nos produits <span>en solde</span></h1>
<div class="mt-2 mb-4 text-center"><i class="fas fa-chevron-down"></i></div>
<div class="row d-flex flex-wrap bg-light bg-white rounded-lg p-2 p-sm-4">
    <div class="col-12 text-right text-black-50 px-4 pt-4">
        <p>{{ $products->total() }} résultat(s)</p>
        <hr>
    </div>
    @forelse ($products as $product)
    <div class="col-12 col-sm-6 col-md-4 p-4">
        <div class="card h-100 p-0 rounded-lg border-0 shadow-sm">
            <a class="text-decoration-none" href="{{ url('produit', $product->id) }}">
                <img class="card-img-top" src="{{ asset('images/' . $product->picture['link']) }}">
                <div class="card-body">
                    <h2 class="card-title text-decoration-none font-weight-bold">{{ $product->name }}</h2>
                    @if ($product->status == "sale")
                    <span class="badge badge-danger">En solde</span>
                    @endif
                    <p class="card-text">{{ $product->price }} <sup class="">€</sup></p>
                </div>
            </a>
        </div>
    </div>
    @empty
    <div class="col-12">Aucun produit publié pour le moment.</div>
    @endforelse
</div>

<div class="row d-flex justify-content-center mt-4">
    {{ $products->links() }}
</div>

@endsection
