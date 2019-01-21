<table class="table table-responsive" id="matchings-table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Shift Id</th>
            <th>Shift Day</th>
            <th>Worker Id</th>
            <th>Worker Payrate</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($matchings as $matching)
        <tr>
            <td>{{ $matching->id }}</td>
            <td>{{ $matching->shift ? $matching->shift->id : '(Shift deleted)'}}</td>
            <td>
                @if($matching->shift && count($matching->shift->days))
                    @foreach ($matching->shift->days as $day)
                        <span class="badge badge-secondary">{!! $day->name !!}</span>
                    @endforeach
                @endif
            </td>
            <td>{{ $matching->worker ? $matching->worker->id : '(Worker deleted)'}}</td>
            <td>{{ $matching->worker ? $matching->worker->payrate : '' }}</td>
            <td>
                {!! Form::open(['route' => ['matchings.destroy', $matching->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('matchings.show', [$matching->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('matchings.edit', [$matching->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>