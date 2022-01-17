@extends('Frontend.includes.master')
@section('content')
    <!-- content -->
    <div class="page-content">
        <div class="container">
            <h4 class="mb-5"><strong>About Us</strong></h4>
            <div class="row">
                <div class="col-md-6">
                    <img
                            src="{{$about->imageUrl ?? ''}}"
                            class="about-img"
                    />
                </div>
                <div class="col-md-6">
                    <h3 class="lead">{!! $about->details ?? '' !!}</h3>
                </div>
            </div>
        </div>
    </div>
    @endsection
