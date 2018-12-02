@extends('layouts.app')

@section('content')

    <div class="container mt-3">
        <div class="container">

            <h3 class="card-title">{{ $post->title }}</h3>
            <hp class="card-text text-justify">{{ $post->content }}</hp>
            <div class="">

                <div class="pb-2 mt-2">
                    <span class="float-right pt-3" style="visibility: {{ $_COOKIE['user_id'] != $post->user_id ? 'hidden' : 'visible' }}">
                        <a href="{{ route('posts.edit', $post->id) }}" style="color: #861388" class="mr-4"><i class="material-icons">edit</i></a>
                        <a href="{{ route('posts.delete', $post->id) }}" style="color: #861388" class="mr-2"><i class="material-icons">delete</i></a>
                    </span>
                </div>
            </div>
            @if ($_COOKIE['user_privilege'] == 1)
                <div class="row justify-content-center my-5 pt-4">
                    <a href="{{ route('replies.create', $post->id) }}" role="button" class="btn btn-primary btn-lg btn-block">Responder</a>
                </div>
            @endif
        </div>


        @foreach($replies as $reply)
            <hr>
            <div class="">

                <div class="pb-2 mt-2">{{ $reply->user_name }}: {{ $reply->content }}
                    <span class="float-right pt-3" style="visibility: {{ $_COOKIE['user_id'] != $reply->user_id ? 'hidden' : 'visible' }}">
                        <a href="{{ route('replies.edit', $reply->id) }}" style="color: #861388" class="mr-4"><i class="material-icons">edit</i></a>
                        <a href="{{ route('replies.delete', $reply->id) }}" style="color: #861388" class="mr-2"><i class="material-icons">delete</i></a>
                    </span>
                </div>
            </div>
        @endforeach

    </div>

@endsection