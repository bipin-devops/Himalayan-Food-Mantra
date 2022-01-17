


@extends('Frontend.includes.master')
@section('content')
    <!-- content -->
    <div class="page-content">
        <div class="container">
            <h4 class="mb-4">
                <strong>Welcome To Mantra ! Please Login. </strong>
            </h4>
            @include('errors/error')
            <div class="login-wrapper">
                <div class="row">
                    <div class="col-md-6">
                        {!!Form::open(['method'=>'post','url'=>'/login', 'class'=>'form-horizontal bordered-row','enctype'=>'multipart/form-data'])!!}
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input
                                        type="email"
                                        name="email"
                                        id="username"
                                        class="form-control"
                                        placeholder="email"
                                        autocomplete="off"
                                />
                            </div>
                            <div class="form-group">
                                <label for="email">Password</label>
                                <input
                                        type="password"
                                        name="password"
                                        id="password"
                                        class="form-control"
                                        placeholder="Password"
                                        autocomplete="off"
                                />
                            </div>
                            <div class="text-right mb-2">
                                <a href="{{url('/forgot-password')}}" class="text-danger"
                                >Forgot Password?</a
                                >
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                Login
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
