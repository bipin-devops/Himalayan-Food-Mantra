@extends('Frontend.includes.master')
@section('content')
    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-section">
                        <h1 class="main-title text-dark text-center">Our Menu</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($categories as $category)
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 mb-4">
                        <div class="menu-block">

                            <div class="menu-head">
                            <h3 class="menu-title">{{$category->name}}</h3>

                                <a href="{{'/category/'.$category->id}}">View All</a>
                            </div>
                            @foreach($category->product as $p)
                                <div class="menu-content">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                            <div class="dish-img">
                                                <img
                                                        src="{{$p->imageUrl}}"
                                                        alt=""
                                                        width="70" height="70"
                                                        class="img-circle"
                                                />
                                            </div>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                            <div class="dish-content">
                                                <h5 class="dish-title">
                                                    <a href="{{url('product-detail/'.$p->slug)}}">{{$p->title}}</a>
                                                    {{--<span class="text-muted text-sm"--}}
                                                    {{-->({{ $p->product_ingredients }})</span--}}
                                                    {{-->--}}
                                                    <p>{{ $p->product_ingredients }}</p>
                                                </h5>
                                                <div class="dish-price">
                                                    <p>${{$p->price}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

@endsection