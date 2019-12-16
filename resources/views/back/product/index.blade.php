@extends('layouts.app')

@section('content')

<h1 class="text-uppercase text-center font-weight-bold p-2">Administration des <span>produits</span></h1>
<div class="mt-2 mb-4 text-center"><i class="fas fa-chevron-down"></i></div>

<div class="row d-flex flex-wrap bg-light bg-white rounded-lg p-2 p-sm-4">

    <div class="col-12 text-black-50 pt-2 pb-4">
        <div class="row d-flex align-items-center">
            <div class="col-6">
                <a class="btn btn-primary btn-add-admin font-weight-bold" href="{{ route('produits.create') }}" role="button">Nouveau produit</a>
            </div>
            <p class="col-6 text-right m-0">{{ $products->total() }} produit(s)</p>
        </div>
    </div>

    @include('back.product.partials.flash')

    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" class="text-center">#</th>
                    <th scope="col">Nom du produit</th>
                    <th scope="col" class="text-center">Catégorie</th>
                    <th scope="col" class="text-center">Prix</th>
                    <th scope="col" class="text-center">Statut</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr>
                    <th scope="row" class="text-center">{{ $product->id }}</th>
                    <td>{{ $product->name }}</td>
                    <td class="text-center">{{ ucfirst($product->category->name?? 'Aucune catégorie') }}</td>
                    <td class="text-center">{{ $product->price }} €</td>
                    <td class="text-center">
                        @if($product->visible == 'published')
                        <span class="badge badge-success p-1">Publié</span>
                        @elseif($product->visible == 'unpublished')
                        <span class="badge badge-secondary p-1">Non publié</span>
                        @else
                        Aucun statut
                        @endif
                    </td>
                    <td class="text-right table-actions-admin">
                        <a href="{{ route('produits.edit', $product->id) }}" class="d-inline-block" role="button"><i class="fas fa-edit"></i> Modifier</a>
                        <form class="delete d-inline-block" method="POST" action="{{route('produits.destroy', $product->id)}}">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="" role="button"><i class="fas fa-trash-alt"></i> Supprimer</button>
                        </form>
                    </td>
                    </td>
                </tr>
                @empty
                <tr>Aucun produit pour le moment</tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

<div class="row d-flex justify-content-center mt-4">
    {{ $products->links() }}
</div>

@endsection

@section('scripts')
    @parent
    <script src="{{asset('js/confirm.js')}}"></script>
@endsection
