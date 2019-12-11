@extends('layouts.master')

@section('content')

<a href="{{ url('/') }}">Retour</a>
<h1>{{ $product->name }}</h1>
<div class="row d-flex flex-wrap">
    <div class="col">
        <img src="{{ asset('images/' . $product->picture->link) }}">
        <h2></h2>
        <a href="#">{{ $product->category->name }}</a>
        <p>{{ $product->price }}</p>
    </div>
</div>

@endsection
