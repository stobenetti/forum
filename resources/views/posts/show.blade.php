@extends('layouts.app')

@section('content')

    <div class="container">

        <h2>{{ $post->title }}</h2>

        <div class="mt-4">
            <h5>{{ $post->content }}</h5>
        </div>

        <hr>

        <a href="{{ route('replies.create', $post->id) }}" role="button" type="button" class="btn btn-light">Responder</a>

        <div class="mt-3">
            @foreach($replies as $reply)

                <p>{{ App\User::find($reply->user_id)->name }}: {{ $reply->content }}</p>
                <div class="row ml-2" style="visibility: {{ Auth::id() != $reply->user_id ? 'hidden' : 'visible' }}">
                    <p style="opacity: 0.5"><a href="{{ route('replies.edit', $reply->id) }}">Editar</a> | <a href="{{ route('replies.delete', $reply->id) }}">Excluir</a></p>
                </div>

            @endforeach
        </div>

    </div>

@endsection