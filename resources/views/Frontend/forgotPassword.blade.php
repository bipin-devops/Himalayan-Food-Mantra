@extends('Frontend.includes.master')
@section('content')
    <div class="page-content">
        <div class="container">
            <h4 class="mb-4">
                <strong>Forgot your password ?</strong> Please provide your email.
            </h4>
            @include('errors/error')

            <div class="login-wrapper">
                <div class="row">
                    <div class="col-md-6">
                        {!!Form::open(['method'=>'post','url'=>'forgot-password', 'class'=>'form-horizontal bordered-row','enctype'=>'multipart/form-data'])!!}
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input
                                        type="email"
                                        name="email"
                                        class="form-control"
                                        placeholder="Enter your email"
                                        required
                                />
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                Submit
                            </button>
                        {!!Form::close() !!}
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex flex-column align-items-center">
                            <img src="{{asset('frontend/images/logo.png')}}" class="login-img" />
                            <p class="lead">
                                New member ?
                                <a href="{{('/register')}}" class="text-primary">Register here</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection