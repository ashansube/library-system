@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3>Books
                    <a href="{{ url('admin/books/create') }}" class="btn btn-primary btn-sm text-white float-end">
                        Add Books
                    </a>
                </h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category</th>
                            <th>Book</th>
                            <th>Author</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($books as $book)
                            <tr>
                                <td>{{ $book->id }}</td>
                                <td>
                                    @if ($book->category)
                                        {{ $book->category->name }}
                                        @else
                                        No Category
                                    @endif
                                </td>
                                <td>{{ $book->name }}</td>
                                <td>{{ $book->author }}</td>
                                <td>{{ $book->selling_price }}</td>
                                <td>{{ $book->quantity }}</td>
                                <td>{{ $book->status == '1' ? 'Hidden' : 'Visible' }}</td>
                                <td>
                                    <a href="{{ url('admin/books/'.$book->id.'/edit') }}"
                                        class="btn btn-primary text-white">Edit</a>
                                    <a href="{{ url('admin/books/'.$book->id.'/delete') }}" onclick="return confirm('Are you sure, you want to delete this data?')"
                                        class="btn btn-danger text-white">Delete</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">No Books Available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
