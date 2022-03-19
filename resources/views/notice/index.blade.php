@extends('layout.master')

@section('title', 'Danh sách thông báo')
@push('css')
    <style>
        p {
            margin-bottom: 3px;
        }

    </style>
@endpush
@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-8">
                <div class="row">
                    <div class="col-12">
                        <h3 class="text-center">Danh sách thông báo</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        @foreach ($notices as $notice)
                            <a href="{{route('noticeuser.getNotice', $notice->slug)}}">
                                <div class="alert  p-2 text-dark @if($notice->getOriginal('pivot_is_read') == 0) alert-secondary @else alert-light @endif">
                                    <p class="d-flex justify-content-between"><b>{{ $notice->title }}</b>
                                        <small>{{ date('d-m-Y H:i:s') }}</small>
                                    </p>
                                    <p><small>{{ $notice->short_content }}</small></p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
@endpush
