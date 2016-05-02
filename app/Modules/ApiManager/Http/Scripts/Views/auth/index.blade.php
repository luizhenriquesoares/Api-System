@extends('ApiManager::layouts.login')
@section('content')
    <div class="login-auth">
        <header>
            LOGIN</header>
        {!! Form::open(['url' => '/login']) !!}
        <div class="form-group">{!! Form::text('email', null, ['class' => 'form-input form-input-default', 'placeholder' => 'usuario@buscaareo.com.br', 'required']) !!}</div>
        <div class="form-group">{!! Form::password('password', ['class' => 'form-input form-input-default', 'placeholder' => '*******', 'required']) !!}</div>
        <div class="action-login">
            {!! Form::button('Logar', ['class' => 'b-btn b-btn-default fr', 'type' => 'submit']) !!}
        </div>
        {!! Form::close() !!}
        <a href="{{ url('/password/reset') }}"> Esqueci a senha</a>
        @if(isset($errors) && count($errors) > 0)
            <ul class="help-block">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </div>
    <div class="copyright-login">
        <small><i class="fa fa-copyright"></i>API | Elomilhas {{ env("APP_VERSION", "v0.1.0") }} - 2016</small>
    </div>
@stop