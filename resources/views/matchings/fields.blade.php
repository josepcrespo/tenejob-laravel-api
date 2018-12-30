<!--- Shift Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('shift_id', 'Shift:') !!}
    {!! Form::select('shift_id', $relations['shifts'],
            isset($matching) ? $matching->shift_id : NULL,
            [
                'id'    => 'shift_id',
                'class' => 'form-control'
            ]
        )
    !!}
</div>

<!--- Worker Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('worker_id', 'Worker:') !!}
    {!! Form::select('worker_id', $relations['workers'],
            isset($matching) ? $matching->worker_id : NULL,
            [
                'id'    => 'worker_id',
                'class' => 'form-control'
            ]
        )
    !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('matchings.index') !!}" class="btn btn-default">Cancel</a>
</div>
