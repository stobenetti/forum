@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="mt-3">
            @if (sizeof($posts) < 1)
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Você ainda não adicionou favoritos.</h5>
                        <p class="card-text">Suas postagens favoritas aparecerão aqui.</p>
                        <a href="{{ route('posts.index') }}" class="mt-3 btn btn-primary">Adicionar favoritos</a>
                    </div>
                </div>
            @endif
            @foreach($posts as $post)
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('posts.show', $post->id) }}"><h5 class="ml-0 p-0 card-title btn btn-link">{{ $post->title }}</h5></a>
                        <p class="card-text">{{ $post->content }}</p>

                        <div class="container">
                            <div class="row">
                                <span>
                                    {!! Form::open(['route' => 'favorites.verify', 'id' => 'favorite_form_' . $post->id]) !!}
                                    {!! Form::hidden('post_id', $post->id) !!}
                                    <a id="favorite" class="btn btn-icon btn-2 btn-primary mr-4" role="button" onclick="sendForm({{ $post->id }})" style="color: #fff;">
                                        <span class="btn-inner--icon">Remover dos favoritos</span>
                                    </a>
                                    {!! Form::close() !!}
                                    </span>
                                {{--<span class="ml-1" style="visibility: {{ $_COOKIE['user_id'] != $post->user_id ? 'hidden' : 'visible' }}">--}}
                                    {{--<a class="btn btn-icon btn-2 btn-primary mr-4" role="button" href="{{ route('posts.edit', $post->id) }}">--}}
                                        {{--<span class="btn-inner--icon"><i class="material-icons">edit</i></span>--}}
                                    {{--</a>--}}
                                    {{--<a class="btn btn-icon btn-2 btn-primary mr-4" role="button" href="{{ route('posts.delete', $post->id) }}">--}}
                                        {{--<span class="btn-inner--icon"><i class="material-icons">delete</i></span>--}}
                                    {{--</a>--}}
                                {{--</span>--}}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script type="text/javascript">
        function sendForm(post_id) {
            document.getElementById("favorite_form_" + post_id).submit();
        }
    </script>
@endsection