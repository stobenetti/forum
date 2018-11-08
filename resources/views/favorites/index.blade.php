@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="mt-3">
            @if (sizeof($favorites) < 1)
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Você ainda não adicionou favoritos.</h5>
                        <p class="card-text">Suas postagens favoritas aparecerão aqui.</p>
                        <a href="{{ route('posts.index') }}" class="mt-3 btn btn-primary">Adicionar favoritos</a>
                    </div>
                </div>
            @endif
            @foreach($favorites as $post)
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('posts.show', $post->id) }}"><h5 class="ml-0 p-0 card-title btn btn-link">{{ $post->title }}</h5></a>
                        <p class="card-text">{{ $post->content }}</p>

                        <div class="container">
                            <div class="row">
                                <span>
                                    <button class="btn btn-icon btn-2 btn-primary mr-4" role="button" href="{{ route('favorites.verify', $post->id) }}">
                                        <span class="btn-inner--icon"><i class="material-icons">star</i></span>
                                    </button>
                                </span>
                                <span class="ml-1" style="visibility: {{ Auth::id() != $post->user_id ? 'hidden' : 'visible' }}">
                                    <a class="btn btn-icon btn-2 btn-primary mr-4" role="button" href="{{ route('posts.edit', $post->id) }}">
                                        <span class="btn-inner--icon"><i class="material-icons">edit</i></span>
                                    </a>
                                    <a class="btn btn-icon btn-2 btn-primary mr-4" role="button" href="{{ route('posts.delete', $post->id) }}">
                                        <span class="btn-inner--icon"><i class="material-icons">delete</i></span>
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection