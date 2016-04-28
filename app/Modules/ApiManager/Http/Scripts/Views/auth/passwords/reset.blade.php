@extends('Home::layouts.login')

@section('content')
    <div id="box-login">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        {!! Form::open(['url' => '/password/reset']) !!}
            {!! csrf_field() !!}
        <figure>
            <img src="{{ url('/assets/home/img/logotipo-busca-aereo.png') }}" alt="Logotipo Busca Aéreo"
                 title="Busca Aéreo"/>
        </figure>

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            {!! Form::hidden('token', $token) !!}
            {!! Form::hidden('email', $email) !!}

            {!! Form::password('password', null, ['class' => 'input-login fl']) !!}
            {!! Form::password('password_confirmation', null, ['class' => 'input-login fl']) !!}

            @if (count($errors) > 0)
                <ul class="help-block">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

        </div>

        {!! Form::submit('Redefinir', ['class' => 'btn-login fr']) !!}

        {!! Form::close() !!}
    </div>
@endsection
