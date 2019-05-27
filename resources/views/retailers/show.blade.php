@extends('layouts.app')

@section('title','Retailers')

@section('content')
    <div class="container">
        <div class="buttons are-medium">
            <a href="{{ route('edit-retailer', ['retailer' => $retailer->slug ]) }}" class="button is-primary">
                <span class="icon">
                  <i class="fa fa-edit"></i>
                </span>
                <span>Edit this retailer</span>
            </a>
        </div>
        <div class="box">
            <article class="media">
                <div class="media-left">
                    <figure class="image is-128x128">
                        <img src="{{ $retailer->logo }}" alt="{{ $retailer->name }}">
                    </figure>
                </div>
                <div class="media-content">
                    <div class="content">
                        <p>
                            <strong>
                                {{ $retailer->name }}
                            </strong>

                            <small>
                                <a href="{{ $retailer->website }}">
                                    Website
                                </a>
                            </small>
                            <br>
                            {{ $retailer->description }}
                        </p>
                    </div>
                </div>
            </article>
        </div>

        @component('components.productList', ['products' => $retailer->products()->paginate()])
        @endcomponent

    </div>
@endsection