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
                <p>
                    <small><a style="{{ $post->user_id != Auth::id() ? 'hidden' : '' }}" href="{{ route('posts.edit', $post->id) }}">Editar</a></small> |
                    <small><a style="{{ $post->user_id != Auth::id() ? 'hidden' : '' }}" href="{{ route('posts.delete', $post->id) }}">Excluir</a></small> |
                    <small><a href="{{ route('favorites.verify', $post->id) }}">Favorito</a></small>
                </p>
                <hr>
            @endforeach
        </div>
    </div>
@endsection