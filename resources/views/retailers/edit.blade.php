@extends('layouts.app')

@section('title','Create Product')


@section('content')

<div class="container" style="margin-bottom: 20px; margin-top: 50px;">
    @if($message = \Illuminate\Support\Facades\Session::get('success'))
        <div class="container" style="margin-bottom: 30px;">
            <div class="notification is-success">
                <button class="delete"></button>
                {{ $message }}
            </div>
        </div>
    @endif

    @if ($errors->any())
        <div class="container" style="margin-bottom: 30px;">
            <div class="notification is-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <div class="columns" style="margin-left: 500px;">
        <form method="POST" action="{{ route('update-retailer', ['retailer' => $retailer->slug]) }}" enctype="multipart/form-data">
            @csrf
            {{ method_field('PUT') }}
            <div class="column">
                <div class="field">
                    <p class="control has-icons-left has-icons-right">
                        <input class="input" type="text" placeholder="Name" name="name" value="{{ $retailer->name }}" required autofocus>
                        <span class="icon is-small is-left">
                            <i class="fas fa-plus"></i>
                        </span>

                        <span class="icon is-small is-right">
                            <i class="fas fa-check"></i>
                        </span>
                    </p>
                </div>
                <figure class="image is-128x128" style="margin-bottom: 20px; margin-top: 20px;">
                    <img src="{{ $retailer->logo }}" alt="{{ $retailer->name }}">
                </figure>
                <div class="file" style="margin-bottom: 10px;">
                    <label class="file-label">
                        <input class="file-input" type="file" name="logo">
                        <span class="file-cta">
                            <span class="file-icon">
                                <i class="fas fa-upload"></i>
                            </span>
                            <span class="file-label">
                                Choose a file to the logo
                            </span>
                        </span>
                    </label>
                </div>
                <div class="field">
                    <p class="control has-icons-left has-icons-right">
                        <textarea class="textarea" type="text" placeholder="Description" name="description" required>
                            {{ $retailer->description }}
                        </textarea>
                        <span class="icon is-small is-right">
                            <i class="fas fa-check"></i>
                        </span>
                    </p>
                </div>
                <div class="field">
                    <p class="control has-icons-left has-icons-right">
                        <input class="input" type="text" placeholder="website" name="website" value="{{ $retailer->website }}" required>
                        <span class="icon is-small is-left">
                            <i class="fas fa-plus"></i>
                        </span>

                        <span class="icon is-small is-right">
                            <i class="fas fa-check"></i>
                        </span>
                    </p>
                </div>
                <div class="field">
                    <button type="submit" class="button is-success is-fullwidth">Update</button>
                </div>

            </div>
        </form>

    </div>

</div>
@endsection

