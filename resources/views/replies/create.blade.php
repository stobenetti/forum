@extends('layouts.app')

@section('content')

    <div class="container">

        {!! Form::open(['action' => 'RepliesController@store']) !!}

        {!! Form::hidden('post_id', $post_id) !!}

        @include('forms.replies')

        {!! Form::close() !!}

    </div>

@endsection