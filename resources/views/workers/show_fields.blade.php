<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $worker->id !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $worker->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $worker->updated_at !!}</p>
</div>

<!-- Availability Field -->
<div class="form-group">
    {!! Form::label('availability', 'Availability:') !!}
    <p>
        @if(count($worker->days))
            @foreach ($worker->days as $day)
                <span class="badge badge-secondary">{!! $day->name !!}</span>
            @endforeach
        @endif
    </p>
</div>

<!-- Payrate Field -->
<div class="form-group">
    {!! Form::label('payrate', 'Payrate:') !!}
    <p>{!! $worker->payrate !!}</p>
</div>

