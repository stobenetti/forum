@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container">
            <a href="{{ url()->current() . '/create' }}" role="button" type="button" class="btn btn-primary btn-lg btn-block">Criar postagem</a>
        </div>

        <div class="mt-3">
            @foreach($posts as $post)
                <h2>{{ $post->title }}</h2>
                <p>{{ $post->content }}</p>
            @endforeach
        </div>
    </div>
@endsection