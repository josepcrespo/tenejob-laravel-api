@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
    	<div class="col-md-12">
			<p style="text-align: center; margin: 50px auto;">
				Create, view and, edit&nbsp;<a href="{{ url('/') }}/days">Days</a>,&nbsp
				<a href="{{ url('/') }}/shifts">Shifts</a>,&nbsp;
				<a href="{{ url('/') }}/workers">Workers</a>&nbsp;and,&nbsp;
				<a href="{{ url('/') }}/matchings">Matchings</a>
			</p>
			<p style="text-align: center;">
				You can also start with a fresh DB. To do this, click the reset button:
			</p>
			{!! Form::open([
					'route'  => ['home.delete.all'],
					'method' => 'delete',
					'style'  => 'text-align: center;'
				])
			!!}
			{!! Form::button(
				'Reset entities tables', [
					'type'    => 'submit',
					'class'   => 'btn btn-danger',
					'onclick' => "return confirm('You are going to reset the `Days`, `Shifts`, `Workers` and, `Matchings` tables. Are you sure?')"
				]
			) !!}
			{!! Form::close() !!}
	    </div>
    </div>
</div>
@endsection
