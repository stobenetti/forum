@extends('layouts.app')

@section('content')
    <div class="container">

        {!! Form::open(['action' => 'PostsController@store']) !!}

        <div class="form-group">
            {!! Form::label('title', 'Título') !!}
            {{ Form::text('title', '', ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {!! Form::label('content', 'Conteúdo') !!}
            {{ Form::text('content', '', ['class' => 'form-control']) }}
        </div>

        <div class="text-center">
            {{ Form::submit('Enviar', ['class' => 'btn-primary']) }}
        </div>

        {!! Form::close() !!}

    </div>

@endsection