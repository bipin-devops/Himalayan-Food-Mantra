@extends('Frontend.includes.master')
@section('content')
    <div class="page-content">
        <div class="container">
            @include('errors.error')
            <h1 class="main-title text-dark">Checkout Form</h1>
            <form action="{{ route('frontend.order.store') }}" method="POST" class="row">
                <div class="col-md-8">
                    <h4 class="mb-3">Billing address</h4>
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <label for="firstName">First name</label>
                                <input
                                        type="text"
                                        class="form-control"
                                        id="firstName"
                                        placeholder=""
                                        name="first_name"
                                        value="{{$user->first_name}}"
                                        required
                                />
                                <div class="invalid-feedback">
                                    Valid first name is required.
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="lastName">Last name</label>
                                <input
                                        type="text"
                                        class="form-control"
                                        id="lastName"
                                        name="last_name"
                                        placeholder=""
                                        value="{{$user->last_name}}"
                                        required
                                />
                                <div class="invalid-feedback">
                                    Valid last name is required.
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="email"
                                >Email <span class="text-muted"></span></label
                                >
                                <input
                                        type="email"
                                        class="form-control"
                                        id="email"
                                        name="email"
                                        value="{{$user->email ?? ''}}"
                                        placeholder="you@example.com"
                                />
                                <div class="invalid-feedback">
                                    Please enter a valid email address for shipping updates.
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="address">Address</label>
                                <input
                                        type="text"
                                        class="form-control"
                                        id="address"
                                        name="address"
                                        value="{{$user->address ?? ''}}"
                                        placeholder="address"
                                        required
                                />
                                <div class="invalid-feedback">
                                    Please enter your shipping address.
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="address2"
                                >phone <span class="text-muted"></span></label
                                >
                                <input
                                        type="text"
                                        class="form-control"
                                        id="address2"
                                        name="phone"
                                        value="{{$user->mobile_number}}"
                                        placeholder=""
                                />
                            </div>

                        </div>



                </div>
                <div class="col-md-4 mb-4">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Your cart</span>
                        <span class="badge badge-secondary badge-pill">{{count($productData) ?? 0}}</span>
                    </h4>
                    <ul class="list-group mb-3">
                        @foreach($productData as $product)
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0">{{$product->title}}</h6>

                                </div>
                                <span class="text-muted">$ {{$product->total}}</span>
                            </li>
                        @endforeach

                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total</span>
                            <strong>$ {{$cartData->total}}</strong>
                        </li>
                    </ul>

                    <h4 class="mb-3">Payment method</h4>

                    <div class="d-block my-3">
                        @foreach ($paymentMethods as $id => $title)
                        <div class="custom-control custom-radio">
                            <input
                                name="payment_method"
                                type="radio"
                                id="payment-{{$id}}"
                                value="{{ $id }}"
                                class="custom-control-input"
                                required
                            />
                            <label class="custom-control-label" for="payment-{{$id}}">{{ $title }}</label>
                        </div>
                        @endforeach
                    </div>
                    <button
                        class="btn btn-primary btn-lg btn-block"
                        type="submit"
                    >
                        Continue to checkout
                </button>
                </div>
            </form>
        </div>
    </div>

@endsection
