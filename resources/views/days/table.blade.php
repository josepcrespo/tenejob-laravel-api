<table class="table table-responsive" id="days-table">
    <thead>
        <tr>
            <th>Name</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($days as $day)
        <tr>
            <td>{!! $day->name !!}</td>
            <td>
                {!! Form::open(['route' => ['days.destroy', $day->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('days.show', [$day->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i>&nbsp;View</a>
                    <a href="{!! route('days.edit', [$day->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i>&nbsp;Edit</a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>&nbsp;Delete', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>