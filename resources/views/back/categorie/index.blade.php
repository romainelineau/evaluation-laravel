@extends('layouts.app')

@section('content')

<h1 class="text-uppercase text-center font-weight-bold p-2">Administration des <span>catégories</span></h1>
<div class="mt-2 mb-4 text-center"><i class="fas fa-chevron-down"></i></div>

<div class="row d-flex flex-wrap bg-light bg-white rounded-lg p-2 p-sm-4">

    <div class="col-12 text-black-50 pt-2 pb-4">
        <div class="row d-flex align-items-center">
            <div class="col-6">
                <a class="btn btn-primary btn-add-admin font-weight-bold" href="#" role="button">Nouvelle catégorie</a>
            </div>
            <p class="col-6 text-right m-0">{{ $categories->total() }} catégorie(s)</p>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" class="text-center">#</th>
                    <th scope="col">Nom de  la catégorie</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $categorie)
                <tr>
                    <th scope="row" class="text-center">{{ $categorie->id }}</th>
                    <td>{{ $categorie->name }}</td>
                    <td class="text-right table-actions-admin">
                        <a href="#" class="d-inline-block" role="button"><i class="fas fa-edit"></i> Modifier</a>
                        <button type="submit" class="" role="button"><i class="fas fa-trash-alt"></i> Supprimer</button>
                    </td>
                    </td>
                </tr>
                @empty
                <tr>Aucune catégorie pour le moment</tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

<div class="row d-flex justify-content-center mt-4">
    {{ $categories->links() }}
</div>

@endsection

@section('scripts')
    @parent
    <script src="{{asset('js/confirm.js')}}"></script>
@endsection
