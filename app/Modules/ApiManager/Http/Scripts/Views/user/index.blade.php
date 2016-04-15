@extends($helper->layout)
@section('content')

    <div class="col-md-12">

        <div class="panel panel-white">
            <div class="panel-heading">
                <h4 class="panel-title">Usuários</h4>
            </div>
            <div class="panel-body">
                <a href="{{--{{ route('manager.user.create') }}--}}" class="btn btn-success m-b-sm">Novo Usuário</a>
                <div id="rootwizard">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#user-tab1" data-toggle="tab"><i class="fa fa-user m-r-xs"></i>Todos</a></li>
                        <li role="presentation" id="user-tab-trash"><a href="#user-tab2" data-toggle="tab"><i class="fa fa-truck m-r-xs"></i>Lixeira</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active fade in" id="user-tab1">
                            <div class="table-responsive">
                                @include($helper->base.'user.partials.table')
                            </div>
                        </div>
                        <div class="tab-pane fade in" id="user-tab2">
                            <!-- Datatables with Ajax -->
                            <div class="table-responsive">
                                @include($helper->base.'user.partials.table-trash')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop