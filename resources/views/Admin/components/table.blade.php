<div class="table-responsive">
    <table class="table table-hover">
        <tr>
            <th>{{('S.N.')}}</th>
            @foreach ($indexTable as $title => $value)
            <th>{{ $title }}</th>
            @endforeach
            @if(\Auth::user()->canDo($permission."edit") || \Auth::user()->canDo($permission."destroy"))
                <th>{{('Action')}}</th>
            @endif
        </tr>
        </thead>
        <tbody>
        @if($data->isEmpty())
            <tr>
                <td class="no-data" colspan="6">
                    <b>{{('No data to display!')}}</b>
                </td>
            </tr>
        @else
            @php
            $startFrom = $data->perPage() * ($data->currentPage()-1);
            $show = isset($action) && in_array('show', $action);
            $edit = isset($action) && in_array('edit', $action) && \Auth::user()->canDo($permission."edit");
            $delete = isset($action) && in_array('delete', $action) && \Auth::user()->canDo($permission."destroy");
            @endphp

            @foreach($data as $datum)
                @php $startFrom++;@endphp
                <tr>
                    <td>{{ $startFrom }}</td>
                    @foreach ($indexTable as $title => $value)
                        <th>{{ is_callable($value) ? $value($datum) : $datum->$value }}</th>
                    @endforeach
                    @if($edit || $show || $delete)
                        <td>
                            @if($show)
                            <a class="btn btn-sm btn-info btn_glyph" href="{{route( $route.'show' ,[$datum->id])}}"><i class="glyphicon glyphicon-eye"></i> {{('View')}}</a>
                            @endif

                            @if($edit)
                                <a class="btn btn-sm btn-info btn_glyph" href="{{route( $route.'edit' ,[$datum->id])}}"><i class="glyphicon glyphicon-edit"></i> {{('Edit')}}</a>
                            @endif

                            @if($delete)
                                <form action="{{ route($route.'destroy' ,[$datum->id]) }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button class="btn btn-sm btn-danger btn_glyph" href="{{route($route.'destroy' ,[$datum->id])}}"><i class="glyphicon glyphicon-trash"></i> {{('Delete')}}</button>
                                </form>
                            @endif

                        </td>
                    @endif
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</div>


@if(!$data->isEmpty())
    <div class="pagination-tile">
        <label class="pagination-sub" style="display: block">
            {{('Showing') }} {{($data->currentpage()-1)*$data->perpage()+1}} {{('to')}} {{(($data->currentpage()-1)*$data->perpage())+$data->count()}} {{('of')}} {{$data->total()}} {{('entries')}}
        </label>
        <ul class="pagination">
            {!! str_replace('/?', '?',$data->appends(['keywords' => $input['keywords'] ?? null ])->render()) !!}
        </ul>
    </div>
@endif
