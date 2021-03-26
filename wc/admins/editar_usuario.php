<?php
        
    include ('../conexao.php');
    $id_usuario = $_GET['id_usuario'];

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Edição</title>
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
                <a href="listar_usuarios.php" role="button" class="btn btn-sm btn-primary">Voltar</a>
            </section>
            <h4>Formulário de Edição</h4>
            <form action="atualizar_usuario.php" method="POST" class="form_adicionar">
                
                <?php
                    $sql = 'SELECT * FROM usuarios WHERE id_usuario = '.$id_usuario.';';
                    
                    $buscar = mysqli_query($conexao,$sql);
                    
            
                    while($controle = mysqli_fetch_array($buscar)){
                        
                        $id_usuario = $controle['id_usuario'];
                        $nome = $controle['nome'];
                        $email = $controle['email'];
                        $numero = $controle['numero'];
                        $cpf_cnpj = $controle['cpf_cnpj'];
                        $senha = $controle['senha'];
                        $flag = $controle['flag'];
                    
                ?>

                <section class="form-group">
                    <label>Id</label>
                    <input type="number" name="id_usuario" class="form-control" value="<?php echo $id_usuario ?>" readonly>
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
                    <label>Número</label>
                    <input type="text" name="numero" class="form-control" value="<?php echo $numero ?>" autocomplete="off" required>
                </section>

                <section class="form-group">
                    <label>CPF/CNPJ</label>
                    <input type="text" name="cpf_cnpj" class="form-control" value="<?php echo $cpf_cnpj ?>" autocomplete="off" required>
                </section>

                <section class="form-group">
                    <label>Senha</label>
                    <input type="text" name="senha" class="form-control" value="<?php echo $senha ?>" autocomplete="off" required>
                </section>

                <section class="form-group">
                    <label>Flag</label>
                    <input type="text" name="flag" class="form-control" value="<?php echo $flag ?>" autocomplete="off" readonly>
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