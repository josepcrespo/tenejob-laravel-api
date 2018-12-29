<table class="table table-responsive" id="shifts-table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Day</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($shifts as $shift)
        <tr>
            <td>{!! $shift->id !!}</td>
            <td>
                @if(count($shift->days))
                    @foreach ($shift->days as $day)
                        <span class="badge badge-secondary">{!! $day->name !!}</span>
                    @endforeach
                @endif
            </td>
            <td>
                {!! Form::open(['route' => ['shifts.destroy', $shift->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('shifts.show', [$shift->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('shifts.edit', [$shift->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>