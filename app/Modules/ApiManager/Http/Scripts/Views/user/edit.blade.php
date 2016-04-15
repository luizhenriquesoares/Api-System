@extends($helper->layout)
@section('content')

    {!! Form::model($data, ['method' => 'put', 'route' => ['manager.user.update', $data->id]]) !!}
    @include($helper->base . 'user.forms.form', ['submitButton' => 'Atualizar'])
    {!! Form::close() !!}

@stop