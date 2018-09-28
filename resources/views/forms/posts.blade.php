<div class="form-group">
    {!! Form::label('title', 'Título') !!}
    {{ Form::text('title', null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
    {!! Form::label('content', 'Conteúdo') !!}
    {{ Form::text('content', null, ['class' => 'form-control']) }}
</div>

<div class="text-center">
    {{ Form::submit('Enviar', ['class' => 'btn-primary']) }}
</div>