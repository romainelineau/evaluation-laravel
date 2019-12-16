@extends('layouts.app')

@section('content')

<h1 class="text-uppercase text-center font-weight-bold p-2">Modifier un <span>produit</span></h1>
<div class="mt-2 mb-4 text-center"><i class="fas fa-chevron-down"></i></div>

<div class="row d-flex flex-wrap bg-light bg-white rounded-lg p-2 p-sm-4">

    <form action="{{route('produits.update', $product->id)}}" method="POST" enctype="multipart/form-data" class="col-12">
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
            <div class="form-group col-12 col-md-5">
                <label for="referenceProduct" class="font-weight-bold">Référence du produit :</label>
                <input type="text" class="form-control" id="referenceProduct" name="reference" value="{{$product->reference}}" placeholder="Code à 16 caractères alphanumériques...">
                @if($errors->has('reference'))
                <div class="alert alert-danger mt-2" role="alert">{{$errors->first('reference')}}</div>
                @endif
            </div>
            <div class="form-group col-12 col-md-4 offset-md-1">
                <label for="categorieProduct" class="font-weight-bold">Catégorie du produit : </label>
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
                <div class="form-group col-12 col-md-2">
                    <label for="priceProduct" class="font-weight-bold">Prix :</label>
                    <div class="input-group mb-2">
                        <input type="text" class="form-control w-75" id="priceProduct" name="price" value="{{$product->price}}" placeholder="Ex : 100.00">
                        <div class="input-group-prepend">
                            <div class="input-group-text">€</div>
                        </div>
                    </div>
                    @if($errors->has('price'))
                    <div class="alert alert-danger mt-2 w-100" role="alert">{{$errors->first('price')}}</div>
                    @endif
                </div>
                <div class="form-group col-12 col-md-3">
                    <label for="statusProduct" class="font-weight-bold">Le produit est-il en solde ?</label>
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
                <div class="form-group col-12 col-md-5 offset-md-1">
                    <label for="visibleProduct" class="font-weight-bold">Souhaitez-vous publier le produit sur le site ?</label>
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
            <div class="form-group col-12 col-md-5">
                <label for="sizesProduct" class="font-weight-bold">Sélectionnez les tailles disponibles : </label>
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
            <div class="form-group col-12 col-md-5 offset-md-1">
                <label class="font-weight-bold">Image associée :</label>
                <img class="img-fluid rounded-lg" src="{{ asset('images/'. $product->picture['link'])}}">
                <input type="hidden" name="oldPicture" value="{{$product->picture['link']}}">
                <label for="pictureProduct" class="font-weight-bold mt-2">Modifier l'image :</label>
                <input type="file" class="form-control-file" id="pictureProduct" name="picture">
                @if($errors->has('picture'))
                <div class="alert alert-danger mt-2" role="alert">{{$errors->first('picture')}}</div>
                @endif
            </div>
        </div>
        <div class="form-row py-3">
            <div class="form-group col-12">
                <label for="descriptionProduct" class="font-weight-bold">Description du produit : </label>
                <textarea class="form-control" id="descriptionProduct" name="description" rows="3">{{$product->description}}</textarea>
                @if($errors->has('description'))
                <div class="alert alert-danger mt-2" role="alert">{{$errors->first('description')}}</div>
                @endif
            </div>
        </div>
        <div class="form-row py-3 d-flex justify-content-center">
            <button type="submit" class="btn btn-primary btn-add-admin font-weight-bold" role="button">Mettre à jour le produit</button>
        </div>
    </form>

</div>

@endsection
