@extends('Frontend.includes.master')
@section('content')

    <!-- content -->
    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="account-settings">
                                <div class="user-profile">
                                    <div class="user-avatar">
                                        <img
                                                src="https://bootdey.com/img/Content/avatar/avatar7.png"
                                                alt="Maxwell Admin"
                                                class="profile-img"
                                        />
                                    </div>
                                    <h5 class="user-name">{{$user->first_name}} {{$user->last_name}}</h5>
                                    <h6 class="user-email">{{$user->email}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <h4 class="text-primary mb-3">Personal Details</h4>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="fullName">First Name</label>
                                        <input
                                                type="text"
                                                disabled
                                                class="form-control"
                                                id="fullName"
                                                value="{{$user->first_name}}"
                                        />
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="fullName">Last Name</label>
                                        <input
                                                type="text"
                                                disabled
                                                class="form-control"
                                                id="fullName"
                                                value="{{$user->last_name}}"
                                        />
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="eMail">Email</label>
                                        <input
                                                disabled
                                                type="email"
                                                class="form-control"
                                                value="{{$user->email}}"
                                                placeholder="Enter email ID"
                                        />
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input
                                                value="{{$user->mobile_number}}"
                                                type="text"
                                                class="form-control"
                                                id="phone"
                                                disabled
                                                placeholder="Enter phone number"
                                        />
                                    </div>
                                </div>
                            </div>


                            <div class="row mt-3">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <h4 class="text-primary mb-3"> My Latest Order Details</h4>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th scope="col">S.N.</th>
                                            <th scope="col">Product</th>
                                            <th scope="col">Order Date</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @if($orderDetails->count()>=1)
                                            @foreach($orderDetails as $key=>  $orderDetail)
                                                @php
                                                    $orderProduct=\App\OrderProduct::where('order_id',$orderDetail->id)->first();
                                                    $key++
                                                @endphp
                                                <tr>


                                                    <th scope="row">{{$key}}</th>
                                                    <td>{{$orderProduct->title}}</td>
                                                    <td>{{\Carbon\Carbon::parse($orderDetail['created_at'])->format('Y-m-d')}}</td>
                                                    <td>{{$orderDetail->frontendStatus}}</td>

                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td class="no-data" colspan="6">
                                                    <b>{{('You Have No Any Order!')}}</b>
                                                </td>
                                            </tr>

                                        @endif


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
