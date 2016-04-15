<div class="page-sidebar sidebar">
    <div class="page-sidebar-inner slimscroll">
        <div class="sidebar-header">
            <div class="sidebar-profile">
                <a href="javascript:void(0);" id="profile-menu-link" title="{{ $user->fullname }}">
                    <div class="sidebar-profile-image">
                        <img src="{{ url(IMG_PATH . 'profile-menu-image.png') }}" class="img-circle img-responsive"
                             alt="{{ $user->fullname }}">
                    </div>
                    <div class="sidebar-profile-details">
                        <span>
                            {{ $user->fullname }}
                        </span>
                    </div>
                </a>
            </div>
        </div>
        <ul class="menu accordion-menu">
            <li>
                <a href="{{ url('/manager') }}" class="waves-effect waves-button">
                    <span class="menu-icon glyphicon glyphicon-home"></span>
                    <p>Área de trabalho</p>
                </a>
            </li>
            <li class="droplink">
                <a href="#" class="waves-effect waves-button">
                    <span class="menu-icon glyphicon glyphicon-tasks"></span>
                    <p>Manager</p><span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="{{ route('manager.user.index') }}">
                            Usuários
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('manager.agency.index') }}">
                            Agências
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('manager.provider.index') }}">
                            Fornecedores
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('manager.role.index') }}">
                            Papéis & Grupos
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('manager.config.index') }}">
                            Configurações
                        </a>
                    </li>
                </ul>
            </li>

            <li class="droplink">
                <a href="#" class="waves-effect waves-button">
                    <span class="menu-icon glyphicon glyphicon-plane"></span>
                    <p>Busca</p><span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li><a href="{{ route('manager.markup.index') }}">Markups</a></li>
                    <li><a href="{{ route('manager.api.index') }}">Apis</a></li>
                    <li><a href="{{ route('manager.airport.index') }}">Aeroportos</a></li>
                    <li><a href="{{ route('manager.companies.index') }}">Companhias</a></li>
                    <li><a href="{{ route('manager.rate.index') }}">Tarifas</a></li>
                    <li><a href="{{ route('manager.statistic.index') }}">Estatísticas</a></li>
                </ul>
            </li>

            <li class="droplink">
                <a href="#" class="waves-effect waves-button">
                    <span class="menu-icon glyphicon glyphicon-usd"></span>
                    <p>Financeiro</p><span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li><a href="{{ route('manager.quotation.index') }}">Cotações</a></li>
                    <li><a href="{{ route('manager.op.index') }}">OPs</a></li>
                    <li><a href="{{ route('manager.payment.index') }}">Pagamentos</a></li>
                </ul>

            </li>

        </ul>
    </div><!-- Page Sidebar Inner -->
</div><!-- Page Sidebar -->