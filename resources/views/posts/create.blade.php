@extends('layouts.app')

@section('content')
    <div class="container">

        {!! Form::open(['action' => 'PostsController@store']) !!}

        @include('forms.posts')

        {!! Form::close() !!}

    </div>
@endsection