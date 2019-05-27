{{-- This component accepts a LengthAwarePaginator instance and loop it to create a product list --}}
@forelse($products->chunk(4) as $chunk)
    <div class="columns">
        @foreach($chunk as $product)
            <div class="column is-3">
                <div class="card">
                    <div class="card-image">
                        <a href="{{ $product->path() }}">
                            <figure class="image is-4by3">
                                <img src="{{ $product->image }}" alt="{{ $product->name }}">
                            </figure>
                        </a>
                    </div>

                    <div class="card-content">
                        <p class="title">
                            <a href="{{ $product->path() }}">
                                {{ $product->name }}
                            </a>
                        </p>

                        <p class="title is-4">
                            $ {{ $product->price }}
                        </p>

                        <p class="subtitle">
                            <a href="{{ $product->retailer->path() }}">
                                by {{ $product->retailer->name }}
                            </a>
                        </p>

                        <div class="content">
                            {{ substr($product->description,0,100) }}...
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
    $numberOfPages = ceil($products->total() / $products->perPage());
@endphp

<nav class="pagination is-centered" role="navigation" aria-label="pagination" style="margin-bottom: 20px;">
    <a href="{{ $products->previousPageUrl() }}" class="pagination-previous">Previous</a>
    <a href="{{ $products->nextPageUrl() }}" class="pagination-next">Next page</a>
    <ul class="pagination-list">
        @for($page = 1; $page <= $numberOfPages; $page++)
            <li>
                <a href="{{ Request::url() }}?page={{ $page }}"
                   class="pagination-link {{ $page === $products->currentPage() ? 'is-current' : '' }}"
                   aria-label="Goto page {{ $page }}"
                >
                    {{ $page }}
                </a>
            </li>
        @endfor
    </ul>
</nav>
