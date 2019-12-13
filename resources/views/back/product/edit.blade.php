@extends('layouts.master')

@section('content')

<h1 class="text-center m-4">Modifier un produit</h1>

<form action="{{route('produits.update', $product->id)}}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="form-row">
        <div class="form-group py-5 col-12">
            <input class="form-control form-control-lg" name="name" value="{{$product->name}}" type="text" placeholder="Nom du produit">
            @if($errors->has('name'))
            <div class="alert alert-danger mt-2" role="alert">{{$errors->first('name')}}</div>
            @endif
        </div>
    </div>
    <div class="form-row py-3">
        <div class="form-group col-5">
            <label for="referenceProduct">Référence du produit :</label>
            <input type="text" class="form-control" id="referenceProduct" name="reference" value="{{$product->reference}}" placeholder="Code à 16 caractères alphanumériques...">
            @if($errors->has('reference'))
            <div class="alert alert-danger mt-2" role="alert">{{$errors->first('reference')}}</div>
            @endif
        </div>
        <div class="form-group col-4 offset-1">
            <label for="categorieProduct">Catégorie du produit : </label>
            <select class="form-control" id="categorieProduct" name="category_id">
                @forelse($categories as $id => $name)
                <option value="{{$id}}"
                    @if($product->IsCheckedCategory($id))
                    selected
                    @endif
                >{{ucfirst($name)}}</option>
                @empty
                @endforelse
            </select>
            @if($errors->has('category_id'))
            <div class="alert alert-danger mt-2" role="alert">{{$errors->first('category_id')}}</div>
            @endif
        </div>
    </div>
    <div class="form-row py-3">
            <div class="form-group col-2">
                <label for="priceProduct">Prix :</label>
                <div class="d-flex flex-wrap align-items-center">
                    <input type="text" class="form-control w-75" id="priceProduct" name="price" value="{{$product->price}}" placeholder="100.00">
                    <label for="priceProduct" class="m-0 w-25">€</label>
                    @if($errors->has('price'))
                    <div class="alert alert-danger mt-2 w-100" role="alert">{{$errors->first('price')}}</div>
                    @endif
                </div>
            </div>
            <div class="form-group col-3">
                <label for="statusProduct">Le produit est-il en solde ?</label>
                <select class="form-control" id="statusProduct" name="status">
                    <option value="standard"
                        @if($product->status == "standard")
                        selected
                        @endif>Non</option>
                    <option value="sale"
                        @if($product->status == "sale")
                        selected
                        @endif>Oui</option>
                </select>
                @if($errors->has('status'))
                <div class="alert alert-danger mt-2" role="alert">{{$errors->first('status')}}</div>
                @endif
            </div>
            <div class="form-group col-5 offset-1">
                <label for="visibleProduct">Souhaitez-vous publier le produit sur le site ?</label>
                <select class="form-control" id="visibleProduct" name="visible">
                    <option value="published"
                        @if($product->visible == "published")
                        selected
                        @endif>Oui</option>
                    <option value="unpublished"
                        @if($product->visible == "unpublished")
                        selected
                        @endif>Non, je préfère l'enregistrer en brouillon</option>
                </select>
                @if($errors->has('visible'))
                <div class="alert alert-danger mt-2" role="alert">{{$errors->first('visible')}}</div>
                @endif
            </div>
        </div>
    <div class="form-row py-3">
        <div class="form-group col-5">
            <label for="sizesProduct">Sélectionnez les tailles disponibles : </label>
            @forelse($sizes as $key => $size)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="sizes[]" value="{{$key}}" id="size{{$key}}"
                @if($product->IsCheckedSize($key))
                checked
                @endif
                >
                <label class="form-check-label" for="size{{$key}}">
                    {{$size}}
                </label>
            </div>
            @empty
            @endforelse
            @if($errors->has('sizes'))
            <div class="alert alert-danger mt-2" role="alert">{{$errors->first('sizes')}}</div>
            @endif
        </div>
        <div class="form-group col-5 offset-1">
            <label>Image associée :</label>
            <img class="img-fluid" src="{{ asset('images/'. $product->picture['link'])}}">
            <input type="hidden" name="oldPicture" value="{{$product->picture['link']}}">
            <label for="pictureProduct">Modifier l'image :</label>
            <input type="file" class="form-control-file" id="pictureProduct" name="picture">
            @if($errors->has('picture'))
            <div class="alert alert-danger mt-2" role="alert">{{$errors->first('picture')}}</div>
            @endif
        </div>
    </div>
    <div class="form-row py-3">
        <div class="form-group col-12">
            <label for="descriptionProduct">Description du produit : </label>
            <textarea class="form-control" id="descriptionProduct" name="description" rows="3">{{$product->description}}</textarea>
            @if($errors->has('description'))
            <div class="alert alert-danger mt-2" role="alert">{{$errors->first('description')}}</div>
            @endif
        </div>
    </div>
    <hr>
    <div class="form-row py-3 d-flex justify-content-center">
            <button type="submit" class="btn btn-primary" role="button">Mettre à jour le produit</button>
    </div>
</form>

@endsection
