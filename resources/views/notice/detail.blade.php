@extends('layout.master')

@section('title', $notice->title)
@push('css')
    <style>
        p {
            margin-bottom: 3px;
        }

        .notice-wrapper {
            background: #fff;
            padding: 20px 15px;
        }

    </style>
@endpush
@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-8">

                <div class="row">
                    <div class="col-12">
                        <div class="notice-wrapper">

                            <div class="notice-title">
                                <h4 class="text-center text-uppercase">{{ $notice->title }}</h4>
                                <p><small>Đăng bởi: @if($notice->author ==0) Admin @else Hệ thống @endif - {{ date('d/m/Y H:i:s', strtotime($notice->created_at)) }}</small></p>
                            </div>
                            <div class="notice-content text-justify">
                                {!! $notice->content !!}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
@endpush
