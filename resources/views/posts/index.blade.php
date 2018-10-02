@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container">
            <a href="{{ route('posts.create') }}" role="button" type="button" class="btn btn-primary btn-lg btn-block">Criar postagem</a>
        </div>

        <div class="mt-3">
            @foreach($posts as $post)
                <br>
                <h2><a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a></h2>
                <p>{{ $post->content }}</p>
                <div class="row ml-3">
                    {!! Form::open(['route' => 'favorites.verify']) !!}

{{--                    <small><a href="{{ route('favorites.verify') }}" class="mr-2">Favorito</a></small>--}}
                    {!! Form::hidden('post_id', $post->id) !!}
                    {!! Form::submit('Favorito') !!}
                    {!! Form::close() !!}
                    <div style="visibility: {{ Auth::id() != $post->user_id ? 'hidden' : 'visible' }}">
                        |
                        <small><a href="{{ route('posts.edit', $post->id) }}">Editar</a></small>
                        |
                        <small><a href="{{ route('posts.delete', $post->id) }}">Excluir</a></small>
                    </div>
                </div>
                <hr>
            @endforeach
        </div>
    </div>
@endsection