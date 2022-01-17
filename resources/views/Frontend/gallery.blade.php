@extends('Frontend.includes.master')
@section('content')
    <!-- content -->
    <div class="page-content">
        <div class="container">
            <h1 class="main-title text-dark text-center">Albums</h1>
            <div class="row">
                <div class="col-lg-4">
                    <a href="{{url('/gallery-detail')}}">
                        <div class="card album">
                            <img
                                    src="https://images.pexels.com/photos/1640777/pexels-photo-1640777.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                                    class="card-img-top gallery-album"
                                    alt="..."
                            />
                            <div class="card-body text-center">
                                <h5 class="card-title mb-0">27 Jan 2021</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="gallery-single.html">
                        <div class="card album">
                            <img
                                    src="https://images.pexels.com/photos/704569/pexels-photo-704569.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                                    class="card-img-top gallery-album"
                                    alt="..."
                            />
                            <div class="card-body text-center">
                                <h5 class="card-title mb-0">26 Jan 2021</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="gallery-single.html">
                        <div class="card album">
                            <img
                                    src="https://images.pexels.com/photos/315755/pexels-photo-315755.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                                    class="card-img-top gallery-album"
                                    alt="..."
                            />
                            <div class="card-body text-center">
                                <h5 class="card-title mb-0">25 Jan 2021</h5>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endsection