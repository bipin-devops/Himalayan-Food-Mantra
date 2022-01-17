@extends('Frontend.includes.master')
@section('content')
    <!-- content -->
    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card wish-list mb-3">
                        <div class="card-body">
                            <h5 class="mb-4">Cart (<span>{{ $totalCartProduct  }}</span> items)</h5>
                            @php
                                $cartProducts = $user->cart ? $user->cart->cartProduct : collect([]);
                            @endphp
                            @foreach ($cartProducts as $cartProduct)
                                <div class="row mb-4">
                                    <div class="col-md-5 col-lg-3 col-xl-3">
                                        <img
                                                class="img-fluid w-100"
                                                src="{{ $cartProduct->imageUrl }}"
                                                alt="Sample product-img"
                                        />
                                    </div>

                                    <div class="col-md-7 col-lg-9 col-xl-9">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h5>{{ $cartProduct->title }}</h5>
                                                <p class="mb-3 text-muted text-uppercase small">
                                                    {{ $cartProduct->short_description }}
                                                </p>
                                            </div>
                                            <input
                                                    class="quantity cart-quantity"
                                                    min="1"
                                                    data-id="{{$cartProduct->id}}"
                                                    data-price="{{ $cartProduct->price }}"
                                                    name="quantity"
                                                    value="{{ $cartProduct->quantity }}"
                                                    type="number"
                                            />
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <form action="{{ route('frontend.cartproduct.destroy') }}" method="POST">
                                                @method('DELETE')
                                                {{ csrf_field() }}
                                                <input type="hidden" name="product_id" value="{{ $cartProduct->id }}">
                                                <button class="btn text-danger"><i class="fas fa-trash-alt mr-1"></i> Remove item</button>
                                            </form>
                                        </div>
                                        <p class="mb-0">
                                            <span>
                                                <strong id="product-price-{{$cartProduct->id}}">$ {{ $cartProduct->total }}</strong>
                                            </span>
                                        </p>
                                    </div>
                                </div>
                                @if(!$loop->last)
                                    <hr class="mb-4"/>
                                @endif
                            @endforeach
                        </div>
                        <p class="text-primary mb-0">
                            <i class="fas fa-info-circle mr-1"></i> Do not delay the
                            purchase, adding items to your cart does not mean booking
                            them.
                        </p>
                        <hr class="mb-4"/>
                        <a href="{{url('/menu')}}" class="btn btn-primary btn-block">Continue Shopping</a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <!-- Card -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="mb-3">The total amount of</h5>
                            <ul class="list-group list-group-flush">
                                {{-- <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                                    Temporary amount
                                    <span>Rs. 480</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    Delivery
                                    <span>Rs. 100</span>
                                </li> --}}
                                <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                    <div>
                                        <strong>The total amount of</strong>
                                        <strong>
                                            <p class="mb-0">(including VAT)</p>
                                        </strong>
                                    </div>
                                    <span><strong id="cart-total">$ {{ $cart ? $cart->total : 0 }}</strong></span>
                                </li>
                            </ul>

                            <a href="{{url('/checkout')}}" class="btn btn-primary btn-block">
                                Go to checkout
                            </a>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="mb-4">We accept</h5>


                            <img
                                    class="mr-2"
                                    width="80px"
                                    src="https://picsum.photos/300/300"
                                    alt="Paypal"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
<script>

$('.cart-quantity').change(function(e){
    var allPrices = {};
    $('.cart-quantity').each(function(item,el){
        var id = $(el).data('id');
        allPrices[id] = $(el).val();
    });

    var csrf = $("[name='_token']").val();
    var quantity = $(this).val();
    var data = $(this).data();
    var total = quantity * data.price;
    $('#product-price-'+ data.id).text("$ "+ total);

    $.ajax({
        url: "{{ route('frontend.cart.ajax') }}",
        method: 'POST',
        data : {
            'product' : allPrices,
            '_token': csrf
        },
        success: function(res){
            $('#cart-total').text("$ "+ res.total);
        },
        error: function(err){
        }
    })
});

</script>
@endsection
