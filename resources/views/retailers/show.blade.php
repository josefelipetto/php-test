@extends('layouts.app')

@section('title','Retailers')

@section('content')
    <div class="container">
        <h1> {{ $retailer->name  }}</h1>
        <div> {{ $retailer->logo }} </div>
        <div> {{ $retailer->description }} </div>
        <div> {{ $retailer->website }} </div>
    </div>
@endsection