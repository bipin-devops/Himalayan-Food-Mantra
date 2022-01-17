@extends('layout')
@section('title') Create Role @endsection
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="breadcrumb-line head-title"><a class="breadcrumb-elements-toggle"><i
                            class="icon-menu-open"></i></a>
                <ul class="breadcrumb">
                    <li><a href="{{ route('home') }}"><i class="icon-home2 position-left"></i> Home</a></li>
                    <li><a href="{{ route('role.index') }}"><i class="icon-image2 position-left"></i> Role
                            List</a></li>
                    <li class="active">Role Create</li>
                </ul>
            </div>
            <!-- Basic layout-->
            <div class="panel panel-body">
                <div class="panel-body">

                    @include('flash::message')


                    {!! Form::open(['route'=>'role.store','method'=>'POST','class'=>'form-horizontal','role'=>'form','files' => true]) !!}

                    <fieldset>
                        {{--<legend class="text-semibold">Fill Fields Properly</legend>--}}

                        <div class="form-group">
                            {!! Form::label('name','Role Name',['class'=>'col-lg-3 control-label']) !!}
                            <div class="col-lg-9">
                                {!! Form::text('name', $value = null, ['id'=>'name','class'=>'form-control','placeholder'=>'Role Name']) !!}
                                @if($errors->first('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif

                            </div>
                        </div>





                            <div class="form-group">
                                <label class="col-sm-3 control-label require">{{('Permission')}}</label>
                                <div class="col-sm-7">
                                    @foreach($permission as $key=>$module)
                                        <div class="panel clearfix" style="padding: 10px 15px 5px; background-color: #F7F7F7; border:1px solid #EFEFEF;">
                                            <div style="margin-top:5px; margin-bottom:3px;">
                                                <strong>
                                                    <label style="color: #7a1600  !important;">
                                                        <input type="checkbox" name="modules{{$key}}" value="{{$key}}" class="modulesClass modules" id={{$key}}>&nbsp;&nbsp;{{strtoupper($key)}}
                                                    </label>
                                                </strong>
                                            </div>

                                            @foreach($module as $value=>$module_title)
                                                <div style="float: left; margin-right: 0px; width: 33%; min-height: 30px; margin-top: 15px;">
                                                    <label style="color: #777;">
                                                        @php
                                                            $moduleValue = explode(".", $value);
                                                            $subModule = $moduleValue[0];
                                                            $actionModule = $moduleValue[1];
                                                            $className = $actionModule=="index" ? "main-".$subModule : $subModule;
                                                        @endphp
                                                        <input style=" height: 13px; float: left; margin-bottom: 20px; margin-right: 10px;" type="checkbox" name="permissions[]" id="{{$key.'_module'}}" data-module="{{$key}}" data-submodule="{{$className}}" value="{{$key.'.'.$value}}" class="permissionsList modulesClass permission {{$key.'_module'}}">&nbsp;&nbsp;{{$module_title}}&nbsp;&nbsp;
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            </div>





                    </fieldset>

                    <div class="text-right">
                        <button type="submit" class="btn btn-rounded btn-success btn-raised active"><i
                                    class="glyphicon glyphicon-floppy-disk"></i> Save
                        </button>
                        <a class="btn btn-rounded btn-danger btn-raised active" href="{{route('role.index')}}"> <i
                                    class="glyphicon glyphicon-arrow-left"></i> Back</a>
                    </div>

                    {!! Form::close() !!}
                </div>

            </div>
            <!-- /basic layout -->
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{asset('admin/js/plugins/forms/selects/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/js/plugins/forms/styling/uniform.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('admin/js/pages/form_layouts.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/js/plugins/forms/inputs/duallistbox.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('admin/js/pages/form_dual_listboxes.js')}}"></script>

    <script>
        $('.modules').click(function() {
            var module = $(this);
            if (module.prop('checked') !== false) {
                $('.permission').each(function() {
                    var value = $(this).data('module');

                    if (module.val() == value) {
                        $(this).prop('checked', true);
                    }
                });
            } else {
                $('.' + module.val() + '_module').each(function() {
                    $(this).prop('checked', false);
                });

            }

        });

        $('.permission').click(function() {
            var permission = $(this);
            var data = permission.val().split('.');
            var module = data[0];
            if (permission.prop('checked') == false) {
                var countChecked = $('.' + module + "_module:checked").length;
                if (countChecked == 0) {
                    $('#' + module).prop('checked', false);
                }
            } else {
                $('#' + module).prop('checked', true);
            }
        });
        //view checked when others checked
        $('.permissionsList').click(function() {
            let permission = $(this);
            let moduleName = permission.data("submodule");
            let isChecked = permission.is(":checked");
            if (isChecked) {
                $("[data-submodule=main-" + moduleName + "]").prop("checked", true);
            }
        });
    </script>

@endsection


