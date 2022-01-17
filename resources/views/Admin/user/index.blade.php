@extends('layout')
@section('title', "List of Customer")
@section('content')
    <!-- Highlighting rows and columns -->
    <div class="panel panel-flat border-top-info">
        <div class="breadcrumb-line"><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
            <ul class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="icon-home2 position-left"></i> Home</a></li>
                <li class="active">User <span class="badge badge-info"></span></li>
            </ul>
        </div>
        <div class="panel-heading">
            {{--{!! Form::model($users,['method'=>'GET','route'=>['user.index'],'class'=>'form-horizontal','role'=>'form','files'=>true]) !!}--}}

            <div class="row">
                <ul class="icons-list pull-right">
                    <li>
                        <a class="btn btn-success" href="{{URL::to('system/user/create')}}"><i
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
                                {!!Form::open(['method'=>'GET','url'=>'system/user', 'class'=>'form-inline'])!!}
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="keywords" name="keywords"
                                           value="{{\Illuminate\Support\Facades\Request::get('keywords')}}"
                                           autocomplete="off">
                                    &nbsp;&nbsp;

                                    {{--<select name="role" class="form-control">--}}
                                    {{--<option value="">{{('Select Role')}} </option>--}}
                                    {{--@foreach($roles as $role)--}}
                                    {{--<option value="{{$role->id}}" @if(Request::get('role')==$role->id) selected @endif--}}
                                    {{--</select> {{$role->name}}</option>--}}
                                    {{--@endforeach--}}
                                    {{--</select>--}}
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
                    <th>{{('Name') }}</th>
                    <th>{{('Username')}} </th>
                    <th>{{('Email')}} </th>
                    <th>{{('Role')}} </th>
                    @if($data['destroyPermission']|| $data['editPermission'])
                        <th>{{('Action')}}</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                @if($users->isEmpty())
                    <tr>
                        <td class="no-data" colspan="6">
                            <b>{{('No data to display!')}}</b>
                        </td>
                    </tr>
                @else
                    @php $a=$users->perPage() * ($users->currentPage()-1); @endphp
                    @foreach($users as $datum)
                        @php $a++;@endphp
                        <tr>
                            <td>{{ $a }}</td>
                            <td>{{$datum->first_name .' '.$datum->last_name}}</td>
                            <td>{{$datum->username}}</td>
                            <td>{{$datum->email}}</td>
                            <td class="capital">{{$datum->rolesUser? $datum->rolesUser->role->name : 'N/A'}}</td>

                            <td>


                                <a class="btn  btn-sm btn-info" href="{{URL::to('system/user/edit/'.$datum->id)}}"><i
                                            class="glyphicon glyphicon-edit"></i> {{('Edit')}}</a>

                                @if(Auth::guard('web')->user()->canDo('user.role.delete'))
                                    <a class="btn  btn-sm btn-danger" href="#" disabled><i
                                                class="glyphicon glyphicon-trash"></i> {{('Delete')}}</a>
                                @endif



                            </td>

                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>

    @if(!$users->isEmpty())
        <div class="pagination-tile">
            <label class="pagination-sub" style="display: block">
                {{('Showing') }} {{($users->currentpage()-1)*$users->perpage()+1}} {{('to')}} {{(($users->currentpage()-1)*$users->perpage())+$users->count()}} {{('of')}} {{$users->total()}} {{('entries')}}
            </label>
            <ul class="pagination">
                {!! str_replace('/?', '?',$users->appends(['keywords'=>Request::get('keywords')])->render()) !!}
            </ul>
        </div>
    @endif
@endsection
