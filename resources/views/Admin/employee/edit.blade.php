@extends('layout')

@section('title', ('Edit New Employee'))

@section('content')
    <ol class="breadcrumb">
        <li><a href="#">{{('Home')}}</a></li>
        <li><a href="#">{{('Employee')}}</a></li>
        <li class="active">{{('Edit Employee')}}</li>
    </ol>

    <div id="page-title">
        <h2 style="display:inline-block">{{('Edit Employee')}}</h2>
    </div>

    @include('errors/error')

    <div class="panel panel-default">
        <div class="panel-body">
            {!!Form::model($data,['method'=>'PUT','url'=>'system/employee/update/'.$data->id, 'class'=>'form-horizontal bordered-row','enctype'=>'multipart/form-data'])!!}
            <div class="form-group" style="border-top: 0px;">
                <label class="col-sm-3 control-label require">{{(' first Name')}}</label>
                <div class="col-sm-6">
                    <input type="text" name="name" placeholder="" required="required" class="form-control" value="{{$data->name}}">
                </div>
            </div>
            <div class="form-group" style="border-top: 0px;">
                <label class="col-sm-3 control-label require">{{('Last Name')}}</label>
                <div class="col-sm-6">
                    <input type="text" name="last" placeholder="" required="required" class="form-control" value="{{$data->last}}">
                </div>
            </div>
            <div class="form-group" style="border-top: 0px;">
                <label class="col-sm-3 control-label require">{{('Phone')}}</label>
                <div class="col-sm-6">
                    <input type="text" name="phone" placeholder="" required="required" class="form-control" value="{{$data->phone}}">
                </div>
            </div>
            <div class="form-group" style="border-top: 0px;">
                <label class="col-sm-3 control-label require">{{('Temporary Address')}}</label>
                <div class="col-sm-6">
                    <input type="text" name="temp_address" placeholder="" required="required" class="form-control"
                           value="{{$data->temp_address}}">
                </div>
            </div>
            <div class="form-group" style="border-top: 0px;">
                <label class="col-sm-3 control-label require">{{('Permanent Address')}}</label>
                <div class="col-sm-6">
                    <input type="text" name="per_address" placeholder="" required="required" class="form-control"
                           value="{{$data->per_address}}">
                </div>
            </div>
            <div class="form-group" style="border-top: 0px;">
                <label class="col-sm-3 control-label require">{{('Date of Join')}}</label>
                <div class="col-sm-6">
                    <input type="text" name="date_of_join" placeholder="" required="required"
                           class="form-control daterange-single"
                           value="{{$data->date_of_join}}">
                </div>
            </div>
            <div class="form-group" style="border-top: 0px;">
                <label class="col-sm-3 control-label require">{{('Date of birth')}}</label>
                <div class="col-sm-6">
                    <input type="text" name="dob" placeholder="" required="required"
                           class="form-control daterange-single"
                           value="{{$data->dob}}">
                </div>
            </div>
            <div class="form-group" style="border-top: 0px;">
                <label class="col-sm-3 control-label require">{{('Gender')}}</label>
                <div class="col-sm-6">
                    {!! Form::select('gender',$gender,$data->gender,['class'=>'form-control select2','placeholder'=>'Select gender']) !!}
                </div>
            </div>
            {{--<div class="form-group" style="border-top: 0px;">--}}
            {{--<label class="col-sm-3 control-label require">{{('salary')}}</label>--}}
            {{--<div class="col-sm-6">--}}
            {{--<input type="text" name="gender" placeholder="" required="required" class="form-control"--}}
            {{--value="">--}}
            {{--</div>--}}
            {{--</div>--}}

            <div class="form-group">
                <label class="col-sm-3 control-label require">{{('Image')}}</label>
                <div class="col-sm-6">
                    @if($is_edit)
                        <img id="employeeImage" src="{{asset('uploads/employee/'.$data->file_name) }}" alt="your image"
                             class="preview-image" style="size:50px"/>
                    @else
                        <img id="employeeImage" src="{{ asset('admin/images/no_img.png') }}" alt="your image"
                             class="preview-image" style="size:50px"/>
                    @endif
                    {!! Form::file('file_name', ['id'=>'file_name','class'=>'form-control',"onchange"=>"readURL(this,'employeeImage')"]) !!}
                    <span class="error">{{ $errors->first('file_name') }}</span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-3"></div>
                <div class="col-sm-7">
                    <a class="btn btn-default" href="{{URL::to('/system/employee')}}"><i
                                class="glyphicon glyphicon-chevron-left" style="margin-right:10px;"></i>{{('Back')}}</a>
                    <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-ok"
                                                                     style="margin-right:10px;"></i>{{('Save')}}
                    </button>
                </div>
            </div>

            {!!Form::close() !!}
            <div class="clearfix"></div>

        </div>
    </div>

@stop

@section('scripts')

@stop
