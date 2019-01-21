@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Days</h1>
        {!! Form::open(['route' => ['days.delete.all'], 'method' => 'delete']) !!}
        {!! Form::button(
            'Reset table', [
                'type'    => 'submit',
                'class'   => 'btn btn-danger pull-right',
                'onclick' => "return confirm('Are you sure?')",
                'style'   => 'position: relative; top: -10px; margin-left: 10px;'
            ]
        ) !!}
        {!! Form::close() !!}
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right"
              style="margin-top: -10px;margin-bottom: 5px"
              href="{!! route('days.create') !!}">
               Add New
           </a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('days.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

