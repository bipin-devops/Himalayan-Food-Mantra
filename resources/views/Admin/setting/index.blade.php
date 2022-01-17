@extends('layout')
@section('title') Create Company Information @endsection
@section('breadcrumb')
    <li><a href="#">Company Information</a></li>
    <li class="active">Create</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- Basic layout-->
            <div class="panel panel-flat">
                @include('flash::message')
                <div class="panel-body">
                    {!!Form::open(['method'=>'post','url'=>'system/setting/store', 'class'=>'form-horizontal bordered-row','enctype'=>'multipart/form-data'])!!}
                    <div class="content-group border-top-lg border-top-success">
                        <div class="page-header page-header-default page-header-lg"
                             style="border-left: 1px solid #ddd; border-right: 1px solid #ddd;">
                            <div class="page-header-content">
                                <div class="page-title">
                                    <h4>COMPANY INFORMATION</h4>
                                    <a class="heading-elements-toggle"><i class="icon-more"></i></a></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('logo', 'Logo:', ['class' => 'col-md-2 control-label ']) !!}
                        <div class="col-md-3">
                            @if(empty($setting->logo))
                                <img id="logo" src="{{ asset('admin/images/no_img.png') }}" alt="your image"
                                     class="preview-image"/>
                            @else
                                <img id="logo" src="{{$setting->imageUrl}}" alt="your image"
                                     class="preview-image"/>
                            @endif
                            <input type="file" name="logo" onchange="readURL(this,'logo')" class="form-control">
                            {{--<p class="help-block">Image Size must be(179x40)</p>--}}
                            {!! Form::hidden('logo',!empty($setting->logo) ? $setting->logo:'',['id'=>'logo']) !!}
                            <span class="error">{{ $errors->first('logo') }}</span>

                            <h4> Header Logo</h4>
                        </div>
                        {{--<div class="col-md-3">--}}
                            {{--@if(empty($setting->footer_logo))--}}
                                {{--<img id="footer_logo" src="{{ asset('admin/images/no_img.png') }}" alt="your image"--}}
                                     {{--class="preview-image"/>--}}
                            {{--@else--}}
                                {{--<img id="footer_logo" src="{{asset('/uploads/setting/'.$setting->footer_logo)}}" alt="your image"--}}
                                     {{--class="preview-image"/>--}}
                            {{--@endif--}}
                            {{--<input type="file" name="footer_logo" onchange="readURL(this,'footer_logo')" class="form-control">--}}
                            {{--<p class="help-block">Image Size must be(179x40)</p>--}}
                            {{--{!! Form::hidden('footer_logo',!empty($setting->footer_logo) ? $setting->footer_logo:'',['id'=>'logo']) !!}--}}
                            {{--<span class="error">{{ $errors->first('Footer logo') }}</span>--}}

                            {{--<h4>Footer Logo</h4>--}}
                        {{--</div>--}}
                    </div>
                    <div class="content-group border-top-lg border-top-primary">
                        <div class="page-header page-header-default page-header-lg"
                             style="border-left: 1px solid #ddd; border-right: 1px solid #ddd;">
                            <div class="page-header-content">
                                <div class="page-title">
                                    <h4> GENERAL INFORMATION</h4>
                                    <a class="heading-elements-toggle"><i class="icon-more"></i></a></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('name', 'Company Name', ['class' => 'col-lg-2 control-label required_label']) !!}
                        <div class="col-lg-9">
                            {!! Form::text('name', !empty($setting->name)? $setting->name:null, ['id'=>'name','placeholder'=>'Company Name','class'=>'form-control']) !!}
                            <span class="error">{{ $errors->first('name') }}</span>
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('phone_1', 'Phone(Only first)', ['class' => 'col-lg-2 control-label required_label']) !!}

                        <div class="col-lg-5">
                            {!! Form::text('phone_1', !empty($setting->phone_1)? $setting->phone_1:null, ['id'=>'phone_1','placeholder'=>'Phone 1','class'=>'form-control']) !!}
                            <span class="error">{{ $errors->first('phone_1') }}</span>
                        </div>
                        <div class="col-lg-4">
                            {!! Form::text('phone_2', !empty($setting->phone_2)? $setting->phone_2:null, ['id'=>'phone_2','placeholder'=>'Phone 2','class'=>'form-control']) !!}
                            <span class="error">{{ $errors->first('phone_2') }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('email_1', 'Email(Only first)', ['class' => 'col-lg-2 control-label required_label']) !!}
                        <div class="col-lg-5">
                            {!! Form::text('email_1', !empty($setting->email_1)? $setting->email_1:null, ['id'=>'email_1','placeholder'=>'Email 1','class'=>'form-control']) !!}
                            <span class="error">{{ $errors->first('email_1') }}</span>
                        </div>
                        <div class="col-lg-4">
                            {!! Form::text('email_2', !empty($setting->email_2)? $setting->email_2:null, ['id'=>'email_2','placeholder'=>'Email 2','class'=>'form-control']) !!}
                            <span class="error">{{ $errors->first('email_2') }}</span>
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('address_line1', 'Address(Only first)', ['class' => 'col-lg-2 control-label required_label']) !!}

                        <div class="col-lg-3">
                            {!! Form::text('address_line1', !empty($setting->address_line1)? $setting->address_line1:null, ['id'=>'address_line1','placeholder'=>'Address 1','class'=>'form-control']) !!}
                            <span class="error">{{ $errors->first('address_line1') }}</span>
                        </div>
                        <div class="col-lg-3">
                            {!! Form::text('address_line2', !empty($setting->address_line2)? $setting->address_line2:null, ['id'=>'address_line2','placeholder'=>'Address 2','class'=>'form-control']) !!}
                            <span class="error">{{ $errors->first('address_line2') }}</span>
                        </div>
                        <div class="col-lg-3">
                            {!! Form::text('address_line3',!empty($setting->address_line3)? $setting->address_line3:null, ['id'=>'address_line3','placeholder'=>'Address 3','class'=>'form-control']) !!}
                            <span class="error">{{ $errors->first('address_line3') }}</span>
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('fax_1', 'Fax', ['class' => 'col-lg-2 control-label']) !!}
                        <div class="col-lg-5">
                            {!! Form::text('fax_1', !empty($setting->fax_1)? $setting->fax_1:null, ['id'=>'fax_1','placeholder'=>'Fax 1','class'=>'form-control']) !!}
                            <span class="error">{{ $errors->first('fax_1') }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('fax_1', 'Po.Box', ['class' => 'col-lg-2 control-label']) !!}
                        <div class="col-lg-4">
                            {!! Form::text('fax_2', !empty($setting->fax_2)? $setting->fax_2:null, ['id'=>'fax_2','placeholder'=>'Po.Box','class'=>'form-control']) !!}
                            <span class="error">{{ $errors->first('fax_2') }}</span>
                        </div>
                    </div>

                    {{--<div class="form-group">--}}
                    {{--{!! Form::label('google_map', 'Google Map', ['class' => 'col-lg-2 control-label']) !!}--}}
                    {{--<div class="col-lg-9">--}}
                    {{--{!! Form::text('google_map', !empty($setting->google_map)? $setting->google_map:null, ['id'=>'google_map','placeholder'=>'Google Map','class'=>'form-control']) !!}--}}
                    {{--<span class="error">{{ $errors->first('google_map') }}</span>--}}
                    {{--</div>--}}
                    {{--</div>--}}

                    {{--  <div class="content-group border-top-lg border-top-blue">
                          <div class="page-header page-header-default page-header-lg"
                               style="border-left: 1px solid #ddd; border-right: 1px solid #ddd;">
                              <div class="page-header-content">
                                  <div class="page-title">
                                      <h4>Meta Information</h4>
                                      <a class="heading-elements-toggle"><i class="icon-more"></i></a></div>
                              </div>
                          </div>
                      </div>

                      <div class="form-group">
                          {!! Form::label('meta_title', 'Meta Title', ['class' => 'col-lg-2 control-label']) !!}
                          <div class="col-lg-9">
                              {!! Form::text('meta_title', !empty($setting->meta_title)? $setting->meta_title:null, ['id'=>'meta_title','placeholder'=>'Meta Title','class'=>'form-control']) !!}
                              <span class="error">{{ $errors->first('meta_title') }}</span>
                          </div>
                      </div>

                      <div class="form-group">
                          {!! Form::label('meta_key', 'Meta Key', ['class' => 'col-lg-2 control-label']) !!}
                          <div class="col-lg-9">
                              {!! Form::text('meta_key', !empty($setting->meta_key)? $setting->meta_key:null, ['id'=>'meta_key','placeholder'=>'Meta Key','class'=>'form-control']) !!}
                              <span class="error">{{ $errors->first('meta_key') }}</span>
                          </div>
                      </div>
                      <div class="form-group">
                          {!! Form::label('meta_description', 'Meta Description', ['class' => 'col-lg-2 control-label']) !!}
                          <div class="col-lg-9">
                              {!! Form::textarea('meta_description', !empty($setting->meta_description)? $setting->meta_description:null, ['id'=>'meta_description','placeholder'=>'Meta Description','class'=>'form-control']) !!}
                              <span class="error">{{ $errors->first('meta_description') }}</span>
                          </div>
                      </div>--}}

                    {{-- <div class="content-group border-top-lg border-top-green-400">
                         <div class="page-header page-header-default page-header-lg"
                              style="border-left: 1px solid #ddd; border-right: 1px solid #ddd;">
                             <div class="page-header-content">
                                 <div class="page-title">
                                     <h4>Script</h4>
                                     <a class="heading-elements-toggle"><i class="icon-more"></i></a></div>
                             </div>
                         </div>
                     </div>
                     <div class="form-group">
                         {!! Form::label('header_script', 'Header Script', ['class' => 'col-lg-3 control-label']) !!}
                         <div class="col-lg-9">
                             {!! Form::textarea('header_script',!empty($setting->header_script)? $setting->header_script:null, ['id'=>'header_script','placeholder'=>'Header Script','class'=>'form-control']) !!}
                             <span class="error">{{ $errors->first('header_script') }}</span>
                         </div>
                     </div>
                     <div class="form-group">
                         {!! Form::label('footer_script', 'Footer Script', ['class' => 'col-lg-3 control-label']) !!}
                         <div class="col-lg-9">
                             {!! Form::textarea('footer_script',!empty($setting->footer_script)? $setting->footer_script:null, ['id'=>'footer_script','placeholder'=>'Footer Script','class'=>'form-control']) !!}
                             <span class="error">{{ $errors->first('footer_script') }}</span>
                         </div>
                     {{--</div>--}}
                    {{--<div class="content-group border-top-lg border-top-danger">--}}
                    {{--<div class="page-header page-header-default page-header-lg"--}}
                    {{--style="border-left: 1px solid #ddd; border-right: 1px solid #ddd;">--}}
                    {{--<div class="page-header-content">--}}
                    {{--<div class="page-title">--}}
                    {{--<h4>HIGHLAND BEANS BARISTA SCHOOL IN NUMBERS</h4>--}}
                    {{--<a class="heading-elements-toggle"><i class="icon-more"></i></a></div>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="form-group">--}}
                    {{--{!! Form::label('social_link', 'Barista Numers', ['class' => 'col-lg-2 control-label']) !!}--}}
                    {{--<div class="col-lg-3">--}}
                    {{--{!! Form::text('experience', !empty($setting->experience)? $setting->experience:null, ['id'=>'','placeholder'=>' years of experience','class'=>'form-control']) !!}--}}
                    {{--<span class="error">{{ $errors->first('experience') }}</span>--}}
                    {{--</div>--}}
                    {{--<div class="col-lg-3">--}}
                    {{--{!! Form::text('train', !empty($setting->train)? $setting->train:null, ['id'=>'train','placeholder'=>' students trained','class'=>'form-control']) !!}--}}
                    {{--<span class="error">{{ $errors->first('train') }}</span>--}}
                    {{--</div>--}}
                    {{--<div class="col-lg-3">--}}
                    {{--{!! Form::text('rate', !empty($setting->rate)? $setting->rate:null, ['id'=>'google','placeholder'=>'employment rate','class'=>'form-control']) !!}--}}
                    {{--<span class="error">{{ $errors->first('rate') }}</span>--}}
                    {{--</div>--}}
                    {{--</div>--}}

                    <div class="content-group border-top-lg border-top-danger">
                        <div class="page-header page-header-default page-header-lg"
                             style="border-left: 1px solid #ddd; border-right: 1px solid #ddd;">
                            <div class="page-header-content">
                                <div class="page-title">
                                    <h4>SOCIAL INFORMATION</h4>
                                    <a class="heading-elements-toggle"><i class="icon-more"></i></a></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('social_link', 'Link 1', ['class' => 'col-lg-2 control-label']) !!}
                        <div class="col-lg-3">
                            {!! Form::text('facebook', !empty($setting->facebook)? $setting->facebook:null, ['id'=>'facebook','placeholder'=>'Facebook','class'=>'form-control']) !!}
                            <span class="error">{{ $errors->first('facebook_link') }}</span>
                        </div>
                        <div class="col-lg-3">
                            {!! Form::text('twitter', !empty($setting->twitter)? $setting->twitter:null, ['id'=>'twitter','placeholder'=>'Twiter','class'=>'form-control']) !!}
                            <span class="error">{{ $errors->first('twitter') }}</span>
                        </div>
                        <div class="col-lg-3">
                            {!! Form::text('google', !empty($setting->google)? $setting->google:null, ['id'=>'google','placeholder'=>'Google Plus','class'=>'form-control']) !!}
                            <span class="error">{{ $errors->first('google') }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('social_link2', 'Link 2', ['class' => 'col-lg-2 control-label']) !!}
                        <div class="col-lg-5">
                            {!! Form::text('instagram', !empty($setting->instagram)? $setting->instagram:null ,['id'=>'instagram','placeholder'=>'Instagram','class'=>'form-control']) !!}
                            <span class="error">{{ $errors->first('instagram') }}</span>
                        </div>

                        <div class="col-lg-4">
                            {!! Form::text('youtube', !empty($setting->youtube)? $setting->youtube:null, ['id'=>'youtube','placeholder'=>'Youtube','class'=>'form-control']) !!}
                            <span class="error">{{ $errors->first('youtube') }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('social_num', 'Number', ['class' => 'col-lg-2 control-label']) !!}
                        <div class="col-lg-5">
                            {!! Form::text('wattsapp_no', !empty($setting->wattsapp_no)? $setting->wattsapp_no:null, ['id'=>'wattsapp_no','placeholder'=>'Whatts App','class'=>'form-control']) !!}
                            <span class="error">{{ $errors->first('wattsapp_no') }}</span>
                        </div>
                        <div class="col-lg-4">
                            {!! Form::text('viber_no', !empty($setting->viber_no)? $setting->viber_no:null, ['id'=>'viber_no','placeholder'=>'Viber','class'=>'form-control']) !!}
                            <span class="error">{{ $errors->first('viber_no') }}</span>
                        </div>
                    </div>

                    <div class="content-group border-top-lg border-top-primary-300-400">
                        <div class="page-header page-header-default page-header-lg"
                             style="border-left: 1px solid #ddd; border-right: 1px solid #ddd;">
                            <div class="page-header-content">
                                <div class="page-title">
                                    <h4> Footer Detail</h4>
                                    <a class="heading-elements-toggle"><i class="icon-more"></i></a></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('footer_detail', 'Footer Detail', ['class' => 'col-lg-3 control-label']) !!}
                        <div class="col-lg-9">
                            {!! Form::textarea('footer_detail',!empty($setting->footer_detail)? $setting->footer_detail:null, ['id'=>'footer_detail','placeholder'=>'Description','class'=>'texteditor ']) !!}
                            <span class="error">{{ $errors->first('footer_detail') }}</span>
                        </div>
                    </div>
                    <div class="text-right">

                        <button type="submit" class="btn btn-primary">Save <i
                                    class="icon-arrow-right14 position-right"></i></button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        function readURL(input, id) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#' + id)
                        .attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
