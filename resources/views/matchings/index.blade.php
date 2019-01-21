@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Matchings</h1>
        <h1 class="pull-right">
            <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('matchings.create') !!}">Add New</a>
            {!! Form::open(['route' => ['matchings.truncate'], 'method' => 'post']) !!}
                {!! Form::button(
                    '<i class="glyphicon glyphicon-trash"></i>', [
                        'type'    => 'submit',
                        'class'   => 'btn btn-danger',
                        'onclick' => "return confirm('Are you sure?')"
                    ]
                ) !!}
            {!! Form::close() !!}
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('matchings.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

