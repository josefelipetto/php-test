@extends('layouts.app')

@section('title','Products')


@section('content')
    <div class="container">
        <ul>
            @forelse($products as $product)
                <li>
                    <a href="{{ $product->path() }}"> {{  $product->name }} </a>
                </li>
            @empty
                <li>
                    No products yet.
                </li>
            @endforelse
        </ul>


    </div>
@endsection