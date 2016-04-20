@extends($helper->layout)
@section('content')

    <div class="col-md-6">
        <div class="panel panel-white">
            <div class="panel-heading clearfix">
                <h4 class="panel-title">Detalhes do Usuário</h4>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <h4>ID</h4>
                    <div>{{ $data->id }}</div>
                </div>
                <div class="form-group">
                    <h4>Nome</h4>
                    <div>{{ $data->fullname }}</div>
                </div>
                <div class="form-group">
                    <h4>Email</h4>
                    <div>{{ $data->email }}</div>
                </div>
                <div class="form-group">
                    <h4>Permissão</h4>
                    <div><strong>{{ $data->roles->display_name }}</strong> : {{ $data->roles->description }}</div>
                </div>
                <div class="form-group">
                    <h4>Criado</h4>
                    <td>{{ $data->created_at }}</td>
                </div>
                <div class="form-group">
                    <h4>Modificado</h4>
                    <td>{{ $data->updated_at }}</td>
                </div>
                <div class="form-group">
                    <h4>Status</h4>
                    <div>{{ $data->status ? "Ativo" : "Inativo"}}</div>
                </div>

                @if($data->informations)
                    <div class="form-group">
                        <h4>Avatar</h4>
                        <div>
                            <img class="img-circle avatar" src="{{ $data->informations->avatar }}" width="40"
                                 height="40" alt=""/>
                        </div>
                    </div>
                    <div class="form-group">
                        <h4>CPF/CNPJ</h4>
                        <div>{{ $data->informations->cpf_cnpj }}</div>
                    </div>
                    <div class="form-group">
                        <h4>RG</h4>
                        <div>{{ $data->informations->rg }}</div>
                    </div>
                    <div class="form-group">
                        <h4>Código</h4>
                        <div>{{ $data->informations->code }}</div>
                    </div>
                    <div class="form-group">
                        <h4>Telefone</h4>
                        <div>{{ $data->informations->phone }}</div>
                    </div>
                    <div class="form-group">
                        <h4>Nascimento</h4>
                        <div>{{ $data->informations->birthday }}</div>
                    </div>
                    <div class="form-group">
                        <h4>Adicional</h4>
                        <div>{{ $data->informations->addtional }}</div>
                    </div>
                @endif

            </div>
        </div>
    </div>

@stop
