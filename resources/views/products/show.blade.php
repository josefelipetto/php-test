@extends('layouts.app')

@section('title','Products')

@section('content')




    <div class="container">
        <div class="buttons are-medium">
            <a href="{{ route('edit-product', ['product' => $product->slug ]) }}" class="button is-primary">
                <span class="icon">
                  <i class="fa fa-edit"></i>
                </span>
                <span>Edit this product</span>
            </a>
        </div>
        <div class="box" style="margin-bottom: 50px;">
            <article class="media">
                <div class="media-left">
                    <figure class="image is-128x128">
                        <img src="{{ $product->image }}" alt="{{ $product->name }}">
                    </figure>
                </div>
                <div class="media-content">
                    <div class="content">
                        <p>
                            <strong class="title">
                                {{ $product->name }}
                            </strong>
                            <small>
                                $ {{ $product->price }}
                            </small>

                            <br>
                            <br>

                            {{ $product->description }}
                        </p>
                    </div>
                </div>
            </article>
        </div>


        <p class="subtitle is-4">To get more info about this product, type your e-mail here </p>

        <form method="post" action="{{ route('subscription', ['product' => $product->slug]) }}">
            <div class="field is-grouped" style="margin-bottom: 20px;">
                <p class="control is-expanded has-icons-left">
                    <input class="input is-large" type="text" placeholder="Your e-mail" name="email">
                    <span class="icon is-small is-left">
                    <i class="fa fa-envelope"></i>
                </span>
                </p>
                <p class="control">
                    <button type="submit" class="button is-info is-large">
                        Send
                    </button>
                </p>
            </div>
            {{ csrf_field() }}
            <input type="hidden" name="product_id" value="{{ $product->id }}">
        </form>
    </div>
@endsection