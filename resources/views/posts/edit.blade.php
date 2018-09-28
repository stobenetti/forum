@extends('layouts.app')

@section('content')
    <div class="container">

        {!! Form::model($post, ['method' => 'PATCH', 'route' => ['posts.update', $post->id]]) !!}

        @include('forms.posts')

        {!! Form::close() !!}

    </div>

@endsection