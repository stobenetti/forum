@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="mt-3">
            @if (sizeof($posts) < 1)
                <h4>Você ainda não adicionou favoritos.</h4>
            @endif
            @foreach($posts as $post)
                <br>
                <h2><a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a></h2>
                <p>{{ $post->content }}</p>
                <p>
{{--                    <small><a href="{{ route('favorites.verify', $post->id) }}">Remover dos favoritos</a></small>--}}
                    {!! Form::open(['route' => 'favorites.verify']) !!}
                    {!! Form::hidden('post_id', $post->id) !!}
                    {!! Form::submit('Remover dos favoritos') !!}
                    {!! Form::close() !!}
                </p>
                <hr>
            @endforeach
        </div>
    </div>
@endsection