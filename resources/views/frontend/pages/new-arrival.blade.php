@extends('layouts.app')

@section('title', 'New Books')

@section('content')

    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ url('collections') }}" class="btn btn-secondary px-3 float-end mt-1 mb-5">View More</a>
                    <h4>New Arrivals</h4>
                    <div class="underline mb-4"></div>
                </div>

                @forelse ($newArrivalsBooks as $bookItem)
                    <div class="col-md-3">
                        <div class="product-card">
                            <div class="product-card-img">
                                <label class="stock bg-danger">New</label>

                                @if ($bookItem->bookImages->count() > 0)
                                    <a href="{{ url('/collections/' . $bookItem->category->slug . '/' . $bookItem->slug) }}">
                                        <img src="{{ asset($bookItem->bookImages[0]->image) }}" alt="{{ $bookItem->name }}">
                                    </a>
                                @endif
                            </div>
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
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12 p-2">
                        <h4>No Trending Books Available</h4>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

@endsection
