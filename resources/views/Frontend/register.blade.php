

@extends('Frontend.includes.master')
@section('content')
    <div class="page-content">
        <div class="container">
            <h4 class="mb-4">
                <strong>Create your account </strong>
            </h4>
            @include('errors/error')

            <div class="login-wrapper">
                {!!Form::open(['method'=>'post','url'=>'register', 'class'=>'form-horizontal bordered-row','enctype'=>'multipart/form-data'])!!}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                 <label for="first_name">First Name</label>
                                <input
                                        type="text"
                                        name="first_name"
                                        id="first_name"
                                        class="form-control"
                                        required="required"
                                        placeholder="Enter your first name"
                                        autocomplete="off"
                                />
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input
                                        type="text"
                                        name="last_name"
                                        id="last_name"
                                        required="required"
                                        class="form-control"
                                        placeholder="Enter your last name"
                                        autocomplete="off"
                                />
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input
                                        type="text"
                                        name="mobile_number"
                                        required="required"
                                        id="phone"
                                        class="form-control"
                                        placeholder="Enter your phone number"
                                        autocomplete="off"
                                />
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input
                                        type="email"
                                        name="email"
                                        id="email"
                                        required="required"
                                        class="form-control"
                                        placeholder="Enter your email address"
                                        autocomplete="off"
                                />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input
                                        type="password"
                                        name="password"
                                        id="password"
                                        class="form-control"
                                        placeholder="Enter password"
                                        autocomplete="off"
                                />
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Confirm Password</label>
                                <input
                                        type="password"
                                        name="password_confirmation"
                                        id="password"
                                        class="form-control"
                                        placeholder="Confirm your password"
                                        autocomplete="off"
                                />
                            </div>
                            <button type="submit" class="btn btn-primary w-100">
                                Register
                            </button>

                            {!!Form::close() !!}
                            <p class="lead mt-3">
                                Already a member ?
                                <a href="{{'/login'}}" class="text-primary">Login</a>
                            </p>
                        </div>
                    </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
