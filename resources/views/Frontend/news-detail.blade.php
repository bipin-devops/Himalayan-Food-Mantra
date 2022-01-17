@extends('Frontend.includes.master')
@section('content')

    <div class="page-content">
        <div class="container">
            <h4 class="mb-2">
                <strong>{{$newsDetail->title}}</strong>
               
            </h4>
            <p class="text-muted">{{\Carbon\Carbon::parse($newsDetail['created_at'])->format(' M d Y')}}</p>
            <img src="{{$newsDetail->imageUrl}}" class="blog-single-img"/>
            <p class="blog-content">
               {!! $newsDetail->description !!}
            </p>


        </div>
    </div>

@endsection