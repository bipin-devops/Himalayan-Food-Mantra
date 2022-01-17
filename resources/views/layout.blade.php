<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
          type="text/css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          type="text/css">
    <link href="{{asset('admin/css/icons/icomoon/styles.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/css/bootstrap.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/css/core.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/css/components.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/css/custom.css')}}" rel="stylesheet" type="text/css">

    <link href="{{asset('admin/css/colors.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('lib/fancybox/source/jquery.fancybox.css')}}" rel="stylesheet" type="text/css">

    <!--HighSlide-->
    <link href="{{ asset('lib/highslide/highslide.css')}}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->
    <link href="{{asset('admin/css/pretty-checkbox.min.css')}}" rel="stylesheet" type="text/css">
    @yield('styles')
</head>
<body class="navbar-bottom">
<!-- Main navbar -->
<div class="navbar navbar-inverse bg-danger-400">
    @include('Admin.includes.sidebar_setting')
</div>
<!-- /main navbar -->
<!-- Page header -->
{{--<div class="page-header">--}}
{{--@include('admin::includes.header')--}}
{{--</div>--}}
<!-- /page header -->
<!-- Page container -->
<div class="page-container">
    <!-- Page content -->
    <div class="page-content">
        <!-- Main sidebar -->
        <div class="sidebar sidebar-main sidebar-default">
            @include('Admin.includes.sidebar_menu')
        </div>
        <!-- /main sidebar -->
        <!-- Main content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- /main content -->
    </div>
    <!-- /page content -->
</div>
<!-- /page container -->

<!-- Footer -->
<div class="navbar navbar-default navbar-fixed-bottom footer">
    <ul class="nav navbar-nav visible-xs-block">
        <li><a class="text-center collapsed" data-toggle="collapse" data-target="#footer"><i
                        class="icon-circle-up2"></i></a></li>
    </ul>
    <div class="navbar-collapse collapse" id="footer">
        @php
            $now = \Carbon\Carbon::now();
            $year = $now->year;
        @endphp
        <div class="navbar-text">
            &copy; {{$year}}. <a href="#" class="navbar-link">Admin panel</a> <a
                    href="http://themeforest.net/user/Kopyov" class="navbar-link" target="_blank"></a>
        </div>
    </div>
</div>
<style>
    .chart-scroll{
        overflow-x: auto;
        overflow-y: hidden;
    }

    .border-primary {
        border-color: #d4dcd4;
    }
</style>
<!-- Core JS files -->
<script type="text/javascript" src="{{asset('admin/js/core/libraries/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/plugins/loaders/pace.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/core/libraries/bootstrap.min.js')}}"></script>
<!-- /core JS files -->
<script type="text/javascript" src="{{asset('admin/js/plugins/forms/wizards/stepy.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/core/libraries/jasny_bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/pages/wizard_stepy.js')}}"></script>
<!-- Theme JS files -->
<script type="text/javascript" src="{{asset('admin/js/plugins/visualization/d3/d3.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/plugins/visualization/d3/d3_tooltip.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/plugins/forms/inputs/touchspin.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/plugins/forms/styling/switchery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/plugins/forms/styling/switch.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/plugins/forms/styling/uniform.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/plugins/forms/selects/bootstrap_multiselect.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/plugins/ui/moment/moment.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/plugins/pickers/daterangepicker.js')}}"></script>
<!--/editor -->
<script type="text/javascript" src="{{asset('admin/js/plugins/editors/summernote/summernote.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/plugins/forms/styling/uniform.min.js')}}"></script>
<!-- /theme JS files -->
<script type="text/javascript" src="{{asset('admin/js/plugins/forms/validation/validate.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/core/libraries/jquery_ui/interactions.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/plugins/tables/datatables/datatables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/plugins/forms/selects/select2.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/pages/datatables_advanced.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/plugins/notifications/sweet_alert.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/pages/datatables_data_sources.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/pages/datatables_extension_buttons_init.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/pages/form_select2.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/plugins/pickers/color/spectrum.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/core/app.js')}}"></script>
<!--color picker -->
<script type="text/javascript" src="{{asset('admin/js/pages/picker_color.js')}}"></script>
<!--/color -->

