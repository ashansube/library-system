@extends('layouts.app')

@section('title', 'Home Page')

@section('content')

    <div id="carouselExampleCaptions" class="carousel slide" data-interval="1000">
        <div class="carousel-inner">

            @foreach ($sliders as $key => $sliderItem)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                    @if ($sliderItem->image)
                        <img src="{{ asset("$sliderItem->image") }}" class="d-block w-100" alt="...">
                    @endif
                    {{-- <div class="carousel-caption d-none d-md-block">
                        <h5>{{ $sliderItem->title }}</h5>
                        <p>{{ $sliderItem->description }}</p>
                    </div> --}}
                    {{-- <div class="carousel-caption d-none d-md-block">
                        <div class="custom-carousel-content">
                            <h1>
                                {!! $sliderItem->title !!}
                            </h1>
                            <p>{!! $sliderItem->description !!}</p>
                            <div>
                                <a href="#" class="btn btn-slider">
                                    Get Now
                                </a>
                            </div>
                        </div>
                    </div> --}}
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <h4>Welcome to Middeniya P. Library Online</h4>
                    <div class="underline mx-auto"></div>
                    <p>
                        Welcome to the Middeniya Public Library Online Platform! We are excited to offer a wide range of
                        books and resources to our patrons, all available at your fingertips. Whether you're a student,
                        a book lover, or just looking for something new to read, we have something for everyone. Thank you
                        for visiting our site, and we hope you enjoy your experience with us!
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>Trending Books</h4>
                    <div class="underline mb-4"></div>
                </div>
                @if ($trendingBooks)
                    <div class="col-md-12">
                        <div class="owl-carousel owl-theme four-carousel">
                            @foreach ($trendingBooks as $bookItem)
                                <div class="item">
                                    <div class="product-card">
                                        <div class="product-card-img">
                                            <label class="stock bg-primary">Trending</label>

                                            @if ($bookItem->bookImages->count() > 0)
                                                <a
                                                    href="{{ url('/collections/' . $bookItem->category->slug . '/' . $bookItem->slug) }}">
                                                    <img src="{{ asset($bookItem->bookImages[0]->image) }}"
                                                        alt="{{ $bookItem->name }}">
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
                            @endforeach
                        </div>

                    </div>
                @else
                    <div class="col-md-12">
                        <div class="p-2">
                            <h4>No Trending Books Available</h4>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>New Arrivals
                        <a href="{{ url('new-arrivals') }}" class="btn btn-sm btn-secondary float-end">View All</a>
                    </h4>
                    <div class="underline mb-4"></div>
                </div>
                @if ($newArrivalsBooks)
                    <div class="col-md-12">
                        <div class="owl-carousel owl-theme four-carousel">
                            @foreach ($newArrivalsBooks as $bookItem)
                                <div class="item">
                                    <div class="product-card">
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
                            @endforeach
                        </div>

                    </div>
                @else
                    <div class="col-md-12">
                        <div class="p-2">
                            <h4>No New Arrivals Available</h4>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="py-5 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>Featured Books
                        <a href="{{ url('featured-books') }}" class="btn btn-sm btn-secondary float-end">View All</a>
                    </h4>
                    <div class="underline mb-4"></div>
                </div>
                @if ($featuredBooks)
                    <div class="col-md-12">
                        <div class="owl-carousel owl-theme four-carousel">
                            @foreach ($featuredBooks as $bookItem)
                                <div class="item">
                                    <div class="product-card">
                                        <div class="product-card-img">
                                            <label class="stock bg-success">Featured</label>

                                            @if ($bookItem->bookImages->count() > 0)
                                                <a
                                                    href="{{ url('/collections/' . $bookItem->category->slug . '/' . $bookItem->slug) }}">
                                                    <img src="{{ asset($bookItem->bookImages[0]->image) }}"
                                                        alt="{{ $bookItem->name }}">
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
                            @endforeach
                        </div>

                    </div>
                @else
                    <div class="col-md-12">
                        <div class="p-2">
                            <h4>No Featured Books Available</h4>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>


@endsection

@section('script')

    <script>
        $('.four-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 4
                }
            }
        })
    </script>

@endsection
