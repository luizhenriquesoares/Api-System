<div class="col-md-6">
    <div class="panel panel-white">
        <div class="panel-heading clearfix">
            <h4 class="panel-title">Informações Principais</h4>
        </div>
        <div class="panel-body">

            <div class="form-group">
                {!! Form::label('name', 'Nome') !!}
                {!! Form::text('name', null, ['placeholder' => 'Digite um nome', 'class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('email','Endereço de email') !!}
                {!! Form::email('email', null, ['placeholder' => 'Digite um email', 'class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('api_token','Token') !!}
                {!! Form::text('api_token', null, ['placeholder' => 'Gerar Token', 'class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('password', 'Senha') !!}
                {!! Form::password('password', ['placeholder' => 'Digite uma senha', 'class' => 'form-control']) !!}
            </div>
            <div class="checkbox">
                <label>
                    Ativar
                    {!! Form::hidden('status',0) !!}
                    {!! Form::checkbox('status') !!}
                </label>
            </div>

        </div>
        <div class="panel-footer">
            {!! Form::submit($submitButton, ['class' => 'btn btn-success']) !!}
            <a href="{{ route('user.index') }}" class="btn btn-primary">Cancelar</a>
        </div>
    </div>
</div>

