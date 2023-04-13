@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
            <h6 class="alert alert-warning mb-2">{{ session('message') }}</h6>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3>Edit Book
                        <a href="{{ url('admin/books') }}" class="btn btn-danger btn-sm text-white float-end">
                            Back
                        </a>
                    </h3>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger mb-2">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                    @endif

                    <form action="{{ url('admin/books/'.$book->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                    data-bs-target="#home-tab-pane" type="button" role="tab"
                                    aria-controls="home-tab-pane" aria-selected="true">
                                    Home
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="seotag-tab" data-bs-toggle="tab"
                                    data-bs-target="#seotag-tab-pane" type="button" role="tab"
                                    aria-controls="seotag-tab-pane" aria-selected="false">
                                    SEO Tags
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="details-tab" data-bs-toggle="tab"
                                    data-bs-target="#details-tab-pane" type="button" role="tab"
                                    aria-controls="details-tab-pane" aria-selected="false">
                                    Details
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="image-tab" data-bs-toggle="tab"
                                    data-bs-target="#image-tab-pane" type="button" role="tab"
                                    aria-controls="image-tab-pane" aria-selected="false">
                                    Book Images
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade border p-3 show active" id="home-tab-pane" role="tabpanel"
                                aria-labelledby="home-tab" tabindex="0">
                                <div class="mb-3 mt-4">
                                    <label class="mb-2">Category</label>
                                    <select name="category_id" class="form-control form-select text-dark">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ $category->id == $book->category_id ? 'selected':'' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="mb-2">Book Name</label>
                                    <input type="text" name="name" value="{{ $book->name }}" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label class="mb-2">Book Slug</label>
                                    <input type="text" name="slug" value="{{ $book->slug }}" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label class="mb-2">Select Publisher</label>
                                    <select name="publisher" class="form-control form-select text-dark">
                                        @foreach ($publishers as $publisher)
                                            <option value="{{ $publisher->name }}" {{ $publisher->name == $book->publisher ? 'selected':'' }}>{{ $publisher->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="mb-2">Small Description (500 Words)</label>
                                    <textarea name="small_description" class="form-control" rows="4">{{ $book->small_description }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="mb-2">Description</label>
                                    <textarea name="description" class="form-control" rows="4">{{ $book->description }}</textarea>
                                </div>

                            </div>
                            <div class="tab-pane fade border p-3" id="seotag-tab-pane" role="tabpanel" aria-labelledby="seotag-tab"
                                tabindex="0">
                                <div class="mb-3 mt-4">
                                    <label class="mb-2">Meta Title</label>
                                    <input type="text" name="meta_title" value="{{ $book->meta_title }}" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label class="mb-2">Meta Description</label>
                                    <textarea name="meta_description" class="form-control" rows="4">{{ $book->meta_description }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="mb-2">Meta Keyword</label>
                                    <textarea name="meta_keyword" class="form-control" rows="4">{{ $book->meta_keyword }}</textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade border p-3" id="details-tab-pane" role="tabpanel"
                                aria-labelledby="details-tab" tabindex="0">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3 mt-4">
                                            <label class="mb-2">Original Price (Rs.)</label>
                                            <input type="text" name="original_price" value="{{ $book->original_price }}" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3 mt-4">
                                            <label class="mb-2">Selling Price (Rs.)</label>
                                            <input type="text" name="selling_price" value="{{ $book->selling_price }}" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3 mt-4">
                                            <label class="mb-2">Quantity</label>
                                            <input type="number" name="quantity" value="{{ $book->quantity }}" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3 mt-4">
                                            <label class="mb-2">Trending</label>
                                            <input type="checkbox" name="trending" {{ $book->trending == '1' ? 'checked' : '' }} style="width: 20px; height: 20px;" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3 mt-4">
                                            <label class="mb-2">Status</label>
                                            <input type="checkbox" name="status" {{ $book->status == '1' ? 'checked' : '' }} style="width: 20px; height: 20px;" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade border p-3" id="image-tab-pane" role="tabpanel" aria-labelledby="image-tab"
                                tabindex="0">
                                <div class="mb-3 mt-4">
                                    <label class="mb-2">Upload Book Images</label>
                                    <input type="file" multiple name="image[]" class="form-control" />
                                </div>
                                <div>
                                    @if ($book->bookImages)
                                    <div class="row">
                                        @foreach ($book->bookImages as $image)
                                            <div class="col-md-2">
                                                <img src="{{ asset($image->image) }}" style="width: 80px; height:80px;" class="me-4 border" alt="Book Image" />
                                                <a href="{{ url('admin/book-image/'.$image->id.'/delete') }}" class="mt-2 mb-4 d-block text-decoration-none text-danger">Remove</a>
                                            </div>
                                        @endforeach
                                    </div>
                                    @else
                                    <h6>No Image Uploaded</h6>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary text-white mt-3">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
