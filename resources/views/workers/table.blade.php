<table class="table table-responsive" id="workers-table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Availability</th>
            <th>Payrate</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($workers as $worker)
        <tr>
            <td>{!! $worker->id !!}</td>
            <td>
                @if(count($worker->days))
                    @foreach ($worker->days as $day)
                        <span class="badge badge-secondary">{!! $day->name !!}</span>
                    @endforeach
                @endif
            </td>
            <td>{!! $worker->payrate !!}</td>
            <td>
                {!! Form::open(['route' => ['workers.destroy', $worker->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('workers.show', [$worker->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i>&nbsp;View</a>
                    <a href="{!! route('workers.edit', [$worker->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i>&nbsp;Edit</a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>&nbsp;Delete', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>