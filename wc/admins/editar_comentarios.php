<?php
        
    include ('../conexao.php');
    $id_comentario = $_GET['id_comentario'];

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
            <section style="text-align: right" class="botao_voltar">
                <a href="listar_comentarios.php" role="button" class="btn btn-sm btn-primary">Voltar</a>
            </section>
            <h4>Formulário de Edição</h4>
                
                <?php
                    $sql = 'SELECT * FROM comentarios WHERE id_comentario = '.$id_comentario.';';
                    
                    $buscar = mysqli_query($conexao,$sql);
                    
            
                    while($controle = mysqli_fetch_array($buscar)){
                        
                        $id_comentario = $controle['id_comentario'];
                        $id_projeto = $controle['id_projeto'];
                        $id_usuario = $controle['id_usuario'];
                        $nome = $controle['nome'];
                        $comentario = $controle['comentario'];
                        $data = $controle['data_coment'];
                        
                
                ?>
            
            <form name="cadastro_usuario" action="atualizar_comentario.php" method="POST">
                <section class="form-row">
                    <section class="col">
                        <section class="form-group">
                            <label>Id Comentario</label>
                            <input name="id_comentario" class="form-control" value="<?php echo($id_comentario); ?>" readonly>
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
                            <label>Nome</label>
                            <input name="nome" class="form-control" value="<?php echo($nome); ?>" readonly>
                        </section>
                    </section>
                </section>
                <section class="form-row">
                    <section class="col">
                        <section class="form-group">
                            <label>Comentario</label>
                            <textarea class="form-control" name="comentario" rows="5"><?php echo($comentario); ?></textarea>
                        </section>
                    </section>
                </section>
                <section class="form-row">
                    <section class="col">
                            <section class="form-group">
                                <label>Data</label>
                                <input type="date"  name="data_coment" value="<?php echo($data); ?>" class="form-control" autocomplete="off" required readonly>
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