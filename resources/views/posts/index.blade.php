@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container mt-2">
            <a href="{{ route('posts.create') }}" role="button" class="btn btn-primary btn-lg btn-block">Criar postagem</a>
        </div>

        <div class="mt-3">
            @foreach($posts as $post)
                <br>
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('posts.show', $post->id) }}"><h5 class="ml-0 p-0 card-title btn btn-link">{{ $post->title }}</h5></a>
                        <p class="card-text">{{ $post->content }}</p>

                        <div class="container">
                            <div class="row">
                                {{--<span>--}}
                                    {{--<a class="btn btn-icon btn-2 btn-primary mr-4" role="button" href="{{ route('favorites.verify', $post->id) }}">--}}
                                        {{--<span class="btn-inner--icon"><i class="material-icons">star</i></span>--}}
                                    {{--</a>--}}
                                {{--</span>--}}
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