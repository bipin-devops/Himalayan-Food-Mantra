@extends('Frontend.includes.master')
@section('content')

    <div class="page-content">
        <div class="container">
            <h4 class="mb-4">
                <strong>Reset Password </strong>
            </h4>
            <div class="login-wrapper">
                <div class="row">
                    <div class="col-md-6">
                        {!!Form::open(['method'=>'post','url'=>'reset-password', 'class'=>'form-horizontal bordered-row','enctype'=>'multipart/form-data'])!!}
                        <input type="hidden" id="custId" name="token" value="{{$tokenId}}">

                        <div class="form-group">
                                <label for="password">New password</label>
                                <input
                                        type="password"
                                        name="password"
                                        id="password"
                                        class="form-control"
                                        placeholder="Enter new password"
                                        autocomplete="off"
                                />
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Confirm Password</label>
                                <input
                                        type="password"
                                        name="confirm_password"
                                        id="password"
                                        class="form-control"
                                        placeholder="Confirm new password"
                                        autocomplete="off"
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

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection