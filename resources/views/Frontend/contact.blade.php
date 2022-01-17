@extends('Frontend.includes.master')
@section('content')

    <!-- content -->
    <div class="page-content">
        <div class="container">
            <h4 class="mb-1 text-center"><strong>Contact Us</strong></h4>
            <p class="lead text-center mb-5">We would like to hear from you.</p>
            @include('errors/error')

            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="contact-form">
                        {!!Form::open(['method'=>'post','url'=>'/contact-us', 'class'=>'form-horizontal bordered-row','enctype'=>'multipart/form-data'])!!}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="firstName">Name</label>
                                        <input
                                                type="text"
                                                class="form-control"
                                                id="fullName"
                                                placeholder=""
                                                value=""
                                                name="name"
                                                required
                                        />
                                        <div class="invalid-feedback">
                                            Valid full name is required.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input
                                                type="email"
                                                class="form-control"
                                                id="email"
                                                placeholder=""
                                                value=""
                                                name="email"
                                                required
                                        />
                                        <div class="invalid-feedback">
                                            Valid email is required.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Phone Number</label>
                                        <input
                                                type="text"
                                                class="form-control"
                                                id="phone"
                                                name="phone_number"
                                                placeholder=""
                                                value=""
                                                required
                                        />
                                        <div class="invalid-feedback">
                                            Valid phone number is required.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input
                                                type="text"
                                                class="form-control"
                                                id="address"
                                                placeholder=""
                                                value=""
                                                name="address"
                                                required
                                        />
                                        <div class="invalid-feedback">
                                            Valid address is required.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="message">Message</label>
                                        <textarea
                                                class="form-control"
                                                id="exampleFormControlTextarea1"
                                                rows="3"
                                                name="message"
                                        ></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        {!!Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection