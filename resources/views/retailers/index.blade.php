@extends('layouts.app')

@section('title','Retailers')

@section('content')
    <div class="container">
        <ul>
            @forelse($retailers as $retailer)
                <li>
                    <a href="{{ $retailer->path() }}">{{ $retailer->name }}</a>
                </li>
            @empty
                <li> No retailers yet </li>
            @endforelse
        </ul>
    </div>
@endsection