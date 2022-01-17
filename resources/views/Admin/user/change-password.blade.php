@extends('layout')

@section('title', ('Change Password'))

@section('content')
    <div class="col-md-12">

        <!-- Basic legend -->

        <div class="panel panel-flat border-top-info">
            <div class="breadcrumb-line"><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
                <ul class="breadcrumb">
                    <li><a href="{{ URL::to('/home') }}"><i class="icon-home2 position-left"></i> Home</a></li>
                    <li class="active">Change Password</li>
                </ul>
            </div>

            <div class="panel-body">
                {!! Form::open(['route'=>'setting.update.password','method'=>'POST','class'=>'form-horizontal','role'=>'form','files' => true]) !!}
                <fieldset>
                    @include('errors/error')

                    <div class="form-group require">
                        {!! Form::label('old_password', 'Old Password', ['class' => 'col-lg-3 control-label require']) !!}

                        <div class="col-lg-9">
                            {!! Form::text('old_password', $value = null, ['id'=>'old_password','class'=>'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group require">
                        {!! Form::label('password', 'Password', ['class' => 'col-lg-3 control-label require']) !!}
                        <div class="col-lg-9">
                            {!! Form::password('password', ['id'=>'password','class'=>'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group require">
                        {!! Form::label('password_confirmation', 'Confirm Password', ['class' => 'col-lg-3 control-label require']) !!}
                        <div class="col-lg-9">

                            {!! Form::password('password_confirmation', ['id'=>'password_confirmation','class'=>'form-control']) !!}
                        </div>
                    </div>



                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Submit form <i
                                    class="icon-arrow-right14 position-right"></i></button>
                    </div>
                </fieldset>

                {!! Form::close() !!}

            </div>

        </div>

        <!-- /basic legend -->

    </div>
    @endsection