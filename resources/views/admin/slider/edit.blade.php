@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h3>Edit Slider
                        <a href="{{ url('admin/sliders/') }}" class="btn btn-danger btn-sm text-white float-end">Back</a>
                    </h3>
                </div>

                <div class="card-body">
                    <form action="{{ url('admin/sliders/'.$slider->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="mb-1">Title</label>
                                <input type="text" name="title" value="{{ $slider->title }}" class="form-control" />
                                @error('title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="mb-1">Description</label>
                                <textarea name="description" class="form-control" rows="3">{{ $slider->description }}</textarea>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="mb-1">Image</label><br>
                                <input type="file" name="image" class="form-control" />
                                <img class="mt-2" src="{{ asset("$slider->image") }}" style="width: 60px; height: 60px;" alt="slider image">
                                @error('image')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="mb-1">Status</label><br />
                                <input type="checkbox" name="status" {{ $slider->status == '1' ? 'checked': '' }} style="width: 20px; height: 20px;" />
                                Checked=Hidden, Unchecked=Visible
                                @error('status')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <button type="submit" class="btn btn-primary text-white float-end">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
