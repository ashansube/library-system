<div>
    <div class="py-3 py-md-5 bg-light">
        <div class="container">
            <h4>Read List</h4>
            <hr>

            <div class="row">
                <div class="col-md-12">
                    <div class="shopping-cart">

                        <div class="cart-header d-none d-sm-none d-mb-block d-lg-block">
                            <div class="row">
                                <div class="col-md-4">
                                    <h4>Products</h4>
                                </div>
                                <div class="col-md-4">
                                    <h4>Author</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Quantity</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Remove</h4>
                                </div>
                            </div>
                        </div>

                        @forelse ($readlist as $readlistItem)
                        @if ($readlistItem->book)
                            <div class="cart-item">
                                <div class="row">
                                    <div class="col-md-4 my-auto">
                                        <a href="{{ url('collections/'.$readlistItem->book->category->slug.'/'.$readlistItem->book->slug) }}">
                                            <label class="product-name">
                                                @if ($readlistItem->book->bookImages)
                                                    <img src="{{ asset($readlistItem->book->bookImages[0]->image) }}" style="width: 50px; height: 50px" alt="readlist item image">
                                                @else
                                                <img src="" style="width: 50px; height: 50px" alt="">
                                                @endif
                                                {{ $readlistItem->book->name }}
                                            </label>
                                        </a>
                                    </div>
                                    <div class="col-md-4 my-auto">
                                        <label class="price">{{ $readlistItem->book->author }} </label>
                                    </div>
                                    <div class="col-md-2 col-7 my-auto">
                                        <div class="quantity">
                                            <div class="input-group">
                                                <button type="button" wire:loading.attr="disabled" wire:click="decrementQuantity({{ $readlistItem->id }})" class="btn btn1"><i class="fa fa-minus"></i></button>
                                                <input type="text" value="{{ $readlistItem->quantity }}" class="input-quantity" readonly/>
                                                <button type="button" wire:loading.attr="disabled" wire:click="incrementQuantity({{ $readlistItem->id }})" class="btn btn1"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-5 my-auto">
                                        <div class="remove">
                                            <button type="button" wire:loading.attr="disabled" wire:click="removeReadlistItem({{ $readlistItem->id }})" class="btn btn-danger btn-sm">
                                                <span wire:loading.remove wire:target="removeReadlistItem({{ $readlistItem->id }})">
                                                    <i class="fa fa-trash"></i> Remove
                                                </span>
                                                <span wire:loading wire:target="removeReadlistItem({{ $readlistItem->id }})">
                                                    <i class="fa fa-trash"></i> Removing...
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @empty
                            <div>
                                No Readlist Items Available
                            </div>
                        @endforelse

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 my-md-auto mt-3">
                    <div class="mt-4">
                        <h6>About Readlist</h6>
                        <p>The Readlist feature allows users to create a personalized list of books they want to read and order them for a small delivery fee. It provides a hassle-free way to access books without buying the full book.</p>
                        <p class="text-danger">It's important to note that users must return the books they ordered using the Readlist feature within 14 days to avoid any additional fees. This ensures that the books are available for other users to enjoy and helps to maintain the integrity of the system.</p>
                    </div>
                    <h6>Get the best books from us <a class="text-decoration-none" href="{{ url('/collections') }}">Order Now</a></h6>
                </div>
                <div class="col-md-4 mt-4">
                    <div class="shadow-sm bg-white p-3">
                        <h6>Shipping Fee:
                            <span class="float-end">Rs. {{ $shippingFee }}</span>
                        </h6>
                        <h6>Service Charge:
                            <span class="float-end">Rs. {{ $serviceCharge }}</span>
                        </h6>
                        <h4 class="mt-3">Total:
                            <span class="float-end">Rs. {{ $shippingFee + $serviceCharge }}</span>
                        </h4>
                        <hr>
                        <a href="{{ url('/checkout') }}" class="btn btn-warning w-100">Checkout</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
