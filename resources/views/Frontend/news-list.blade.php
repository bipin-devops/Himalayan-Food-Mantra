@extends('Frontend.includes.master')
@section('content')


<!-- content -->
<div class="page-content">
    <div class="container">
        <h4 class="mb-5 text-center"><strong>News</strong></h4>
        <div class="row">
            @foreach($news as $new)
            <div class="col-lg-4 col-md-12 mb-4">
                <div class="card">
                    <div class="bg-image">
                        <img
                                src="{{$new->imageUrl}}"
                                class="img-fluid"
                        />
                    </div>
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">{{$new->title}}</h5>
                        <p class="card-text mb-3">
                            {!! $new->description !!}.
                        </p>
                        <a href="{{url('/news-detail/'.$new->slug)}}" class="btn btn-primary">Read more</a>
                    </div>
                </div>
            </div>
                @endforeach

        </div>
    </div>
</div>

    @endsection