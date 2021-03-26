<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
        <title>Painel de Controle Admin</title>
        <!-- CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="../css/estilo_admin.css" rel="stylesheet"> 
        <link rel="shortcut icon" href="../icons/world_connection.ico">      
    </head>
    
    <body>

        <header>
            <?php
                include('navbar.php');
                include('valida_login.php');
            ?>
        </header>

        <section class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                             <h5 class="card-title">Cadastrar Admins</h5>
                            <p class="card-text">Opção para cadastrar admins.</p>
                            <a href="cadastro_admin.php" class="btn btn-primary">Cadastrar</a>
                        </div>
                    </div>
                </div> 
            </div>
        </section>
    
        <footer>
            <!-- JS -->
            <script src="../js/jquery-3.5.1.min.js"></script>
            <script src="../js/bootstrap.bundle.min.js"></script>
        </footer>
    </body>
</html>