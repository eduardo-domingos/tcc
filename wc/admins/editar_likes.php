<?php
        
    include ('../conexao.php');
    $id_like = $_GET['id_like'];

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Editar Comentarios</title>
        <!-- CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="../css/estilo.css" rel="stylesheet">
        </style>
    </head>
    
    <body>

        <!--Formulário-->
        <section class="container" id="tela_cadastro">
            <section align="right" class="botao_voltar">
                <a href="listar_likes.php" role="button" class="btn btn-sm btn-primary">Voltar</a>
            </section>
            <h4>Formulário de Edição</h4>
                
                <?php
                    $sql = 'SELECT * FROM likes WHERE id_like = '.$id_like.';';
                    
                    $buscar = mysqli_query($conexao,$sql);
                    
            
                    while($controle = mysqli_fetch_array($buscar)){
                        
                        $id_like = $controle['id_like'];
                        $id_projeto = $controle['id_projeto'];
                        $id_usuario = $controle['id_usuario'];
                        $curtiu = $controle['curtiu'];
                        $pontos = $controle['pontos'];                        
                
                ?>
            
            <form name="cadastro_usuario" action="atualizar_likes.php" method="POST">
                <section class="form-row">
                    <section class="col">
                        <section class="form-group">
                            <label>Id Like</label>
                            <input name="id_like" class="form-control" value="<?php echo($id_like); ?>" readonly>
                        </section>
                    </section>
                </section>
                <section class="form-row">
                    <section class="col">
                        <section class="form-group">
                            <label>Id Projeto</label>
                            <input name="id_projeto" class="form-control" value="<?php echo($id_projeto); ?>" readonly>
                        </section>
                    </section>
                </section>
                <section class="form-row">
                    <section class="col">
                        <section class="form-group">
                            <label>Id Usuario</label>
                            <input name="id_usuario" class="form-control" value="<?php echo($id_usuario); ?>" readonly>
                        </section>
                    </section>
                </section>
                <section class="form-row">
                    <section class="col">
                        <section class="form-group">
                            <label>Curtiu</label>
                            <input name="curtiu" class="form-control" value="<?php echo($curtiu); ?>">
                        </section>
                    </section>
                </section>
                <section class="form-row">
                    <section class="col">
                            <section class="form-group">
                                <label>Pontos</label>
                                <input type="text"  name="data_coment" value="<?php echo($pontos); ?>" class="form-control" autocomplete="off" required readonly>
                            </section>
                        </section>
                    </section>
				 <section class="botao_cadastrar">
                        <button name="Atualizar" value="Atualizar" type="submit" class="btn btn-sm btn-primary">Atualizar</button>
                  </section>
            </form>
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