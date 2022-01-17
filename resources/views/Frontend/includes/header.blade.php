<!-- Header -->
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="{{url('/')}}">
            <img src="{{asset('frontend/images/logo.png')}}" alt="logo" class="logo"/>
        </a>
        <button
                class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="{{'/'}}">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{url('/about-us')}}">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('menu')}}">Our Menu</a>
                </li>
                {{--<li class="nav-item">--}}
                {{--<a class="nav-link" href="{{url('gallery')}}"> Our Gallery</a>--}}
                {{--</li>--}}
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/news')}}"> Our News</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/contact-us')}}">Contact Us</a>
                </li>
            </ul>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <a href="{{url('/cart')}}">
            <span class="cart-icon">
              <i class="fa fa-shopping-cart"></i>
              <span class="notification">{{ $totalCartProduct }}</span>
            </span>
                <span class="cart-value">$ <span class="value">{{ $cart ? $cart->total : 0 }}</span></span>
            </a>
            <div class="profile-wrapper">
                <a href="{{route('frontend.user.profile')}}">
                    <img src="{{asset('frontend/images/avatar.png')}}" alt="avatar" class="avatar"/>
                </a>
                <h5>{{Auth::guard('customer')->user()->first_name ?? ''}} {{Auth::guard('customer')->user()->last_name ?? ''}}</h5>
                @if(Auth::guard('customer')->user())
                <a href="{{url('/customer-logout')}}">
                    <h5>logout</h5>
                </a>
                    @endif
            </div>
        </ul>
    </div>
</nav>
