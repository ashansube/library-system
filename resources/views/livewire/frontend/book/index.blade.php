<div>
    <div class="row">
        <div class="col-md-3">
            @if ($category->publishers)
            <div class="card">
                <div class="card-header">
                    <h4>Publishers</h4>
                </div>
                <div class="card-body">
                    @foreach ($category->publishers as $publisherItem)
                        <label class="d-block">
                            <input type="checkbox" wire:model="publisherInputs" value="{{ $publisherItem->name }}"/> {{ $publisherItem->name }}
                        </label>
                    @endforeach
                </div>
            </div>
            @endif

            <div class="card mt-4">
                <div class="card-header">
                    <h4>Price</h4>
                </div>
                <div class="card-body">
                        <label class="d-block">
                            <input type="radio" name="priceSort" wire:model="priceInput" value="high-to-low"/> High to Low
                        </label>
                        <label class="d-block">
                            <input type="radio" name="priceSort" wire:model="priceInput" value="low-to-high"/> Low to High
                        </label>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="row">
                @forelse ($books as $bookItem)
                    <div class="col-md-4">
                        <div class="product-card">
                            <div class="product-card-img">
                                @if ($bookItem->quantity > 0)
                                    <label class="stock bg-success">In Stock</label>
                                @else
                                    <label class="stock bg-danger">Out Of Stock</label>
                                @endif

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
                                    <a
                                        class="carditem-book-name"
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
                    <div class="col-md-12">
                        <div class="p-2">
                            <h4>No Books Available for {{ $category->name }}</h4>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
