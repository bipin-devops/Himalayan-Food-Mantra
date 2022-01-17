@extends('Frontend.includes.master')
@section('content')
    <!-- Content -->
    <div class="page-content">
        <!--Section: Block Content-->
        <section class="container mb-5">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="row product-gallery">
                        <div class="mb-0">
                            <figure class="view overlay rounded z-depth-1 main-img">

                                <img
                                        src="{{$productDetail->imageUrl}}"
                                        class="img-fluid single-product-img"
                                />

                            </figure>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <p class="mb-2 text-muted text-uppercase small">{{$productDetail->category->name ?? ''}}</p>

                    <h3>{{$productDetail->title ?? ''}}</h3>


                    <p>
                        <span class="mr-1"><strong>$ {{$productDetail->price}}</strong></span>
                    </p>
                    <p class="pt-1">
                        {!! $productDetail->description !!}
                    </p>

                    <hr/>
                    <form class="" action="{{ route('frontend.cart') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="quantity-section mb-3">
                            <h5 class="mb-2">Quantity</h5>

                            <input
                                    class="quantity"
                                    data-id="{{$productDetail->id}}"
                                    data-price="{{ $productDetail->price }}"
                                    name="quantity"
                                    value="1"
                                    min="1"
                                    type="number"
                            />

                            <input type="hidden" name="product_id" value="{{ $productDetail->id }}">

                        </div>
                        <button class="btn btn-primary mb-2">
                            <i class="fas fa-shopping-cart pr-2"></i><span>{{ in_array($productDetail->id, $cartProductIds) ? "Product In Cart": "Add to cart"}}</span>

                        </button>
                    </form>
                </div>
                <div class="col-md-12 mt-4">
                    <h1 class="main-title text-dark">Recommended Products</h1>
                    <div class="row mt-4">
                        @foreach($products as $product)
                            @if($product->id!=$productDetail->id)
                                <div class="col-md-4">
                                    <div class="product-card card">
                                        <div class="card-image">
                                            <a href="{{url('/product-detail/'.$product->slug)}}">
                                                <img
                                                        src="{{$product->imageUrl}}"
                                                        alt=""
                                                        class="product-img"
                                                />
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="mb-1">{{$product->title}}</h5>
                                            <span class="text-muted text-sm"
                                            >{{ $product->product_ingredients }}</span>
                                            <form class="" action="{{ route('frontend.cart') }}" method="POST">
                                                {{ csrf_field() }}
                                                <div class="row align-items-center mt-4">
                                                    <div class="col-sm-6">
                                                        <span class="price">$  {{$product->price}}</span>
                                                    </div>
                                                    <div class="col-sm-6 text-sm-right mt-2 mt-sm-0">
                                                        <input type="hidden" name="product_id"
                                                               value="{{ $product->id }}">
                                                        <input type="hidden" name="quantity" value="1">
                                                        <button
                                                                class="btn btn-outline-primary btn-sm"
                                                                data-action="open-cart-modal" type="submit"
                                                                data-id="1"
                                                        >
                                                            <span>{{ in_array($product->id, $cartProductIds) ? "Product In Cart": "Add to cart"}}</span>

                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach

                    </div>
                </div>
            </div>
        </section>
        <!--Section: Block Content-->
    </div>

@endsection

