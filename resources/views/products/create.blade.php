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
        <form method="POST" action="{{ route('store-product') }}" enctype="multipart/form-data">
            @csrf
            <div class="column">
                <div class="field">
                    <p class="control has-icons-left has-icons-right">
                        <input class="input" type="text" placeholder="Name" name="name" required autofocus>
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
                        <input class="input" type="number" placeholder="Price" name="price" step="0.01" required>
                        <span class="icon is-small is-left">
                            <i class="fas fa-money-bill-wave"></i>
                        </span>

                        <span class="icon is-small is-right">
                            <i class="fas fa-check"></i>
                        </span>
                    </p>
                </div>
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
                        <textarea class="textarea" type="text" placeholder="Description" name="description" required></textarea>
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
                                    <option value="{{ $retailer->id }}">{{ $retailer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="field">
                    <button type="submit" class="button is-success is-fullwidth">Create</button>
                </div>

            </div>
        </form>

    </div>

</div>
@endsection

