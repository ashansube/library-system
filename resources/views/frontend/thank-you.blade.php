@extends('layouts.app')

@section('title', 'Thank You')

@section('content')

    <div class="py-3 pyt-md-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    @if (session('message'))
                        <h5 class="alert">{{ session('message') }}</h5>
                    @endif
                    <div class="p-4 shadow bg-white">
                        <h2 class="mb-3 mt-3">Thank You.</h2>
                        <h5 class="mb-4 mt-3">Your Order was Completed Successfully.</h5>
                        <a href="{{ url('collections') }}" class="btn btn-primary">Make New Order</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection