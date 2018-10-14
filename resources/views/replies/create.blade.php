@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5 class="text-center">Responder</h5>
                <h6 class="card-subtitle text-muted text-center"><a href="{{ route('posts.show', $post_id) }}" class="btn btn-link">{{ $post->title }}</a></h6>
            </div>
            <div class="card-body">

                {!! Form::open(['action' => 'RepliesController@store']) !!}

                {!! Form::hidden('post_id', $post_id) !!}

                @include('forms.replies')

                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection