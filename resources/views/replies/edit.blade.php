@extends('layouts.app')

@section('content')

    <div class="container">

        {!! Form::model($reply, ['method' => 'PATCH', 'route' => ['replies.update', $reply->id]]) !!}

        {!! Form::hidden('post_id', $reply->post_id) !!}

        @include('forms.replies')

        {!! Form::close() !!}

    </div>

@endsection