@extends('layouts.app')

@section('content')
    <div class="container">
        {{--        @if (Auth::user()->privilege == 1)--}}
        @if ($_COOKIE['user_privilege'] == 1)
            <div class="container mt-2">
                <a href="{{ route('posts.create') }}" role="button" class="btn btn-primary btn-lg btn-block">Criar postagem</a>
            </div>
        @endif

        <div class="mt-3">
            @foreach($posts as $post)
                <?php
                if (in_array($post->id, $favorites)) {
                    $class = 'btn-secondary';
                    $color = '#861388';
                }
                else {
                    $class = 'btn-primary';
                    $color = '#fff';
                }

                ?>

                <br>
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('posts.detail', $post->id) }}"><h5 class="ml-0 p-0 card-title btn btn-link">{{ $post->title }}</h5></a>
                        <p class="text-muted"><small>{{ date('d/m/Y H:i:s', strtotime($post->created_at)) }}</small></p>
                        <p class="card-text">{{ $post->content }}</p>

                        <div class="container">
                            <div class="row">
                                <span>
                                    {!! Form::open(['route' => 'favorites.verify', 'id' => 'favorite_form_' . $post->id]) !!}
                                    {!! Form::hidden('post_id', $post->id) !!}
                                    <a id="favorite" class="btn btn-icon btn-2 {{ $class }} mr-4" role="button" onclick="sendForm({{ $post->id }})" style="color: {{ $color }};">
                                        <span class="btn-inner--icon"><i class="material-icons">star</i></span>
                                    </a>
                                    {!! Form::close() !!}
                                    </span>
                                <span class="ml-1" style="visibility: {{ $_COOKIE['user_id'] != $post->user_id ? 'hidden' : 'visible' }}">
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
    <script type="text/javascript">
        function sendForm(post_id) {
            document.getElementById("favorite_form_" + post_id).submit();
        }
    </script>

@endsection