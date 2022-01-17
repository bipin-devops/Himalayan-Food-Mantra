<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>HIMALAYAN FOOD MANTRA</title>
    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}" />
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
    crossorigin="anonymous"
    />
    <link rel="stylesheet" href="{{asset('frontend/css/slick.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/css/slick-theme.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/css/lightbox.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/css/styles.css')}}" />
</head>
<body>

    @include(' Frontend.includes.header')

    @yield('content')



    <script type="text/javascript" src="{{asset('frontend/js/sweetalert.min.js')}}"></script>

    @include(' Frontend.includes.footer')
    @include('errors/swal')

    @yield('scripts')
</body>
</html>
