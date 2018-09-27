@extends('layouts.app')

@section('content')
    <div class="container">

        {!! Form::model($post, ['method' => 'PATCH', 'route' => ['posts.update', $post->id]]) !!}

        <div class="form-group">
            {!! Form::label('title', 'Título') !!}
            {{ Form::text('title', null, ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {!! Form::label('content', 'Conteúdo') !!}
            {{ Form::text('content', null, ['class' => 'form-control']) }}
        </div>

        <div class="text-center">
            {{ Form::submit('Enviar', ['class' => 'btn-primary']) }}
        </div>

        {!! Form::close() !!}

    </div>

@endsection