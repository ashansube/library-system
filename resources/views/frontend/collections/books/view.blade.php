@extends('layouts.app')

@section('title')
{{ $book->meta_title }}
@endsection

@section('meta_keyword')
{{ $book->meta_keyword }}
@endsection

@section('meta_description')
{{ $book->meta_description }}
@endsection

@section('content')

    <div>
        <livewire:frontend.book.view :category="$category" :book="$book" />
    </div>

@endsection
