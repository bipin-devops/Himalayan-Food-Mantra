<!-- Footer -->
<footer class="page-footer">
    <div style="background-color: #648b3c">
        <div class="container">
            <div class="row py-4 d-flex align-items-center">
                <div class="col-md-6 col-lg-5 text-md-left mb-4 mb-md-0">
                    <h6 class="mb-0 text-white">
                        Get connected with us on social networks!
                    </h6>
                </div>
                <div class="col-md-6 col-lg-7 text-center text-md-right">
                    <!-- Facebook -->
                    <a class="fb-ic" href="{{isset($setting->facebook)? $setting->facebook:''}}" target="_blank">

                        <i class="fab fa-facebook-f text-white mr-4"> </i>
                    </a>

                    <!--Instagram-->
                    <a class="ins-ic" href="{{isset($setting->instagram)? $setting->instagram:''}}" target="_blank">
                        <i class="fab fa-instagram text-white"> </i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Links -->
    <div class="bg-dark">
        <div class="container text-center text-md-left pt-5">
            <div class="row mt-3">
                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                    <h6 class="text-uppercase font-weight-bold">
                        Himalayan Food Mantra
                    </h6>
                    <hr
                            class="bg-primary mb-4 mt-0 d-inline-block mx-auto"
                            style="width: 60px"
                    />
                    <p>
                        {!! $setting->footer_detail !!}
                    </p>
                </div>
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                    <h6 class="text-uppercase font-weight-bold">Categories</h6>
                    <hr
                            class="bg-primary mb-4 mt-0 d-inline-block mx-auto"
                            style="width: 60px"
                    />
                    @if(isset($categories))
                        @foreach($categories as $category)

                            <p class="mb-2">
                                <a href="{{('/category/'.$category->id)}}">{{$category->name}}</a>
                            </p>
                        @endforeach
                    @endif

                </div>

                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                    <h6 class="text-uppercase font-weight-bold">Contact</h6>
                    <hr
                            class="bg-primary mb-4 mt-0 d-inline-block mx-auto"
                            style="width: 60px"
                    />

                    <p class="mb-2">
                        <i class="fas fa-map-marker-alt mr-3"></i> {!!isset($setting->address_line1) ? $setting->address_line1:'' !!}
                    </p>
                    <p class="mb-2">
                        <i class="fas fa-envelope mr-3"></i> {!!isset($setting->email_1) ? $setting->email_1:'' !!}
                    </p>
                    <p class="mb-2">
                        <i class="fas fa-phone mr-3"></i> {!!isset($setting->phone_1) ? $setting->phone_1:'' !!}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">
        © 2021 Copyright:
        <a href=""> Himalayan Food Mantra</a>
    </div>
</footer>
<!-- Footer -->

<script src="{{asset('frontend/js/jquery.min.js')}}"></script>
<script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
<script src="{{asset('frontend/js/slick.min.js')}}"></script>
<script src="{{asset('frontend/js/lightbox.js')}}"></script>
<script>
    $(".categories").slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
    });
</script>
</body>
</html>