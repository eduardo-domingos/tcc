<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Comentários</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
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

        <section class="container" id="listar_projetos">
            <section class="botao_voltar">
                    <a href="painel_controle.php" role="button" class="btn btn-sm btn-primary">Voltar</a>
            </section>
            <form name="buscar" action="#" method="GET">
                <section class="form-group">
                    <center>
                        <label>Pesquisa:</label>
                        <input class="form-control container2" type="text" name="busca" placeholder="Digite o id do projeto" autocomplete="off" required>    
                        <button type="submit" name="pesquisar" value="pesquisar" class="btn btn-success btn-sm botao_pesquisar">Pesquisar</button>
                    </center>
                </section>
            </form>

            <section>
                <?php
                    include('../conexao.php');

                    # começo da paginação
                    $limite = 10;
                    if(!isset($_GET['pag'])){
                        $pagina = 1;
                    }else{
                        $pagina = $_GET['pag'];
                    }

                    $inicio = ($pagina * $limite)-$limite;
                    # começo da paginação

                    if(isset($_GET['pesquisar'])){
                        $busca = $_GET['busca'];
                    
                        if(empty($busca)){
                            echo('<script>window.alert("Preencha o campo!");window.location="listar_financiamento.php";</script>');
                        }else{

                            #$sql = 'SELECT * FROM livros WHERE nome LIKE "'.$busca.'%";';
                            $sql = 'SELECT * FROM financiamentos WHERE id_projeto LIKE "%'.$busca.'%";';
                            #$sql = 'SELECT * FROM livros WHERE id_livros = '.$busca.';';

                            $busca = mysqli_query($conexao,$sql);

                            $linhas = mysqli_num_rows($busca);

                            if($linhas == 0) echo('<script>window.alert("Financiamento não encontrado!");window.location="listar_financiamento.php";</script>');
                        }
                    }
                    else{

                        $sql = 'SELECT * FROM financiamentos;';  

                    }

                    $busca = mysqli_query($conexao,$sql);

                    $linhas = mysqli_num_rows($busca);

                    $total_paginas = ceil($linhas / $limite);


                ?>
            </section>

           
            <h3>Financiamentos</h3>
            <br>
            <section class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">id_financiamento</th>
                            <th scope="col">id_projeto</th>
                            <th scope="col">id_usuario</th>
                            <th scope="col">Financiar</th>
                            <th scope="col">Quantidade</th>
                            <th scope="col">Data</th>
                            <th scope="col" colspan="2">Opções</th>
                        </tr>
                    </thead>
                
                    <?php

                        while($controle = mysqli_fetch_array($busca)){

                            $id_financiamento = $controle['id_financiamento'];
                            $id_usuario = $controle['id_usuario'];
                            $id_projeto = $controle['id_projeto'];
                            $financiar = $controle['financiar'];
                            $quantidade_vezes = $controle['quantidade_vezes'];
                            $data = $controle['data_financ'];

                    ?>  

                    <tr>    
                         
                        <td><?php echo $id_financiamento ?></td>
                        <td><?php echo $id_projeto ?></td>
                        <td><?php echo $id_usuario ?></td>
                        <td><?php echo $financiar ?></td>
                        <td><?php echo $quantidade_vezes ?></td>
                        <td><?php echo $data ?></td>
                                    

                           

                        <td>
                            <a class="btn btn-warning btn-sm" href="editar_financiamento.php?id_financiamento=<?php echo $id_financiamento ?>&id_usuario =<?php echo $id_usuario ?>" role="button">
                                <img class="icones" src="../icons/pencil.png" name="Editar" value="Editar">&nbsp;Editar
                            </a>

                            <a class="btn btn-danger btn-sm botao_excluir" href="deletar_financiamento.php?id_financiamento=<?php echo $id_comentario ?>&id_usuario=<?php echo $id_usuario ?>" role="button">
                                <img class="icones" src="../icons/lixeira.png" name="Excluir" value="Excluir">&nbsp;Excluir
                            </a>
                        </td>
                    </tr>

                    <?php } ?>

                    <tr>
                        <td colspan="11">
                            <?php echo ('Quantidade de projetos: '.$linhas); ?>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="11">
                            <nav aria-label="paginação">
                                <ul class="pagination justify-content-center">
                                    <?php 
                                        if($pagina > 1){
                                            $anterior = $pagina - 1;
                                            echo('
                                                    <li class="page-item">
                                                        <a class="page-link" href="listar_financiamento.php?pag='.$anterior.'">Anterior</a>
                                                    </li>
                                                ');
                                        }else{
                                            echo('
                                                    <li class="page-item disabled">
                                                        <a class="page-link" href="">Anterior</a>
                                                    </li>
                                                ');
                                        }
                                    
                                        for($cont=1; $cont<=$total_paginas; $cont++){ 
                                            if($pagina == $cont){
                                                echo('
                                                        <li class="page-item active">
                                                            <a class="page-link" href="listar_financiamento.php?pag='.$cont.'">'.$cont.'</a>
                                                        </li>
                                                    ');
                                            }else{
                                                echo('
                                                        <li class="page-item">
                                                            <a class="page-link" href="listar_financiamento.php?pag='.$cont.'">'.$cont.'</a>
                                                        </li>
                                                    ');
                                                }
                                        }

                                        if($pagina < $total_paginas){
                                            $proximo = $pagina + 1;
                                            echo('
                                                    <li class="page-item">
                                                        <a class="page-link" href="listar_financiamento.php?pag='.$proximo.'">Próximo</a>
                                                    </li>
                                                ');
                                        }else{
                                            echo('
                                                    <li class="page-item disabled">
                                                        <a class="page-link" href="">Próximo</a>
                                                    </li>
                                                ');
                                        }

                                    ?>
                                </ul>
                            </nav>
                        </td>
                    </tr>
                </table>
            </section>
        </section>

        <footer>
            <!-- JS -->
            <script src="../js/jquery-3.5.1.min.js"></script>
            <script src="../js/bootstrap.bundle.min.js"></script>
        </footer>
    </body>
</html>