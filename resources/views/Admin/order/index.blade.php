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
            <div class="content-display clearfix">
                <div class="panel panel-default">
                    <div class="panel-heading no-bdr">
                        <div class="row">
                            <div class="col-sm-6">
                            </div>

                            <div class="col-sm-6 text-right">
                                {!!Form::open(['method'=>'GET','url'=>route($route."index"), 'class'=>'form-inline'])!!}
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Search ..." name="keywords" value="{{$input['keywords'] ?? ""}}" autocomplete="off">
                                    &nbsp; &nbsp; &nbsp; &nbsp;
                                    <button type="submit" class="btn btn-primary">{{('Search')}}</button>
                                </div>
                                {!!Form::close() !!}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            @php
                $indexTable = [
                    "Ref No" => 'reference_no',
                    "Customer" => 'name',
                    "Email" => 'email',
                    "Total" => 'total',
                    "Status" => 'status',
                    "Payment" => 'payment_status',
                    "Ordered" => function($item){ return $item->created_at->diffForHumans(); }
                ];
            @endphp
            @include('Admin.components.table', [
                'indexTable' => $indexTable,
                'permission' => $permission,
                'data' => $data,
                'input' => $input,
                'action' => [ 'show']
            ])
        </div>

    </div>

@endsection
