@extends('layout')

@section('title', ('Edit New News'))

@section('content')
    <ol class="breadcrumb">
        <li><a href="#">{{('Home')}}</a></li>
        <li><a href="#">{{('News')}}</a></li>
        <li class="active">{{('Edit News')}}</li>
    </ol>

    <div id="page-title">
        <h2 style="display:inline-block">{{('Edit News')}}</h2>
    </div>

    @include('errors/error')

    <div class="panel panel-default">
        <div class="panel-body">
            {!!Form::model($data,['method'=>'PUT','url'=>'system/news/update/'.$data->id, 'class'=>'form-horizontal bordered-row','enctype'=>'multipart/form-data'])!!}


            <div class="form-group" style="border-top: 0px;">
                <label class="col-sm-3 control-label require">{{('Title')}}</label>
                <div class="col-sm-6">
                    <input type="text" name="title" id="title" placeholder="" required="required" class="form-control"
                           value="{{$data->title}}">
                </div>
            </div>
            <div class="form-group" style="border-top: 0px;">
                <label class="col-sm-3 control-label require">{{('slug')}}</label>
                <div class="col-sm-6">
                    <input type="text" name="slug" id="slug" placeholder="" required="required" class="form-control"
                           value="{{$data->slug}}">
                </div>
            </div>


            <div class="form-group">
                <label class="col-sm-3 control-label ">{{('Description')}}</label>
                <div class="col-sm-9">
                    {{ Form::textarea('description',null,['class'=>' texteditor','rows'=>'10','placeholder'=>'Description']) }}

                </div>
            </div>





            <div class="form-group">
                <label class="col-sm-3 control-label require">{{('Image')}}</label>
                <div class="col-sm-6">

                    <img id="employeeImage" src="{{ $data->imageUrl }}" alt="your image" class="preview-image" style="size:50px"/>

                    {!! Form::file('image', ['id'=>'file_name','class'=>'form-control',"onchange"=>"readURL(this,'employeeImage')"]) !!}
                    <span class="error">{{ $errors->first('image') }}</span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-3"></div>
                <div class="col-sm-7">
                    <a class="btn btn-default" href="{{URL::to('/system/news')}}"><i
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
    <script src="{{asset('admin/js/slugfy.js')}}"></script>


@stop
