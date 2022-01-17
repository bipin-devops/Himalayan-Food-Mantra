@extends('layout')

@section('title', ('Add Page management'))

@section('content')
    <ol class="breadcrumb">
        <li><a href="#">{{('Home')}}</a></li>
        <li><a href="#" >{{('Page management')}}</a></li>
        <li class="active">{{(' Add Page management')}}</li>
    </ol>

    <div id="page-title">
        <h2 style="display:inline-block">{{('Page management')}}</h2>
    </div>

    @include('errors/error')

    <div class="panel panel-default">
        <div class="panel-body">
            {!!Form::open(['method'=>'post','url'=>'system/page/store', 'class'=>'form-horizontal bordered-row','enctype'=>'multipart/form-data'])!!}

            <div class="row clearfix">
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                    {!! Form::label('title', 'Title', ['class' => 'col-lg-3 control-label require']) !!}
                </div>
                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                    <div class="form-group">
                        <div class="form-line">
                            {!! Form::text('title', $value = null, ['id'=>'title','placeholder'=>'','class'=>'form-control']) !!}
                            <span class="text-danger">{{ $errors->first('title') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                    {!! Form::label('slug', 'Slug', ['class' => 'col-lg-3 control-label','readonly'=>'readonly']) !!}
                </div>
                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                    <div class="form-group">
                        <div class="form-line">
                            {!! Form::text('slug', $value = null, ['id'=>'slug','placeholder'=>'','class'=>'form-control']) !!}
                            <span class="text-danger">{{ $errors->first('slug') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            {{--<div class="row clearfix">--}}
                {{--<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">--}}
                    {{--{!! Form::label('into_text', 'Intro Text', ['class' => 'col-lg-3 control-label']) !!}--}}
                {{--</div>--}}
                {{--<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">--}}
                    {{--<div class="form-group">--}}
                        {{--<div class="form-line">--}}
                            {{--{!! Form::text('into_text', $value = null, ['id'=>'intro_text','placeholder'=>'','class'=>'form-control']) !!}--}}
                            {{--<span class="text-danger">{{ $errors->first('intro_text') }}</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            <div class="row clearfix">
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                    {!! Form::label('details', 'Description', ['class' => 'col-lg-3 control-label']) !!}
                </div>
                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                    <div class="form-group">
                        <div class="form-line">
                            {!! Form::textarea('details',$value = null, ['id'=>'texteditor','placeholder'=>'','class'=>'form-control texteditor']) !!}

                            <span class="text-danger">{{ $errors->first('details') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                    {!! Form::label('cover_image', 'Image', ['class' => 'col-lg-3 control-label']) !!}
                </div>
                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                    <div class="form-group">
                        <div class="form-line">
                            <input type="file" name="cover_image"  class="form-control" value="">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3"></div>
                <div class="col-sm-7">
                    <a class="btn btn-default" href="{{URL::to('/system/aboutEnglish')}}"><i class="glyphicon glyphicon-chevron-left" style="margin-right:10px;"></i>{{('Back')}}</a>
                    <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-ok" style="margin-right:10px;"></i>{{('Save')}}</button>
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
