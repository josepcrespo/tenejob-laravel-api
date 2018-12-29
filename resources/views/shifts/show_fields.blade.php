<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $shift->id !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $shift->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $shift->updated_at !!}</p>
</div>

<!-- Day Field -->
<div class="form-group">
    {!! Form::label('day', 'Day:') !!}
    <p>
        @if(count($shift->days))
            @foreach ($shift->days as $day)
                <span class="badge badge-secondary">{!! $day->name !!}</span>
            @endforeach
        @endif
    </p>
</div>

