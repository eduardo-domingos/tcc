<!DOCTYPE html>
<html lang="pt-br">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Projetos</title>
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="css/estilo.css" rel="stylesheet">
      <link rel="shortcut icon" href="icons/world_connection.ico"> 
    </head>

    <body>

        <header>
            <?php
                include('navbar.php');
				include('valida_login.php');
            ?>
        </header><br>

        <section class="cards-projeto">
            <?php
                #$id_projeto = $_GET['id_projeto'];
                include('conexao.php');
                $id_usuario = $_SESSION['id_usuario'];
                $sql = 'SELECT * FROM projetos WHERE id_usuario = '.$id_usuario.';';
                //echo $sql;exit;            
                $resul = mysqli_query($conexao,$sql);
                //print_r($resul);exit;
                $linhas = mysqli_num_rows($resul);

                if($linhas > 0){

                    while($controle = mysqli_fetch_array($resul)){
                        
                        $id_usuario = $controle['id_usuario'];
                        $id_projeto = $controle['id_projeto'];
                        $titulo = $controle['titulo'];
                        $equipe = $controle['equipe'];
                        $resumo = $controle['resumo'];
                        $caracteristicas = $controle['caracteristicas'];
                        $localidade = $controle['localidade'];
                        $data = $controle['data_inicio'];
                        $video = $controle['video'];
                        $imagem = $controle['imagem'];

                        $sql_like_total = 'SELECT * FROM likes WHERE id_projeto = '.$id_projeto.' AND curtiu = "sim";';

                        $busca_total_like = mysqli_query($conexao,$sql_like_total);

                        $resultado_total_like = mysqli_num_rows($busca_total_like);

                        $total_likes = $resultado_total_like;

                        $sql_deslike_total = 'SELECT * FROM likes WHERE id_projeto = '.$id_projeto.' AND curtiu = "não";';

                        $busca_total_deslike = mysqli_query($conexao,$sql_deslike_total);

                        $resultado_total_deslike = mysqli_num_rows($busca_total_deslike);

                        $total_deslikes = $resultado_total_deslike;

                        $var_pagina = "projetos.php";
            ?>

                <section class="sec-cards-projeto">
                    <section class="card-deck" style="max-width: 26rem;">
                        <section class="card">
                            <img class="card-img-top img-fluid" src="img_projetos/<?php echo($imagem); ?>" alt="Card image cap" id="foto_card">
                            <section class="card-body" >
                                <p class="card-text">Você criou este projeto. Pode alterar e remover a hora que quiser</p>
                                <h5 class="card-title">Título: <?php echo($titulo); ?></h5>
                                <p class="card-text">Resumo: <?php echo($resumo); ?></p>
                                <p class="cart-text">Localidade: <?php echo($localidade); ?></p>
                                <p class="cart-text">Data: <?php echo date("d/m/Y",strtotime($data)) ?></p>
                                <p class="cart-tetx">Likes: <?php echo($total_likes); ?> &nbsp;&nbsp;Deslikes: <?php echo($total_deslikes); ?></p>
                                
                                <table align="right">
                                    <tr>
                                        <td>
                                            <form name="dados_porjeto" action="ver_projeto.php" method="POST">
                                                <input name="id_projeto" value="<?php echo($id_projeto); ?>" hidden>
                                                <input name="var_pagina" value="<?php echo($var_pagina); ?>" hidden>
                                                <input name="Detalhes" value="Detalhes" type="submit" class="btn btn-primary">
                                            </form>
                                        </td>
                                        <td>
                                            <form name="dados_porjeto" action="editar_projeto.php" method="POST">
                                                <input name="id_projeto" value="<?php echo($id_projeto); ?>" hidden>
                                                <input name="Editar" value="Editar" type="submit" class="btn btn-primary">
                                            </form>
                                        </td>
                                        <td>
                                            <form name="dados_porjeto" action="deletar_projeto.php" method="POST">
                                                <input name="id_projeto" value="<?php echo($id_projeto); ?>" hidden>
                                                <input name="Deletar" value="Deletar" type="submit" class="btn btn-primary">
                                            </form>
                                        </td>
                                    </tr>
                                </table>
                            </section>
                        </section>
                    </section>
                </form>
            </section>

                <?php
                        }
                    }else{
                        echo('<p class="mensagem_projeto">Você ainda não criou nenhum projeto :(</p>');
                    }

                ?>
        </section>
       
       <footer class="rodape bg-dark">
            <?php
                include('rodape.html');
            ?>
            <!-- JS -->
            <script src="js/jquery-3.5.1.min.js"></script>
            <script src="js/bootstrap.bundle.min.js"></script>
        </footer>
     
    </body>
</html>
