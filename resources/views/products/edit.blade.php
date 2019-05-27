@extends('layouts.app')

@section('title','Create Product')


@section('content')

<div class="container" style="margin-bottom: 20px; margin-top: 50px;">
    @if ($errors->any())
        <div class="notification is-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="columns" style="margin-left: 500px;">
        <form method="POST" action="{{ route('update-product', ['product' => $product->slug]) }}" enctype="multipart/form-data">
            {{ method_field('PUT') }}
            @csrf
            <div class="column">
                <div class="field">
                    <p class="control has-icons-left has-icons-right">
                        <input class="input" type="text" placeholder="Name" name="name" value="{{ $product->name }}" required autofocus>
                        <span class="icon is-small is-left">
                            <i class="fas fa-plus"></i>
                        </span>

                        <span class="icon is-small is-right">
                            <i class="fas fa-check"></i>
                        </span>
                    </p>
                </div>
                <div class="field">
                    <p class="control has-icons-left has-icons-right">
                        <input class="input" type="number" placeholder="Price" name="price" value="{{ $product->price }}" step="0.01" required>
                        <span class="icon is-small is-left">
                            <i class="fas fa-money-bill-wave"></i>
                        </span>

                        <span class="icon is-small is-right">
                            <i class="fas fa-check"></i>
                        </span>
                    </p>
                </div>

                <figure class="image is-128x128" style="margin-bottom: 20px; margin-top: 20px;">
                    <img src="{{ $product->image }}" alt="{{ $product->name }}">
                </figure>

                <div class="file" style="margin-bottom: 10px;">
                    <label class="file-label">
                        <input class="file-input" type="file" name="image">
                        <span class="file-cta">
                            <span class="file-icon">
                                <i class="fas fa-upload"></i>
                            </span>
                            <span class="file-label">
                                Choose a file to the product's image…
                            </span>
                        </span>
                    </label>
                </div>
                <div class="field">
                    <p class="control has-icons-left has-icons-right">
                        <textarea class="textarea" type="text" placeholder="Description" name="description" required>
                            {{ $product->description }}
                        </textarea>
                        <span class="icon is-small is-right">
                            <i class="fas fa-check"></i>
                        </span>
                    </p>
                </div>
                <div class="field">
                    <div class="control">
                        <div class="select">
                            <select name="retailer_id">
                                <option>Select a retailer</option>
                                @foreach($retailers as $retailer)
                                    @if($retailer->id !== $product->retailer->id)
                                    <option value="{{ $retailer->id }}">{{ $retailer->name }}</option>
                                    @else
                                    <option value="{{ $retailer->id }}" selected>{{ $retailer->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="field">
                    <button type="submit" class="button is-success is-fullwidth">Update</button>
                </div>

            </div>
        </form>

    </div>

</div>
@endsection

