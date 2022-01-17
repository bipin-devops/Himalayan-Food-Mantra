@extends('layout')
@section('title', "List Of". $title)
@section('content')
    <!-- Highlighting rows and columns -->
    <div class="panel panel-flat border-top-info">
        <div class="breadcrumb-line">
            <a class="breadcrumb-elements-toggle">
                <i class="icon-menu-open"></i>
            </a>
            <ul class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}"><i class="icon-home2 position-left"></i> Home</a>
                </li>
                <li class="active">{{ $title }} <span class="badge badge-info"></span></li>
            </ul>
        </div>

        <br>
        <div class="panel-body">
            @include('flash::message')
            <h3>Ordered Products</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data->orderProduct as $orderProduct)
                    <tr>
                        <th>{{ $orderProduct->title }}</th>
                        <th>{{ $orderProduct->quantity }}</th>
                        <th>{{ $orderProduct->unit_price }}</th>
                        <th>{{ $orderProduct->total }}</th>
                    </tr>

                    @endforeach
                    <tr class="bg-teal-400">
                        <th></th>
                        <th></th>
                        <th>Total</th>
                        <th>{{ $data->total }}</th>
                    </tr>
                </tbody>
            </table>
        </div>
        <hr>

        <div class="panel-body">
            <h3>Order Info</h3>

                <div class="row">
                    <div class="col-lg-6">
                        <form action="{{ route($route.'update', [$data->id]) }}" class='form-horizontal bordered-row' method="post">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label class="col-sm-3 control-label require">{{('Order Status')}}</label>
                                <div class="col-sm-9">
                                    {!! Form::select('status', $allStatus , old('status', $data->status) ,['id'=>'order_status','class'=>'form-control']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label require">{{('Payment Status')}}</label>
                                <div class="col-sm-9">
                                    {!! Form::select('payment_status', ['paid' => "Paid", "unpaid" => "Unpaid"], old('payment_status', $data->payment_status) ,['id'=>'payment_status','class'=>'form-control', 'readonly' => 'readonly', 'disabled' => 'disabled']) !!}
                                </div>
                            </div>
                            <div class="form-group text-right">

                            <button class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6">
                        <div class="well">
                            <p>Customer Name: {{ $data->name }}</p>
                            <p>Customer Contact: {{ $data->phone }}</p>
                            <p>Customer Address: {{ $data->address }}</p>
                            <p>Customer Email: {{ $data->email }}</p>
                        </div>

                    </div>
                </div>




        </div>


    </div>

@endsection
