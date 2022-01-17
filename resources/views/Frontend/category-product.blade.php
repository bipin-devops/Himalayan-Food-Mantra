@extends('Frontend.includes.master')
@section('content')

    <!-- content -->
    <div class="page-content">
        <div class="container">
            <h4 class="mb-5 text-center"><strong>{{$category->name ?? ''}}</strong></h4>
            <div class="row">
                @if(($products->count()>0))
                @foreach($products as $p)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <a href="{{url('/product-detail/'.$p->slug)}}">
                        <div class="card-image">
                            <img
                                    src="{{$p->imageUrl}}"
                                    alt=""
                                    class="product-img"
                            />
                        </div>
                        </a>
                        <div class="card-body">
                            <h5 class="mb-2"><strong>{{$p->title}}</strong></h5>
                            <form class="" action="{{ route('frontend.cart') }}" method="POST">
                                {{ csrf_field() }}
                            <div class="row align-items-center mt-4">
                                <div class="col-sm-6">
                                    <h5 class="price"><strong>$ {{$p->price}} </strong></h5>
                                </div>
                                <div class="col-sm-6 text-sm-right mt-2 mt-sm-0">
                                    <input type="hidden" name="product_id" value="{{ $p->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button
                                            class="btn btn-outline-primary btn-sm"
                                            data-action="open-cart-modal"
                                            data-id="1"
                                    >

                                        <span class="text-dark">{{ in_array($p->id, $cartProductIds) ? "Product In Cart": "Add to cart"}}</span>

                                    </button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                    @endforeach
                    @else

                    <h4 class="mb-5 text-center"><strong>No Any Product</strong></h4>
                @endif

            </div>

        </div>
    </div>

@endsection