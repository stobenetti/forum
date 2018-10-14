<div class="form-group">
    {!! Form::label('title', 'Título') !!}
    {{ Form::textarea('title', null, ['class' => 'form-control form-control-alternative', 'rows' => 3]) }}
</div>
<div class="form-group">
    {!! Form::label('content', 'Conteúdo') !!}
    {{ Form::textarea('content', null, ['class' => 'form-control form-control-alternative', 'rows' => 4]) }}
</div>

<div class="text-center mt-4">
    {{ Form::submit('Enviar', ['class' => 'btn btn-primary']) }}
</div>