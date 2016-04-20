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
                <a href="{{ url('/') }}" class="waves-effect waves-button">
                    <span class="menu-icon glyphicon glyphicon-home"></span>
                    <p>Área de trabalho</p>
                </a>
            </li>
            <li>
                <a href="{{ route('user.index') }}" class="waves-effect waves-button">
                    <span class="menu-icon glyphicon glyphicon-user"></span>
                    <p>Usuários</p>
                </a>
            </li>
            <li>
                <a href="{{--{{ route('role.index') }}--}}" class="waves-effect waves-button">
                    <span class="menu-icon fa fa-users"></span>
                    <p>Papéis & Grupos</p>
                </a>
            </li>
        </ul>
    </div><!-- Page Sidebar Inner -->
</div><!-- Page Sidebar -->