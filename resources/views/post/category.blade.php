@extends('layout.master')

@section('title', 'Danh mục bài viết')

@push('css')
    <link href="{{ asset('public/css/post.css') }}" rel="stylesheet" type='text/css' />
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-12 col-md-8">
                <div class="page-content">
                    <h2 class="title">{{ $page->name }}</h2>
                    <div class="entry-content">
                    </div>
                </div>
            </div>

            <div class="col col-12 col-md-4">
                <div class="page-sidebar">

                </div>
            </div>


        </div>

    </div>  

@endsection