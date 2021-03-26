<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
        <title>Perfil</title>
        <!-- CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="../css/estilo.css" rel="stylesheet"> 
        <link rel="shortcut icon" href="../icons/world_connection.ico">
    </head>
    
    <body>

        <header>
            <?php
                include('navbar.php');
				include('valida_login.php');
            ?>
        </header>

        <?php
            include('../conexao.php');
            $sql = 'SELECT * from admins WHERE id_admin = '.$_SESSION['id_admin'].';';

            $busca = mysqli_query($conexao,$sql);

            $linhas = mysqli_num_rows($busca);

            while($controle = mysqli_fetch_array($busca)){

                $id_admin = $controle['id_admin'];
                $nome = $controle['nome'];
                $email = $controle['email'];
                $senha = $controle['senha'];

        ?>

        <section class="container quad">

            <section id="foto_center"> 
                <section class="row">
                    <section class="col">
                        <picture>
                            <img id="foto_perfil" src="../icons/perfil3.png" alt="imagem do usuário">
                        </picture>
                    </section>
                </section>
            </section>
                

            <form name="login" action="#" method="POST">

                <section class="form-row">
                    <section class="col">
                        <section class="form-group">
                            <label>Nome de Usuário</label>
                            <input type="text"  maxlength="50" name="nome" class="form-control" autocomplete="off" value="<?php echo($nome); ?>">
                            <input type="text" name="id_admin" class="form-control" autocomplete="off" value="<?php echo($id_admin); ?>" hidden>
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
                            <button name="Atualizar" value="Atualizar" type="submit" class="btn btn-sm btn-primary">Atualizar</button>
                        </section>
                    </section>
            </form>

            <form action="#" method="GET">
                <section class="col">
                    <section class="botao_atualizar">
                        <button name="deletar" value="deletar" type="submit" class="btn btn-sm btn-primary">Deletar Conta</button>
                        <input name="id_admin" type="text" value="<?php echo($id_admin); ?>" hidden>
                    </section>
                </section>
            </form>
            </section>
                

        </section>
    
            <?php } ?>

            <?php
                include ('../conexao.php'); 
                    
                if(isset($_POST['Atualizar'])){
                    
                    $nome = $_POST['nome'];
                    $email = $_POST['email'];
                    $senha = $_POST['senha'];
                    
                    if(strlen($senha) == 40){

                        $sql = 'UPDATE admins SET nome ="'.$nome.'", email = "'.$email.'", senha = "'.$senha.'" WHERE id_admin = '.$_SESSION['id_admin'].';';

                        $atualizar = mysqli_query($conexao,$sql);
                        
                        if($atualizar){
                            echo('<script>window.alert("Atualizado com sucesso!");window.location="perfil_admin.php";</script>'); 
                        }
                        else{
                            echo('<script>window.alert("Falha ao atualizar!");window.location="perfil_admin.php";</script>');
                        }
                    }else{
                        $senha = sha1($senha);

                        $sql = 'UPDATE admins SET nome = "'.$nome.'", email = "'.$email.'", senha = "'.$senha.'" WHERE id_admin = '.$_SESSION['id_admin'].';';

                        $atualizar = mysqli_query($conexao,$sql);
                        
                        if($atualizar){
                            echo('<script>window.alert("Atualizado com sucesso!");window.location="perfil_admin.php";</script>'); 
                        }
                        else{
                            echo('<script>window.alert("Falha ao atualizar!");window.location="perfil_admin.php";</script>');
                        }
                    }

                }

                if(isset($_GET['deletar'])){

                    $id_admin = $_GET['id_admin'];
                    $sql = 'DELETE FROM admins WHERE id_admin = '.$id_admin.';';
                    $deletar = mysqli_query($conexao,$sql);

                    if($deletar){
                        echo('<script>window.alert("Deletado com sucesso!");window.location="logout.php";</script>');
                    }
                    else{
                        echo('<script>window.alert("Falha ao deletar!");window.location="perfil_admin.php";</script>');
                    }
                }
        
            ?>




        <footer>

            <!-- JS -->
            <script src="../js/jquery-3.5.1.min.js"></script>
            <script src="../js/bootstrap.bundle.min.js"></script>
            <script src="../js/valida_senha.js"></script>
        </footer>
    </body>
</html>