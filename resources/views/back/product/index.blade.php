@extends('layouts.app')

@section('content')

<h1 class="text-center m-4">Administration des produits</h1>

<div class="d-flex justify-content-center m-4 pt-4">
    <a class="btn btn-primary" href="{{ route('produits.create') }}" role="button">Ajouter un produit</a>
</div>

<div class="d-flex justify-content-center m-4 pt-4">
    {{$products->links()}}
</div>

@include('back.product.partials.flash')

<table class="table">
    <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nom du produit</th>
            <th scope="col">Catégorie</th>
            <th scope="col">Prix</th>
            <th scope="col">Statut</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($products as $product)
        <tr>
            <th scope="row">{{ $product->id }}</th>
            <td>{{ $product->name }}</td>
            <td>{{ ucfirst($product->category->name?? 'Aucune catégorie') }}</td>
            <td>{{ $product->price }} €</td>
            <td>
                @if($product->visible == 'published')
                <span class="badge badge-success p-1">Publié</span>
                @elseif($product->visible == 'unpublished')
                <span class="badge badge-secondary p-1">Non publié</span>
                @else
                Aucun statut
                @endif
            </td>
            <td>
                <a href="{{ route('produits.edit', $product->id) }}" class="btn btn-secondary" role="button">Modifier</a>
                <form class="delete" method="POST" action="{{route('produits.destroy', $product->id)}}">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-danger" role="button">Supprimer</button>
                </form>
            </td>
            </td>
        </tr>
        @empty
        <tr>Aucune entrée</tr>
        @endforelse
    </tbody>
</table>
@endsection

@section('scripts')
    @parent
    <script src="{{asset('js/confirm.js')}}"></script>
@endsection
