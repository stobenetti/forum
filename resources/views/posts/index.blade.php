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
                    <span>
                        <small><a href="{{ route('favorites.verify', $post->id) }}">Favorito</a></small>
                    </span>
                    <span class="ml-1" style="visibility: {{ Auth::id() != $post->user_id ? 'hidden' : 'visible' }}">
                        |
                        <small><a href="{{ route('posts.edit', $post->id) }}">Editar</a></small>
                        |
                        <small><a href="{{ route('posts.delete', $post->id) }}">Excluir</a></small>
                    </span>
                </div>
                <hr>
            @endforeach
        </div>
    </div>
@endsection