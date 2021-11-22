@extends('layout.master')

@section('title', 'Theo dõi đơn hàng')

@push('css')
    <link href="{{ asset('public/css/policy.css') }}" rel="stylesheet" type='text/css' />
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-12 col-md-8 order-md-2">
                <div class="page-content">
                    <h2 class="title">{{ $page->name }}</h2>
                    <div class="entry-content">
                        {!! $page->content !!}
                    </div>
                </div>
            </div>

            <div class="col col-12 col-md-4 order-md-1">
                <div class="page-sidebar">

                    @include('policy.sidebar')
                </div>
            </div>


        </div>

    </div>
@endsection
