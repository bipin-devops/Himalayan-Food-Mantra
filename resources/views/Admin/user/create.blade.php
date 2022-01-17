@extends('layout')

@section('title', ('Add New User'))

@section('content')
    <ol class="breadcrumb">
        <li><a href="#">{{('Home')}}</a></li>
        <li><a href="#" >{{('Users')}}</a></li>
        <li class="active">{{('Add User')}}</li>
    </ol>

    <div id="page-title">
        <h2 style="display:inline-block">{{('Add User')}}</h2>
    </div>

    @include('errors/error')

    <div class="panel panel-default">
        <div class="panel-body">
            {!!Form::open(['method'=>'post','url'=>'system/user/store', 'class'=>'form-horizontal bordered-row','enctype'=>'multipart/form-data'])!!}
            <div class="form-group" style="border-top: 0px;">
                <label class="col-sm-3 control-label require">{{('First Name')}}</label>
                <div class="col-sm-6">
                    <input type="text" name="first_name" placeholder="{{('First Name')}}" class="form-control" value="">
                </div>
            </div>
            <div class="form-group" >
                <label class="col-sm-3 control-label require">{{('Last Name')}}</label>
                <div class="col-sm-6">
                    <input type="text" name="last_name" placeholder="{{('Last Name')}}" class="form-control" value="">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label require">{{('Email')}}</label>
                <div class="col-sm-6">
                    <input type="text" name="email" placeholder="{{('Email')}}" class="form-control" value="">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label require">{{('Username')}}</label>
                <div class="col-sm-6">
                    <input type="text" name="username" placeholder="{{('Username')}}" class="form-control" value="">
                </div>
            </div>


            <div class="password" >
                <div class="form-group">
                    <label class="col-sm-3 control-label require">{{('Password')}}</label>
                    <div class="col-sm-6">
                        <input type="password" name="password" placeholder="Password" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label require">{{('Confirm Password')}}</label>
                    <div class="col-sm-6">
                        <input type="password" name="password_confirmation" placeholder="Confirm Password" class="form-control">
                    </div>
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('name', 'Roles', ['class' => 'col-lg-3 control-label required_label']) !!}
                <div class="col-lg-9">
                    {!! Form::select('roles',$roles,null,['class'=>'form-control select2']) !!}
                    <span class="error">{{ $errors->first('staff_id') }}</span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">{{('Status')}}<span style="color:red;">*</span></label>
                <div class="col-sm-6">
                    <label class="radio-inline">
                        {{ Form::radio('status',1,true) }}
                        {{('Active')}}
                    </label>
                    <label class="radio-inline">
                        {{ Form::radio('status',0) }}
                        {{('Inactive')}}

                    </label>

                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3"></div>
                <div class="col-sm-7">
                    <a class="btn btn-default" href="{{URL::to('/user')}}"><i class="glyphicon glyphicon-chevron-left" style="margin-right:10px;"></i>{{('Back')}}</a>
                    <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-ok" style="margin-right:10px;"></i>{{('Save')}}</button>
                </div>
            </div>

            {!!Form::close() !!}
            <div class="clearfix"></div>

        </div>
    </div>

@stop

@section('scripts')
    <script type="text/javascript" src="{{asset('admin/js/plugins/forms/selects/select2.min.js')}}"></script>

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#fileinput-preview-thumbnail').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        if ($("#set-password").is(':checked')){
            $('.password').show();
            $('#password').attr('required','required');
            $('#password-confirm').attr('required','required');
        }

        function showSetpassword(){
            $('.password').show();
            $('#password').attr('required','required');
            $('#password-confirm').attr('required','required');
        }

        function hideSetpassword(){
            $('.password').hide();
            $('#password').val('');
            $('#password-confirm').val('');
            $('#password').removeAttr('required','required');
            $('#password-confirm').removeAttr('required','required');
        }

    </script>
@stop
