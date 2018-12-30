@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Matching
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($matching, ['route' => ['matchings.update', $matching->id], 'method' => 'patch']) !!}

                        @include('matchings.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection