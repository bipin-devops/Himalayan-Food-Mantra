@extends('layout')
@section('title') List of {{$pageTitle}} @endsection
@section('content')

    <div class="panel panel-flat border-top-info">
        <div class="breadcrumb-line"><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
            <ul class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="icon-home2 position-left"></i> Home</a></li>
                <li class="active">{{$pageTitle ?? ''}}<span class="badge badge-info"></span></li>
            </ul>
        </div>
        <div class="panel-heading">


            <div class="row">
                <ul class="icons-list pull-right">
                    <li>
                        <a class="btn btn-success" href="{{URL::to('system/page/create')}}"><i
                                    class="glyphicon glyphicon-plus" style="margin-right:10px;"></i>{{('Add New')}}</a>

                    </li>
                </ul>
            </div>

        </div>

        <br>
        <div class="panel-body">
            @include('flash::message')

        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <tr>
                    <th>{{('S.N.')}}</th>
                    <th>{{('Title') }}</th>
                    {{--<th>{{('Intro Text')}} </th>--}}


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
                            <td>{{$datum->title}}</td>
                            {{--<td>{!!  $datum->into_text!!}</td>--}}
                            <td>

                                <a class="btn btn-sm btn-info btn_glyph"
                                   href="{{URL::to('system/page/edit/'.$datum->id)}}"><i
                                            class="glyphicon glyphicon-edit"></i> {{('Edit')}}</a>
                                <a class="btn btn-sm btn-danger btn_glyph" onclick="return confirm(' you want to delete?');"
                                   href="{{URL::to('system/page/delete/'.$datum->id)}}"><i
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
