<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
        <title>Perfil</title>
        <!-- CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="css/estilo.css" rel="stylesheet"> 
        <link rel="shortcut icon" href="icons/world_connection.ico">
    </head>
    
    <body>

        <header>
            <?php
                include('navbar.php');
				include('valida_login.php');
            ?>
        </header>

        <?php
            include('conexao.php');
            $sql = 'SELECT * from usuarios WHERE id_usuario = '.$_SESSION['id_usuario'].';';

            $busca = mysqli_query($conexao,$sql);

            $linhas = mysqli_num_rows($busca);

            while($controle = mysqli_fetch_array($busca)){

                $id_usuario = $controle['id_usuario'];
                $nome = $controle['nome'];
                $email = $controle['email'];
                $numero = $controle['numero'];
                $cpf_cnpj = $controle['cpf_cnpj'];
                $senha = $controle['senha'];
                $flag = $controle['flag'];

        ?>

        <section class="container quad">

            <section id="foto_center"> 
                <section class="row">
                    <section class="col">
                        <picture>
                            <img id="foto_perfil" src="icons/perfil3.png" alt="imagem do usuário">
                        </picture>
                    </section>
                </section>
            </section>
                

            <form name="login" action="atualizar_usuario.php" method="POST">

                <section class="form-row">
                    <section class="col">
                        <section class="form-group">
                            <label>Nome de Usuário</label>
                            <input type="text"  maxlength="50" name="nome" class="form-control" autocomplete="off" value="<?php echo($nome); ?>" readonly>
                        </section>
                    </section>

                </section>

                <section class="form-row">
                    <section class="col">
                        <section class="form-group">
                            <label>Número</label>
                            <input type="tel" maxlength="15" name="numero" class="form-control" autocomplete="off" value="<?php echo($numero); ?>">
                        </section>
                    </section>

                    <section class="col">
                        <section class="form-group">
                            <label>E-mail</label>
                            <input type="email" maxlength="50"  name="email" class="form-control" autocomplete="off" value="<?php echo($email); ?>">
                        </section> 
                    </section>
                </section>

                <section class="form-row">
                    <section class="col">
                        <section class="form-group">
                            <label>Pessoa</label>
                            <input type="text" name="flag" class="form-control" autocomplete="off" value="<?php echo($flag); ?>" readonly>
                        </section>
                    </section>

                    <section class="col">
                        <section class="form-group">
                            <?php
                                if(strlen($cpf_cnpj) == 14){
                                    echo('<label>CPF</label>');
                                }else{
                                    echo('<label>CNPJ</label>');
                                }
                            ?>
                            <input type="text" name="cpf_cnpj" class="form-control" autocomplete="off" value="<?php echo($cpf_cnpj); ?>" readonly>
                        </section>
                    </section>
                    
                </section>
                        
                <section class="form-row">
                    <section class="col">
                        <section class="form-group">
                            <label>Senha</label>
                            <input id="senha" type="password" maxlength="8" name="senha" class="form-control" autocomplete="off" value="<?php echo($senha); ?>">
                        </section> 
                    </section>

                    <section class="col">
                        <section class="form-group">
                            <label>Repetir Senha</label>
                            <input type="password" maxlength="8" name="senha2" class="form-control" autocomplete="off" value="<?php echo($senha); ?>" oninput="validaSenha(this)">
                        </section> 
                    </section>
                </section>

                <section class="form-row">
                    <section class="col">
                        <section class="botao_atualizar">
                            <button name="Atualizar" value="Atualizar" type="submit" class="btn btn-primary">Atualizar</button>
                        </section>
                    </section>
            </form>

            <form action="deletar_conta.php" method="POST">
                <section class="col">
                    <section class="botao_atualizar">
                        <button name="deletar" value="deletar" type="submit" class="btn btn-primary">Deletar Conta</button>
                    </section>
                </section>
            </form>
            </section>
                

        </section>
    
            <?php } ?>

        <footer class="rodape bg-dark">

            <?php
                include('rodape.html');
            ?>

            <!-- JS -->
            <script src="js/jquery-3.5.1.min.js"></script>
            <script src="js/bootstrap.bundle.min.js"></script>
            <script src="js/valida_senha.js"></script>
        </footer>
    </body>
</html>