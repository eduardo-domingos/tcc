<?php
    session_start();
    include('valida_login.php');
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
        <title>Cadastro Admin</title>
        <!-- CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="../css/estilo.css" rel="stylesheet">  
        <link rel="shortcut icon" href="../icons/world_connection.ico">     
    </head>
    <body>
        
        <section class="container" id="tela_cadastro" >
            <section class="botao_cadastrar">
                <a href="painel_controle.php" role="button" class="btn btn-sm btn-primary">Voltar</a>
            </section>
            
            <section id="login_logo">
                <picture>
                    <img src="../icons/logo_light_vetor_colorido.png" id="img_login">
                </picture>
            </section>
                
            <form name="cadastro_admin" action="cadastrar_admin.php" method="POST"> 
                <section class="form-group">
                    <label>Nome de Usuário</label>
                    <input type="text"  name="nome" class="form-control" autocomplete="off" required placeholder="Nome Completo">
                </section> 

                <section class="form-group">
                    <label>E-mail</label>
                    <input type="email"  name="email" class="form-control" autocomplete="off" required placeholder="Seu E-mail">
                </section> 

                <section class="form-group">
                    <label>Senha</label>
                    <input id="senha" type="password"  name="senha" class="form-control" autocomplete="off" required placeholder="Senha">
                </section> 

                <section class="form-group">
                    <label>Repetir Senha</label>
                    <input type="password"  name="senha2" class="form-control" autocomplete="off" required placeholder="Repetir Senha" oninput="validaSenha(this)">
                    <small>Precisa ser igual digitada acima.</small>
                </section> 

                <section class="botao_cadastrar">
                    <button name="Cadastrar" value="Cadastrar" type="submit" class="btn btn-sm btn-primary">Cadastrar</button>
                </section>

            </form>
        </section>

        <footer>
            <!-- JS -->
            <script src="../js/jquery-3.5.1.min.js"></script>
            <script src="../js/bootstrap.bundle.min.js"></script>
            <!-- Valida Senha -->
            <script src="../js/valida_senha.js"></script>
        </footer>
    </body>
</html>