@extends('layouts.app')

@section('title','Retailers')

@section('content')


    <div class="container">
        <div class="buttons are-medium">
            <a href="{{ route('create-retailer') }}" class="button is-primary">
                <span class="icon">
                  <i class="fa fa-plus"></i>
                </span>
                <span>New retailer</span>
            </a>
        </div>

        @component('components.retailerList', ['retailers' => $retailers])

        @endcomponent
    </div>
@endsection