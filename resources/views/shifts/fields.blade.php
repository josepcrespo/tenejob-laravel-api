<!--- Days Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('day_ids', 'Day:') !!}
    {!! Form::select('day_ids[]', $relations['days'],
            isset($shift) ? $shift->days->pluck('id') : NULL,
            [
                'id'    => 'day_ids',
                'class' => 'form-control'
            ]
        )
    !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('shifts.index') !!}" class="btn btn-default">Cancel</a>
</div>
