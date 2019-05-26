@extends('layouts.app')

@section('title','Products')

@section('content')
    <div class="container">
        <h1> {{ $product->name  }}</h1>
        <div> {{ $product->price }} </div>
        <div> {{ $product->image }} </div>
        <div> {{ $product->description }} </div>
        <div> {{ $product->retailer_id }} </div>
    </div>
@endsection