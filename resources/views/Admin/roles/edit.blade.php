@extends('layout')
@section('title') Edit Role  @endsection
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="breadcrumb-line head-title"><a class="breadcrumb-elements-toggle"><i
                            class="icon-menu-open"></i></a>
                <ul class="breadcrumb">
                    <li><a href="{{ route('home') }}"><i class="icon-home2 position-left"></i> Home</a></li>
                    <li><a href="{{ route('role.index') }}"><i class="icon-image2 position-left"></i> role
                            List</a></li>
                    <li class="active">role Update</li>
                </ul>
            </div>
            <!-- Basic layout-->
            <div class="panel panel-body">
                <div class="panel-body">

                    @include('flash::message')


                    {!!Form::open(['method'=>'put','url'=>'system'.'/role/'.$data->id, 'class'=>'form-horizontal bordered-row'])!!}
                    <input type="hidden" name="id" value="{{$data->id}}">
                    <div class="form-group">
                        <label class="col-sm-3 control-label require">{{('Name')}}</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control " name="name" value="{{$data->name}}">
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-3 control-label require">{{('Permission')}}</label>
                        <div class="col-sm-7">

                            @foreach($permission as $key=>$module)
                                <div class="panel clearfix" style="padding: 10px 15px; background-color: #F7F7F7; border:1px solid #EFEFEF;">
                                    <div style="margin-top:5px; margin-bottom:3px;">
                                        <strong>
                                            <label style="color: #7a1600  !important;">
                                                <input type="checkbox" name="modules{{$key}}" value="{{$key}}" class="modulesClass modules" id={{$key}} @if(array_key_exists($key,$userPermission)){{"checked"}}@endif>&nbsp;&nbsp;{{strtoupper($key)}}
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
                                                <input style=" height: 13px; float: left; margin-bottom: 20px; margin-right: 10px;" type="checkbox" name="permissions[]" id="{{$key.'_module'}}" data-module="{{$key}}" data-submodule="{{$className}}" value="{{$key.'.'.$value}}" class="permissionsList modulesClass permission {{$key.'_module'}}" <?php foreach ($userPermission as $userKey => $module) {
                                                    foreach ($module as $userP => $module_titleP) {
                                                        if ($userP == $value) {
                                                            echo "checked";
                                                        }
                                                    }
                                                }
                                                    ?>>&nbsp;&nbsp;{{$module_title}}&nbsp;&nbsp;
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">&nbsp;</label>
                        <div class="col-sm-7" style="margin-bottom:30px">
                            <div class="pull-left">
                                <a class="btn btn-default" href="{{URL::to('system'.'/role')}}"><i class="glyphicon glyphicon-chevron-left" style="margin-right:10px;"></i>{{('Back')}}</a>
                                <button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-ok" style="margin-right:10px;"></i>{{('Save')}}</button>
                            </div>
                        </div>
                    </div>
                    {!!Form::close() !!}


        </div>
    </div>
@stop
@section('scripts')
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
        //view check when others checked
        $('.permissionsList').click(function() {
            let permission = $(this);
            let moduleName = permission.data("submodule");

            let isChecked = permission.is(":checked");
            if (isChecked) {
                $("[data-submodule=main-" + moduleName + "]").prop("checked", true);
            }
            // else {
            //   let checkedLength = $("[data-submodule=" + moduleName + "]:checked").length;
            //   if (checkedLength == 0) {
            //      $("[data-submodule=main-"+moduleName+"]").prop("checked", false);
            //   }
            // }
        });
    </script>
@stop