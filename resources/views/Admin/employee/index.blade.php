@extends('layout')
@section('title') List of Employee @endsection
@section('content')
    <div class="panel panel-flat border-top-info">
        <div class="breadcrumb-line"><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
            <ul class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="icon-home2 position-left"></i> Home</a></li>
                <li class="active">{{$pageTitle}} <span class="badge badge-info"></span></li>
            </ul>
        </div>
        <div class="panel-heading">

            <div class="row">
                <ul class="icons-list pull-right">
                    <li>
                        <a class="btn btn-success" href="{{URL::to('system/employee/create')}}"><i
                                    class="glyphicon glyphicon-plus" style="margin-right:10px;"></i>{{('Add New')}}</a>

                    </li>
                </ul>
            </div>
        </div>

        <br>
        <div class="panel-body">
            @include('flash::message')
            <div class="content-display clearfix">
                <div class="panel panel-default">
                    <div class="panel-heading no-bdr">
                        <div class="row">
                            <div class="col-sm-6">
                                {!!Form::open(['method'=>'GET','url'=>'system/employee', 'class'=>'form-inline'])!!}
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="keywords" name="keywords"
                                           value="{{\Illuminate\Support\Facades\Request::get('keywords')}}"
                                           autocomplete="off">
                                    &nbsp;&nbsp;


                                    &nbsp; &nbsp;
                                    <button type="submit" class="btn btn-primary">{{('Search')}}</button>
                                </div>
                            </div>
                            {!!Form::close() !!}

                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <tr>
                    <th>{{('S.N.')}}</th>
                    <th>{{('Image ')}}</th>
                    <th>{{('Name')}} </th>
                    <th>{{('Address')}} </th>


                    <th>{{('Action')}}</th>

                </tr>
                </thead>
                <tbody>

                @if($datas->isEmpty())
                    <tr>
                        <td class="no-data" colspan="6">
                            <b>{{('No data to display!')}}</b>
                        </td>
                    </tr>
                @else
                    @php $a=$datas->perPage() * ($datas->currentPage()-1); @endphp
                    @foreach($datas as $datum)
                        @php $a++;@endphp
                        <tr>
                            <td>{{ $a }}</td>
                            @if($datum->file_name)
                                <td>
                                    <img src="{{ asset('uploads/employee/'.$datum->file_name) }}"
                                         alt="{{ $datum->title }}" width="85">
                                </td>
                            @else <td></td> @endif
                            <td>{{$datum->name}}</td>
                            <td>{{$datum->temp_address ?? ''}}</td>

                            <td>

                                <a class="btn btn-sm btn-info btn_glyph"
                                   href="{{URL::to('system/employee/edit/'.$datum->id)}}"><i
                                            class="glyphicon glyphicon-edit"></i> {{('Edit')}}</a>
                                <a class="btn btn-sm btn-danger btn_glyph" onclick="return confirm(' you want to delete?');"
                                   href="{{URL::to('system/employee/delete/'.$datum->id)}}"><i
                                            class="glyphicon glyphicon-trash"></i> {{('Delete')}}</a>


                            </td>

                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>

    @if(!$datas->isEmpty())
        <div class="pagination-tile">
            <label class="pagination-sub" style="display: block">
                {{('Showing') }} {{($datas->currentpage()-1)*$datas->perpage()+1}} {{('to')}} {{(($datas->currentpage()-1)*$datas->perpage())+$datas->count()}} {{('of')}} {{$datas->total()}} {{('entries')}}
            </label>
            <ul class="pagination">
                {!! str_replace('/?', '?',$datas->appends(['keywords'=>Request::get('keywords')])->render()) !!}
            </ul>
        </div>
    @endif
    @endsection