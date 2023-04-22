<div>
    <div class="py-3 py-md-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-5 mt-3">
                    <div class="bg-white border" wire:ignore>
                        <div>
                            @if ($book->bookImages)
                                {{-- <img src="{{ asset($book->bookImages[0]->image) }}" class="w-100 img img-responsive full-width" alt="Img"> --}}
                                <div class="exzoom" id="exzoom">

                                    <div class="exzoom_img_box">
                                        <ul class='exzoom_img_ul'>
                                            @foreach ($book->bookImages as $itemImg)
                                                <li><img src="{{ asset($itemImg->image) }}" /></li>
                                            @endforeach
                                        </ul>
                                    </div>

                                    <div class="exzoom_nav"></div>
                                    <p class="exzoom_btn">
                                        <a href="javascript:void(0);" class="exzoom_prev_btn">
                                            < </a>
                                                <a href="javascript:void(0);" class="exzoom_next_btn"> > </a>
                                    </p>
                                </div>
                            @else
                                No Images Found
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-7 mt-3">
                    <div class="product-view">
                        <h4 class="product-name">
                            {{ $book->name }}
                            @if ($book->quantity)
                                <label class="label-stock py-2 bg-success">In Stock</label>
                            @else
                                <label class="label-stock py-2 bg-danger">Out of Stock</label>
                            @endif
                        </h4>
                        <hr>
                        <p class="product-path">
                            Home / {{ $book->category->name }} / {{ $book->name }}
                        </p>
                        <div>
                            <span class="selling-price">Rs. {{ $book->selling_price }}</span>
                            <span class="original-price">Rs. {{ $book->original_price }}</span>
                        </div>
                        <div class="mt-2">
                            <div class="input-group">
                                <span class="btn btn1" wire:click="decrementQuantity"><i class="fa fa-minus"></i></span>
                                <input type="text" wire:model="quantityCount" value="{{ $this->quantityCount }}"
                                    readonly class="input-quantity" />
                                <span class="btn btn1" wire:click="incrementQuantity"><i class="fa fa-plus"></i></span>
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="button" wire:click="addToCart({{ $book->id }})" class="btn btn1">
                                <i class="fa fa-shopping-cart"></i> Add To Cart
                            </button>

                            <button type="button" wire:click="addToReadlist({{ $book->id }})" class="btn btn1">
                                <i class="fa fa-book"></i> Add To Read
                            </button>
                        </div>
                        <div class="mt-4">
                            <h6 class="mb-2">About Readlist</h6>
                            <p>
                                The Readlist feature allows users to create a personalized list of books they want to
                                read and order them for a small delivery fee. It provides a hassle-free way to access
                                books without buying the full book.
                            </p>
                            <p class="text-danger">
                                It's important to note that users must return the books they ordered using the Readlist
                                feature within 14 days to avoid any additional fees.
                            </p>
                        </div>
                        <div class="mt-3">
                            <h6 class="mb-3">Small Description</h6>
                            <p class="mb-0 author-pub-text">Author: {{ $book->author }}</p>
                            <p class="author-pub-text">Publisher: {{ $book->publisher }}</p>
                            <p>
                                {{ $book->small_description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3">
                    <div class="card">
                        <div class="card-header bg-white">
                            <h4>Description</h4>
                        </div>
                        <div class="card-body">
                            <p>
                                {{ $book->description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-3 py-md-5 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <h4>Related Books</h4>
                    <div class="underline mb-4"></div>
                </div>
                <div class="col-md-12">
                    @if ($category)
                        <div class="owl-carousel owl-theme four-carousel">
                            @foreach ($category->relatedBooks as $relatedBookItem)
                                <div class="item">
                                    <div class="product-card">
                                        <div class="product-card-img">
                                            @if ($relatedBookItem->bookImages->count() > 0)
                                                <a
                                                    href="{{ url('/collections/' . $relatedBookItem->category->slug . '/' . $relatedBookItem->slug) }}">
                                                    <img src="{{ asset($relatedBookItem->bookImages[0]->image) }}"
                                                        alt="{{ $relatedBookItem->name }}">
                                                </a>
                                            @endif
                                        </div>
                                        <div class="product-card-body">
                                            <p class="product-brand">{{ $relatedBookItem->publisher }}</p>
                                            <h5 class="product-name">
                                                <a class="carditem-book-name"
                                                    href="{{ url('/collections/' . $relatedBookItem->category->slug . '/' . $relatedBookItem->slug) }}">
                                                    {{ $relatedBookItem->name }}
                                                </a>
                                            </h5>
                                            <p class="product-brand mb-3">By {{ $relatedBookItem->author }}</p>
                                            <div>
                                                <span class="selling-price">Rs.
                                                    {{ $relatedBookItem->selling_price }}</span>
                                                <span class="original-price">Rs.
                                                    {{ $relatedBookItem->original_price }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="p-2">
                            <h4>No Related Books Available</h4>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>


@push('scripts')
    <script>
        $(function() {

            $("#exzoom").exzoom({

                "navWidth": 60,
                "navHeight": 60,
                "navItemNum": 5,
                "navItemMargin": 7,
                "navBorder": 1,
                "autoPlay": false,
                "autoPlayTimeout": 2000
            });

        });

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
        });
    </script>
@endpush
