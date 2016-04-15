@extends($helper->layout)
@section('content')

    {!! Form::open(['route' => 'manager.user.store']) !!}
    @include($helper->base . 'user.forms.form', ['submitButton' => 'Salvar'])
    {!! Form::close() !!}

@stop

