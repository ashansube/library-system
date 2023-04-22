@extends('layouts.app')

@section('title', 'Search Books')

@section('content')

    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 mt-2">
                    <h4>Search Results</h4>
                    <div class="underline mb-5"></div>
                </div>

                @forelse ($searchBooks as $bookItem)
                    <div class="col-md-10">
                        <div class="product-card">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="product-card-img">
                                        <label class="stock bg-danger">New</label>

                                        @if ($bookItem->bookImages->count() > 0)
                                            <a
                                                href="{{ url('/collections/' . $bookItem->category->slug . '/' . $bookItem->slug) }}">
                                                <img src="{{ asset($bookItem->bookImages[0]->image) }}"
                                                    alt="{{ $bookItem->name }}">
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="product-card-body">
                                        <p class="product-brand">{{ $bookItem->publisher }}</p>
                                        <h5 class="product-name">
                                            <a class="carditem-book-name"
                                                href="{{ url('/collections/' . $bookItem->category->slug . '/' . $bookItem->slug) }}">
                                                {{ $bookItem->name }}
                                            </a>
                                        </h5>
                                        <p class="product-brand mb-3">By {{ $bookItem->author }}</p>
                                        <div>
                                            <span class="selling-price">Rs. {{ $bookItem->selling_price }}</span>
                                            <span class="original-price">Rs. {{ $bookItem->original_price }}</span>
                                        </div>
                                        <p style="height: 45px; overflow: hidden;">
                                            <b>Description : </b>{{ $bookItem->description }}
                                        </p>
                                        <a href="{{ url('/collections/' . $bookItem->category->slug . '/' . $bookItem->slug) }}"
                                            class="btn btn-outline-secondary">View</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12 p-2">
                        <h4>No Such Books Found...</h4>
                    </div>
                @endforelse

                <div class="col-md-10">
                    {{ $searchBooks->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
