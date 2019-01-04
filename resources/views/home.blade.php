@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
    	<div class="col-md-12">
	        <div style="align-items: center; display: flex; justify-content: center; height: 50vh;">
	        	<p>Create, view and, edit&nbsp;<a href="{{ url('/') }}/days">Days</a>,&nbsp;<a href="{{ url('/') }}/shifts">Shifts</a>,&nbsp;<a href="{{ url('/') }}/workers">Workers</a>&nbsp;and,&nbsp;<a href="{{ url('/') }}/matchings">Matchings</a>
	        	</p>
	        </div>
	    </div>
    </div>
</div>
@endsection
