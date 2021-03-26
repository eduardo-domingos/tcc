<?php
    session_start();
    include ('../conexao.php');
    $id_admin = $_GET['id_admin'];

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Admin</title>
        <!-- CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="../css/estilo_admin.css" rel="stylesheet">
        <link rel="shortcut icon" href="../icons/world_connection.ico">
        </style>
    </head>
    
    <body>

        <!--Formulário-->
        <section class="container" id="tela_cadastro">
            <section class="botao_voltar">
                <a href="listar_admin.php" role="button" class="btn btn-sm btn-primary">Voltar</a>
            </section>
            <h4>Formulário de Edição</h4>
            <form action="atualizar_admin.php" method="POST" class="form_adicionar">
                
                <?php
                    $sql = 'SELECT * FROM admins WHERE id_admin = '.$id_admin.';';
                    
                    $buscar = mysqli_query($conexao,$sql);
                    
            
                    while($controle = mysqli_fetch_array($buscar)){
                        
                        $id_admin = $controle['id_admin'];
                        $nome = $controle['nome'];
                        $email = $controle['email'];
                        $senha = $controle['senha'];
                ?>

                <section class="form-group">
                    <label>id do Admin</label>
                    <input type="number" name="id_admin" class="form-control" value="<?php echo $id_admin ?>" readonly>
                </section>

                <section class="form-group">
                    <label>Nome</label>
                    <input type="text" name="nome" class="form-control" value="<?php echo $nome ?>" autocomplete="off" required>
                </section>

                <section class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="<?php echo $email ?>" autocomplete="off" required>
                </section>

                <section class="form-group">
                    <label>Senha</label>
                    <input type="text" name="senha" class="form-control" value="<?php echo $senha ?>" autocomplete="off" required>
                </section>

                <section style="text-align: right;">
                    <button type="submit" name="Atualizar" value="Atualizar" class="btn btn-primary btn-sm">Atualizar</button>
                </section>

                <?php } ?>
            </form>
        </section>

        <footer>
            <!-- JS -->
            <script src="../js/bootstrap.bundle.min.js"></script>
            <script src="../js/jquery-3.5.1.min.js"></script>
        </footer>
    </body>
</html>