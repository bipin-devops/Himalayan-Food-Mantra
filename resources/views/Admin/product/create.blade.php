@extends('layout')

@section('title', ('Add New Product'))

@section('content')
    <ol class="breadcrumb">
        <li><a href="#">{{('Home')}}</a></li>
        <li><a href="#">{{('Product')}}</a></li>
        <li class="active">{{('Add Product')}}</li>
    </ol>

    <div id="page-title">
        <h2 style="display:inline-block">{{('Add Product')}}</h2>
    </div>

    @include('errors/error')

    <div class="panel panel-default">
        <div class="panel-body">
            {!!Form::open(['method'=>'post','url'=>'system/product/store', 'class'=>'form-horizontal bordered-row','enctype'=>'multipart/form-data'])!!}

            <div class="form-group" style="border-top: 0px;">
                <label class="col-sm-3 control-label require">{{('Category')}}</label>
                <div class="col-sm-6">
                    {!! Form::select('category_id',$category,null,['class'=>'form-control select2','placeholder'=>'Select category','required'=>'required']) !!}
                </div>
            </div>
            <div class="form-group" style="border-top: 0px;">
                <label class="col-sm-3 control-label require">{{('Title')}}</label>
                <div class="col-sm-6">
                    <input type="text" name="title" id="title" placeholder="" required="required" class="form-control"
                           value="">
                </div>
            </div>
            <div class="form-group" style="border-top: 0px;">
                <label class="col-sm-3 control-label require">{{('slug')}}</label>
                <div class="col-sm-6">
                    <input type="text" name="slug" id="slug" placeholder="" required="required" class="form-control"
                           value="">
                </div>
            </div>
            <div class="form-group" style="border-top: 0px;">
                <label class="col-sm-3 control-label require">{{('Product Ingredients')}}</label>
                <div class="col-sm-6">
                    <input type="text" name="product_ingredients" id="" placeholder="" required="required" class="form-control"
                           value="">
                </div>
            </div>
            <div class="form-group" style="border-top: 0px;">
                <label class="col-sm-3 control-label ">{{('Short Description')}}</label>
                <div class="col-sm-6">
                    {{ Form::textarea('description',null,['class'=>' ','rows'=>'5','cols'=>'71','placeholder'=>'']) }}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label ">{{('Description')}}</label>
                <div class="col-sm-9">
                    {{ Form::textarea('description',null,['class'=>' texteditor','rows'=>'10','placeholder'=>'Description']) }}

                </div>
            </div>


            <div class="form-group" style="border-top: 0px;">
                <label class="col-sm-3 control-label require">{{('price')}}</label>
                <div class="col-sm-6">
                    <input type="text" name="price" placeholder="" required="required" class="form-control"
                           value="">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label require">{{('Image')}}</label>
                <div class="col-sm-6">
                    <img id="employeeImage" src="{{ asset('admin/images/no_img.png') }}" alt="your image"
                         class="preview-image" style="size:50px"/>
                    {!! Form::file('image', ['id'=>'file_name','class'=>'form-control',"onchange"=>"readURL(this,'employeeImage')"]) !!}
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-3"></div>
                <div class="col-sm-7">
                    <a class="btn btn-default" href="{{URL::to('/system/product')}}"><i
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
