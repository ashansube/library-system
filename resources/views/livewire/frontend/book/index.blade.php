<div>
    <div class="row">
        @forelse ($books as $bookItem)
            <div class="col-md-3">
                <div class="product-card">
                    <div class="product-card-img">
                        @if ($bookItem->quantity > 0)
                            <label class="stock bg-success">In Stock</label>
                        @else
                            <label class="stock bg-danger">Out Of Stock</label>
                        @endif

                        @if ($bookItem->bookImages->count() > 0)
                            <a href="{{ url('/collections/' . $bookItem->category->slug . '/' . $bookItem->slug) }}">
                                <img src="{{ asset($bookItem->bookImages[0]->image) }}" alt="{{ $bookItem->name }}">
                            </a>
                        @endif
                    </div>
                    <div class="product-card-body">
                        <p class="product-brand">{{ $bookItem->publisher }}</p>
                        <h5 class="product-name">
                            <a href="{{ url('/collections/' . $bookItem->category->slug . '/' . $bookItem->slug) }}">
                                {{ $bookItem->name }}
                            </a>
                        </h5>
                        <div>
                            <span class="selling-price">Rs. {{ $bookItem->selling_price }}</span>
                            <span class="original-price">Rs. {{ $bookItem->original_price }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-md-12">
                <div class="p-2">
                    <h4>No Books Available for {{ $category->name }}</h4>
                </div>
            </div>
        @endforelse
    </div>
</div>
