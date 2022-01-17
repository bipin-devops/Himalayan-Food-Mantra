@extends('layout')

@section('title') List of Roles Record @endsection
@section('content')

    <div class="panel panel-flat border-top-info">
        <div class="breadcrumb-line"><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
            <ul class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="icon-home2 position-left"></i> Home</a></li>
                <li class="active">role <span class="badge badge-info"></span></li>
            </ul>
        </div>
        <div class="panel-heading">
            {{--{!! Form::model($roles,['method'=>'GET','route'=>['role.index'],'class'=>'form-horizontal','role'=>'form','files'=>true]) !!}--}}

            <div class="row">
                <ul class="icons-list pull-right">
                    <li>

                        {{--<a class="btn  btn-sm btn-success" href="{{route('role.create')}}"><i class="glyphicon glyphicon-plus"></i> {{('Create New')}}</a>--}}

                    </li>



                </ul>


            </div>

            {!! Form::close() !!}

        </div>

        <br>
        <div class="panel-body">
            @include('flash::message')
        </div>

        {{--{!! Form::open(['route' => 'role.destroy','method'=>'DELETE','id'=>'formDelete']) !!}--}}
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="cf">
                <tr>
                    <th>{{('S.N.')}}</th>
                    <th>{{('Name')}}</th>
                    {{--@if($permissions['destroyPermission']|| $permissions['editPermission'])--}}
                        <th>{{('Action')}}</th>
                    {{--@endif--}}
                </tr>
                </thead>
                <tbody>
                @if($data->isEmpty())
                    <tr>
                        <td class="no-data" colspan="5">
                            <b>{{('No data to display!')}}</b>
                        </td>
                    </tr>
                @else
                    @php $a=$data->perPage() * ($data->currentPage()-1); @endphp
                    @foreach($data as $datum)
                        @php $a++;@endphp
                        <tr>
                            <td>{{ $a }}</td>
                            <td>{{$datum->name}}</td>
                            @if($permissions['destroyPermission']|| $permissions['editPermission'])
                                <td>
                                    @if($datum->name=='superuser')
                                        @if(Auth::guard('web')->user()->canDo('user.role.edit'))
                                            <a class="btn  btn-sm btn-info" href="#" disabled><i class="glyphicon glyphicon-edit"></i> {{('Edit')}}</a>
                                        @endif
                                        @if(Auth::guard('web')->user()->canDo('user.role.delete'))
                                            <a class="btn  btn-sm btn-danger" href="#" disabled><i class="glyphicon glyphicon-trash"></i> {{('Delete')}}</a>
                                        @endif

                                    @else
                                        @if($permissions['editPermission'])
                                            <a class="btn  btn-sm btn-info" href="{{URL::to('system'.'/role/'.$datum->id.'/edit')}}"><i class="glyphicon glyphicon-edit"></i> {{('Edit')}}</a>
                                        @endif &nbsp;
                                        @if($permissions['destroyPermission'])
                                                <a class="btn btn-sm btn-danger btn_glyph" href="{{URL::to('system/role/delete/'.$datum->id)}}"><i class="glyphicon glyphicon-trash"></i> {{('Delete')}}</a> @endif



                                    @endif
                                </td>
                            @endif
                        </tr>
                    @endforeach
                @endif
                </tbody>

            </table>
        </div>
        {!! Form::close() !!}
    </div>
@endsection