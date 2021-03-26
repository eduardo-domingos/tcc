<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <a class="navbar-brand" href="#">
        <img src="../icons/logo_light_vetor_colorido.png" id="logo" alt="logo">&nbsp;&nbsp;World Connection
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Alterna navegação">
        <span class="navbar-toggler-icon"></span>
    </button>

    <section class="collapse navbar-collapse" id="navbarNav">

        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" id="item-menu" href="listar_admin.php">admin</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="item-menu" href="listar_usuarios.php">Usuarios</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="item-menu" href="listar_projetos.php">Projetos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="item-menu" href="listar_financiamento.php">Financiamentos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="item-menu" href="listar_comentarios.php">Comentários</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="item-menu" href="listar_likes.php">Likes</a>
            </li>
            <section class="btn-group">
                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="../icons/perfil2.png" id="logo_perfil">
                </button>
                <?php                 
                    session_start();
                    if(!empty($_SESSION['login_admin'])){
                        echo('
                                <section class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="painel_controle.php">Painel de Controle</a>
                                    <a class="dropdown-item" href="perfil_admin.php">Perfil</a>
                                    <section class="dropdown-divider"></section>
                                    <a class="dropdown-item" href="logout.php">Sair</a>
                                </section>
                            ');
                    }else{
                       echo('erro');
                    }
                
                ?>
            </section>
        </ul>
    </section>
</nav>
<!-- Navbar -->