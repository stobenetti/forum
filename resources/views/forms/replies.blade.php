<div class="form-group">
    {!! Form::label('content', 'Conteúdo') !!}
    {{ Form::textarea('content', null, ['class' => 'form-control form-control-alternative']) }}
</div>

<div class="text-center">
    {{ Form::submit('Enviar', ['class' => 'mt-3 btn btn-primary']) }}
</div>