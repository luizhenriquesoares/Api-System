@extends('Home::layouts.login')
@section('content')
    <div id="box-login">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        {!! Form::open(['url' => '/password/email']) !!}
            {!! csrf_field() !!}
        <figure>
            <img src="{{ url('/assets/home/img/logotipo-busca-aereo.png') }}" alt="Logotipo Busca Aéreo" title="Busca Aéreo" />
        </figure>

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

            {!! Form::email('email', null, ['class' => 'input-login fl', 'placeholder' => 'seu-email@buscaaereo.com.br']) !!}

            @if ($errors->has('email'))
                <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
            @endif

        </div>

        {!! Form::submit('Redefinir', ['class' => 'btn-login fr']) !!}

        {!! Form::close() !!}
    </div>
@endsection