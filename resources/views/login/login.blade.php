<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Cms</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
          type="text/css">
    <link href="{{asset('admin/css/icons/icomoon/styles.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/css/bootstrap.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/css/core.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/css/components.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/css/colors.css')}}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script type="text/javascript" src="{{asset('admin/js/plugins/loaders/pace.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/js/core/libraries/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/js/core/libraries/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/js/plugins/loaders/blockui.min.js')}}"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script type="text/javascript" src="{{asset('admin/js/plugins/forms/styling/uniform.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('admin/js/core/app.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/js/pages/login.js')}}"></script>

    <script type="text/javascript" src="{{asset('admin/js/plugins/ui/ripple.min.js')}}"></script>
    <!-- /theme JS files -->

</head>

<body class="navbar-bottom login-container">
<!-- Page container -->
<div class="page-container">
    <!-- Page content -->
    <div class="page-content">
        <!-- Main content -->
        <div class="content-wrapper">
            <!-- Advanced login -->
            {!! Form::open(['route' => 'login-post','method'=>'POST','id'=>'sign_in']) !!}
            <div class="panel panel-body login-form">
                <div class="text-center">
                    <div class="icon-object" style="padding: 0">
                        {{--<img src="{{asset('admin/images/gyan1.png')}}" width="100px" alt="">--}}
                    </div>
                    <h5 class="content-group"> Himalaya Food Mantra
                    </h5>
                </div>
                @include('flash::message')
                <div class="form-group has-feedback has-feedback-left">
                    {!! Form::text('email', $value = null, ['id'=>'email','placeholder'=>'Email','class'=>'form-control','autofocus']) !!}
                    <div class="form-control-feedback">
                        <i class="icon-user text-muted"></i>
                    </div>
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                </div>

                <div class="form-group has-feedback has-feedback-left">
                    {!! Form::password('password', ['id'=>'password','placeholder'=>'Password','class'=>'form-control']) !!}
                    <div class="form-control-feedback">
                        <i class="icon-lock2 text-muted"></i>
                    </div>
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                </div>

                <div class="form-group login-options">
                    <div class="row">
                        {{--<div class="col-sm-6">--}}
                        {{--<label class="checkbox-inline">--}}
                        {{--{!! Form::checkbox('remember',1,false, ['id'=>'remember_me','class'=>'filled-in chk-col-pink']) !!}--}}
                        {{--Remember--}}
                        {{--</label>--}}
                        {{--</div>--}}
                        {{--<div class="col-sm-6 text-right">--}}
                        {{--<a href="#">Forgot password?</a>--}}
                        {{--</div>--}}
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn bg-info-700 btn-block">Login
                        <i class="icon-arrow-right14 position-right"></i>
                    </button>
                </div>
            </div>
        {!! Form::close() !!}
        <!-- /advanced login -->
        </div>
        <!-- /main content -->
    </div>
    <!-- /page content -->
</div>
<!-- /page container -->
</body>
</html>
