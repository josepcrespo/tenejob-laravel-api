<!-- Availability Field -->
<div class="form-group col-sm-6">
    {!! Form::label('day_ids', 'Availability:') !!}
    {!! Form::select('day_ids[]', $relations['days'],
            isset($shift) ? $shift->days->pluck('id') : NULL,
            [
                'id'    => 'day_ids',
                'class' => 'form-control',
                'multiple' => 'multiple'
            ]
        )
    !!}
</div>

<!-- Payrate Field -->
<div class="form-group col-sm-6">
    {!! Form::label('payrate', 'Payrate:') !!}
    {!! Form::number('payrate', null, [
            'class' => 'form-control',
            'min'   => '0',
            'step'  => '0.01'
            ]
        )
    !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('workers.index') !!}" class="btn btn-default">Cancel</a>
</div>
