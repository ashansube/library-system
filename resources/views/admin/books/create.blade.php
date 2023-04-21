@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Add Book
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

                    <form action="{{ url('admin/books') }}" method="POST" enctype="multipart/form-data">
                        @csrf

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
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="mb-2">Book Name</label>
                                    <input type="text" name="name" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label class="mb-2">Book Author</label>
                                    <input type="text" name="author" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label class="mb-2">Book Slug</label>
                                    <input type="text" name="slug" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label class="mb-2">Select Publisher</label>
                                    <select name="publisher" class="form-control form-select text-dark">
                                        @foreach ($publishers as $publisher)
                                            <option value="{{ $publisher->name }}">{{ $publisher->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="mb-2">Small Description (500 Words)</label>
                                    <textarea name="small_description" class="form-control" rows="4"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="mb-2">Description</label>
                                    <textarea name="description" class="form-control" rows="4"></textarea>
                                </div>

                            </div>
                            <div class="tab-pane fade border p-3" id="seotag-tab-pane" role="tabpanel" aria-labelledby="seotag-tab"
                                tabindex="0">
                                <div class="mb-3 mt-4">
                                    <label class="mb-2">Meta Title</label>
                                    <input type="text" name="meta_title" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label class="mb-2">Meta Description</label>
                                    <textarea name="meta_description" class="form-control" rows="4"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="mb-2">Meta Keyword</label>
                                    <textarea name="meta_keyword" class="form-control" rows="4"></textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade border p-3" id="details-tab-pane" role="tabpanel"
                                aria-labelledby="details-tab" tabindex="0">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3 mt-4">
                                            <label class="mb-2">Original Price (Rs.)</label>
                                            <input type="text" name="original_price" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3 mt-4">
                                            <label class="mb-2">Selling Price (Rs.)</label>
                                            <input type="text" name="selling_price" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3 mt-4">
                                            <label class="mb-2">Quantity</label>
                                            <input type="number" name="quantity" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3 mt-4">
                                            <label class="mb-2">Trending</label>
                                            <input type="checkbox" name="trending" style="width: 20px; height: 20px;" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3 mt-4">
                                            <label class="mb-2">Featured</label>
                                            <input type="checkbox" name="featured" style="width: 20px; height: 20px;" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3 mt-4">
                                            <label class="mb-2">Status</label>
                                            <input type="checkbox" name="status" style="width: 20px; height: 20px;" />
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
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary text-white mt-3">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
