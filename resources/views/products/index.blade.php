@extends('layouts.app')

@section('title','Products')


@section('content')

    <div class="container">
        <div class="buttons are-medium">
            <a href="{{ route('create-product') }}" class="button is-primary">
                <span class="icon">
                  <i class="fa fa-plus"></i>
                </span>
                <span>New Product</span>
            </a>
        </div>
        @component('components.productList', ['products' => $products])

        @endcomponent
    </div>
@endsection