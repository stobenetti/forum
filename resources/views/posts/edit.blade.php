@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="card">
            <h5 class="card-header text-center">Criar postagem</h5>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        @foreach ($errors->all() as $error)
                            {{ $error }} <br>
                        @endforeach
                    </div>
                @endif

                {!! Form::model($post, ['method' => 'PATCH', 'route' => ['posts.update', $post->id]]) !!}

                @include('forms.posts')

                {!! Form::close() !!}

            </div>
        </div>
    </div>

@endsection