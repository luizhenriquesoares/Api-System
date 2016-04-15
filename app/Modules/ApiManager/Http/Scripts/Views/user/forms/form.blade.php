<div class="col-md-6">
    <div class="panel panel-white">
        <div class="panel-heading clearfix">
            <h4 class="panel-title">Informações Principais</h4>
        </div>
        <div class="panel-body">

            <div class="form-group">
                {!! Form::label('fullname', 'Nome') !!}
                {!! Form::text('fullname', null, ['placeholder' => 'Digite um nome', 'class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('email','Endereço de email') !!}
                {!! Form::email('email', null, ['placeholder' => 'Digite um email', 'class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('password', 'Senha') !!}
                {!! Form::password('password', ['placeholder' => 'Digite uma senha', 'class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('roles_id', 'Permissão') !!}
                {!! Form::select('roles_id', $roles, null, ['class' => 'form-control']) !!}
            </div>
            <div class="checkbox">
                <label>
                    Ativar
                    {!! Form::hidden('status',0) !!}
                    {!! Form::checkbox('status') !!}
                </label>
            </div>

        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="panel panel-white">
        <div class="panel-heading clearfix">
            <h4 class="panel-title">Informações adicionais</h4>
        </div>
        <div class="panel-body">

            Deseja alterar alguma informação adicional?
            {!! Form::checkbox('adicionais', ACTIVE, null) !!}

            <br/><br/>
            <div class="additionals">
                <div class="form-group">
                    {!! Form::label('avatar', 'Avatar') !!}
                    {!! Form::file('avatar', ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('cpf_cnpj', 'CPF/CNPJ') !!}
                    {!! Form::text('cpf_cnpj', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-2">
                            {!! Form::label('phone', 'DDD') !!}
                            {!! Form::text('code', null, ['class' => 'form-control', 'maxlength' => 2]) !!}
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('phone', 'Telefone') !!}
                            {!! Form::text('phone', null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="col-md-4">
                            {!! Form::label('birthday', 'Data nascimento') !!}
                            {!! Form::date('birthday', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('addtional', 'Outras informações') !!}
                    {!! Form::textarea('addtional', null, ['class' => 'form-control', 'style' => 'height: 100px; resize: none']) !!}
                </div>
            </div> <!-- additionals -->


            {!! Form::submit($submitButton, ['class' => 'btn btn-success']) !!}
            <a href="{{ route('manager.user.index') }}" class="btn btn-primary">Cancelar</a>

        </div>
    </div>
</div>

