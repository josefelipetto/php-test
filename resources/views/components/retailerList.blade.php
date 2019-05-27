{{-- This component accepts a LengthAwarePaginator instance and loop it to create a product list --}}
@forelse($retailers->chunk(4) as $chunk)
    <div class="columns">
        @foreach($chunk as $retailer)
            <div class="column is-3">
                <div class="card">
                    <div class="card-image">
                        <a href="{{ $retailer->path() }}">
                            <figure class="image is-4by3">
                                <img src="{{ $retailer->logo }}" alt="{{ $retailer->name }}">
                            </figure>
                        </a>
                    </div>

                    <div class="card-content">
                        <p class="title">
                            <a href="{{ $retailer->path() }}">
                                {{ $retailer->name }}
                            </a>
                        </p>

                        <p class="title is-4">
                            <a href="{{ $retailer->website }}"> Website </a>
                        </p>

                        <div class="content">
                            {{ substr($retailer->description,0,100) }}...
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@empty
    <h1> No products yet. </h1>
@endforelse

@php
    $numberOfPages = ceil($retailers->total() / $retailers->perPage());
@endphp

<nav class="pagination is-centered" role="navigation" aria-label="pagination" style="margin-bottom: 20px;">
    <a href="{{ $retailers->previousPageUrl() }}" class="pagination-previous">Previous</a>
    <a href="{{ $retailers->nextPageUrl() }}" class="pagination-next">Next page</a>
    <ul class="pagination-list">
        @for($page = 1; $page <= $numberOfPages; $page++)
            <li>
                <a href="{{ Request::url() }}?page={{ $page }}"
                   class="pagination-link {{ $page === $retailers->currentPage() ? 'is-current' : '' }}"
                   aria-label="Goto page {{ $page }}"
                >
                    {{ $page }}
                </a>
            </li>
        @endfor
    </ul>
</nav>
