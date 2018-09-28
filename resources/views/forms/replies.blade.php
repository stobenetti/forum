<div class="form-group">
    {!! Form::label('content', 'Conteúdo') !!}
    {{ Form::textarea('content', null, ['class' => 'form-control']) }}
</div>

<div class="text-center">
    {{ Form::submit('Enviar', ['class' => 'btn-primary']) }}
</div>