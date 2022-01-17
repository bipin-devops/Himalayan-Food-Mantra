@extends('layout')
@section('title') List of Contact @endsection
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

                </ul>
            </div>
        </div>

        <br>

        <div class="table-responsive">
            <table class="table table-hover">
                <tr>
                    <th>{{('S.N.')}}</th>
                    <th>{{('Full Name ')}}</th>
                    <th>{{('Email ')}}</th>
                    <th>{{('phone')}} </th>
                    <th>{{('Address')}} </th>
                    <th>{{('Message')}} </th>


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




                            <td>{{$datum->name}}</td>
                            <td >{{$datum->email}}</td>
                            <td >{{$datum->phone_number}}</td>
                            <td >{{$datum->address}}</td>
                            <td>{{$datum->message}}</td>



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
