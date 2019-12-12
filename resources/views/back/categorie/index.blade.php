@extends('layouts.master')

@section('content')

<h1 class="text-center m-4">Administration des catégories</h1>

<div class="d-flex justify-content-center m-4 pt-4">
    <a class="btn btn-primary" href="" role="button">Ajouter une catégorie</a>
</div>

<div class="d-flex justify-content-center m-4 pt-4">
    {{$categories->links()}}
</div>

<table class="table">
    <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nom de la catégorie</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($categories as $categorie)
        <tr>
            <th scope="row">{{ $categorie->id }}</th>
            <td>{{ $categorie->name }}</td>
            <td>
                <a href="" class="btn btn-secondary" role="button">Modifier</a>
                <form class="delete" method="POST" action="">
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