@yield('midscripts')

<!-- Date Time Picker -->
<script type="text/javascript" src="{{asset('admin/pickers/moment.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/pickers/daterangepicker.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/pickers/picker_date.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/plugins/pickers/anytime.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/plugins/pickers/pickadate/picker.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/plugins/pickers/pickadate/picker.date.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/plugins/pickers/pickadate/picker.time.js')}}"></script>

<script type="text/javascript" src="{{asset('admin/js/plugins/pickers/daterangepicker.js')}}"></script>

<script type="text/javascript" src="{{asset('admin/js/plugins/ui/moment/moment.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/pages/picker_date.js')}}"></script>

<!-- Date Time Picker -->

<script type="text/javascript" src="{{asset('admin/js/pages/editor_summernote.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/pages/form_validation.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/plugins/ui/ripple.min.js')}}"></script>
<script src="{{asset('lib/fancybox/source/jquery.fancybox.js')}}"></script>
<script src="{{ asset('lib/highslide/highslide.js')}}"></script>
<script src="{{ asset('lib/highslide/highslide-with-gallery.min.js')}}"></script>
<script type="text/javascript">
    hs.graphicsDir = '/lib/highslide/graphics/';
</script>
<!--check All-->
<!-- /theme JS files -->
<script type="text/javascript" src="{{asset('admin/js/plugins/forms/selects/select2.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/plugins/notifications/sweet_alert.min.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<!--custom admin js -->
<script type="text/javascript" src="{{asset('admin/js/check-all.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/custom.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/tinymce/tinymce.min.js')}}"></script>
<script>
    function loadTinyMce(){
        tinymce.init({ selector:'.texteditor',
            theme: 'modern',
            plugins: [
                'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
                'insertdatetime media nonbreaking save table contextmenu directionality',
                'template paste textcolor colorpicker textpattern imagetools codesample toc code responsivefilemanager'
            ],
//            relative_urls: false,
//            filemanager_title:"EKCMS Filemanager",
//            filemanager_crossdomain: true,



            {{--external_filemanager_path:"{{asset('admin/filemanager')}}/",--}}

            external_plugins: { "filemanager" : "{{asset('admin/filemanager/plugin.min.js')}}"},
            toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            toolbar2: 'print preview media | forecolor backcolor code',
            image_advtab: true,
            templates: [
                { title: 'Test template 1', content: 'Test 1' },
                { title: 'Test template 2', content: 'Test 2' }
            ]
        });
    }

    loadTinyMce();

    $('i.pending-order-count').closest('li').find('span').append('<span class="badge bg-teal-400 pending-order-count"></span>');

    // Update order count every 2 sec
    window.orderInterval = window.setInterval(function() {
        var url = "{{ route('backend.order.count') }}";
        $.ajax({
            url: url,
            method: 'get',
            data : {
                'status' : 'pending',
            },
            success: function(res){
                if($('.pending-order-count:not(i)').length && $('.pending-order-count:not(i)').first().text() != res.count && $('.pending-order-count:not(i)').first().text() != "") {
                    if($('.pending-order-count:not(i)').first().text() < res.count) {
                        swal({
                            title: "New Order!",
                            text: "We have recieved that pending order has gone up!",
                            icon: "success",
                        });
                    }
                }
                $('.pending-order-count:not(i)').text(res.count);
            },
            error: function(err){
            }
        });
    },5000);


</script>
<!--/custom admin js -->
{{--
<script type="text/javascript" src="{{asset('admin/js/plugins/forms/styling/switchery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/pages/form_checkboxes_radios.js')}}"></script>
--}}
@yield('scripts')
</body>
</html>
