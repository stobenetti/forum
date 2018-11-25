@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5 class="text-center">Editar resposta</h5>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        @foreach ($errors->all() as $error)
                            {{ $error }} <br>
                        @endforeach
                    </div>
                @endif

                {!! Form::model($reply, ['method' => 'PATCH', 'route' => ['replies.update', $reply->id]]) !!}

                {!! Form::hidden('post_id', $reply->post_id) !!}

                @include('forms.replies')

                {!! Form::close() !!}

            </div>
        </div>
    </div>

@endsection