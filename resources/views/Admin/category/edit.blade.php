@extends('layout')

@section('title', ('Edit New Employee'))

@section('content')
    <ol class="breadcrumb">
        <li><a href="#">{{('Home')}}</a></li>
        <li><a href="#">{{('Category')}}</a></li>
        <li class="active">{{('Edit Category')}}</li>
    </ol>

    <div id="page-title">
        <h2 style="display:inline-block">{{('Edit Category')}}</h2>
    </div>

    @include('errors/error')

    <div class="panel panel-default">
        <div class="panel-body">
            {!!Form::model($data,['method'=>'PUT','url'=>'system/category/update/'.$data->id, 'class'=>'form-horizontal bordered-row','enctype'=>'multipart/form-data'])!!}
            <div class="form-group" style="border-top: 0px;">
                <label class="col-sm-3 control-label require">{{(' first Name')}}</label>
                <div class="col-sm-6">
                    <input type="text" name="name" placeholder="" required="required" class="form-control"
                           value="{{$data->name}}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label require">{{('Image')}}</label>
                <div class="col-sm-6">
                    @if($data->image)
                        <img id="employeeImage" src="{{$data->imageUrl }}" alt="your image"
                             class="preview-image" style="size:50px"/>
                    @else
                        <img id="employeeImage" src="{{ asset('admin/images/no_img.png') }}" alt="your image"
                             class="preview-image" style="size:50px"/>
                    @endif
                    {!! Form::file('image', ['id'=>'file_name','class'=>'form-control',"onchange"=>"readURL(this,'employeeImage')"]) !!}
                    <span class="error">{{ $errors->first('image') }}</span>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3"></div>
                <div class="col-sm-7">
                    <a class="btn btn-default" href="{{URL::to('/system/category')}}"><i
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
