<!-- Featured Products -->
<div class="featured-section">
    <div class="container">
        <h1 class="main-title">Featured Products</h1>
        <div class="row mt-4">
            @foreach ($products as $product)
            <div class="col-md-4">
                    <div class="product-card card">
                        <div class="card-image">
                            <a href="{{url('/product-detail/'.$product->slug)}}">
                            <img
                                src="{{ $product->imageUrl }}"
                                alt="{{ $product->title }}"
                                class="product-img"
                            />
                            </a>
                        </div>
                        <div class="card-body">
                            <h5 class="mb-1">{{ $product->title }}</h5>

                            <span class="text-muted text-sm font-italic"
                            >{{ $product->product_ingredients }}</span
                            >
                            <span class="text-muted text-sm">{{ $product->short_description }}</span>
                            <form class="row align-items-center mt-4" action="{{ route('frontend.cart') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="col-sm-6">
                                    <span class="price">$ {{ $product->price }}</span>
                                </div>
                                <div class="col-sm-6 text-sm-right mt-2 mt-sm-0">
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button class="btn btn-outline-primary btn-sm" type="submit" data-action="open-cart-modal" data-id="1">
                                        <span>{{ in_array($product->id, $cartProductIds) ? "Product In Cart": "Add to cart"}}</span>
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
            </div>
            @endforeach
        </div>
        <div class="button-wrapper">
            <button class="btn btn-primary">View Our Menu</button>
        </div>
    </div>
</div>
