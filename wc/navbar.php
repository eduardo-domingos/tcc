<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <a class="navbar-brand" href="#">
        <img src="icons/logo_light_vetor_colorido.png" id="logo" alt="logo">&nbsp;&nbsp;World Connection
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Alterna navegação">
        <span class="navbar-toggler-icon"></span>
    </button>

    <section class="collapse navbar-collapse" id="navbarNav">

        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" id="item-menu" href="Index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="item-menu" href="sobre.php">Sobre</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="item-menu" href="todos_projetos.php">Projetos</a>
            </li>
            <section class="btn-group">
                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="icons/perfil2.png" id="logo_perfil">
                </button>
                <?php
                    session_start();                    
                    if(empty($_SESSION['login'])){
                        echo('  
                                <section class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="cadastro_usuario.html">Cadastro</a>
                                    <a class="dropdown-item" href="login_usuario.html">Login</a>
                                </section>
                            ');
                    }else{
                        echo('
                                <section class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="perfil_usuario.php">Meu Perfil</a>
                                    <a class="dropdown-item" href="projetos.php">Meus Projetos</a>
                                    <a class="dropdown-item" href="criar_projeto.php">Criar Projeto</a>
                                    <a class="dropdown-item" href="financiamentos.php">Meus Financiamentos</a>
                                    <section class="dropdown-divider"></section>
                                    <a class="dropdown-item" href="logout.php">Sair</a>
                                </section>
                            ');
                    }
                
                ?>
            </section>
        </ul>
    </section>
</nav>
<!-- Navbar -->