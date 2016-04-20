<div class="menu-wrap">
    <nav class="profile-menu">
        <div class="profile"><img src="{{ url(IMG_PATH . 'profile-menu-image.png') }}" width="60" alt="{{ $user->fullname }}"/>
            <span>{{ $user->fullname }}</span>
        </div>
        <a href="#"><i class="fa fa-star"></i><span>Favoritos</span></a>
        <a href="#"><i class="fa fa-bell"></i><span>Alertes</span></a>
        <div class="profile-menu-list">
            <a href="#"><i class="fa fa-envelope"></i><span>Mensagem</span></a>
            <a href="#"><i class="fa fa-comment"></i><span>Comentários</span></a>
        </div>
    </nav>
    <button class="close-button" id="close-button">Fechar Menu</button>
</div>