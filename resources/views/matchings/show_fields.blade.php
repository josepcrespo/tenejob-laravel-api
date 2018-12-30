<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $matching->id !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $matching->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $matching->updated_at !!}</p>
</div>

<!-- Shift Field -->
<div class="form-group">
    {!! Form::label('shift', 'Shift:') !!}
    <span class="btn-group">
        <a href="{{ url('/') }}/shifts/{!! $matching->shift->id !!}"
           class="btn btn-default btn-xs">
            <i class="glyphicon glyphicon-eye-open"></i>&nbsp;View
        </a>
        <a href="{{ url('/') }}/shifts/{!! $matching->shift->id !!}/edit"
           class="btn btn-default btn-xs">
            <i class="glyphicon glyphicon-eye-open"></i>&nbsp;Edit
        </a>
    </span>
    <p>
        Id: {!! $matching->shift->id !!},
        day:&nbsp;
        @if($matching->shift && count($matching->shift->days))
            @foreach ($matching->shift->days as $day)
                <span class="badge badge-secondary">{!! $day->name !!}</span>
            @endforeach
        @endif
    </p>
</div>

<!-- Worker Field -->
<div class="form-group">
    {!! Form::label('worker', 'Worker:') !!}
    <span class="btn-group">
        <a href="{{ url('/') }}/workers/{!! $matching->worker->id !!}"
           class="btn btn-default btn-xs">
            <i class="glyphicon glyphicon-eye-open"></i>&nbsp;View
        </a>
        <a href="{{ url('/') }}/workers/{!! $matching->worker->id !!}/edit"
           class="btn btn-default btn-xs">
            <i class="glyphicon glyphicon-eye-open"></i>&nbsp;Edit
        </a>
    </span>
    <p>
        Id: {!! $matching->worker->id !!},
        payrate: {!! $matching->worker->payrate !!}
    </p>
</div>

