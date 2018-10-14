@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <h5 class="card-header text-center">Criar postagem</h5>
            <div class="card-body">
                {!! Form::open(['action' => 'PostsController@store']) !!}

                @include('forms.posts')

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection