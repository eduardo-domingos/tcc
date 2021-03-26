<?php
        
    include ('../conexao.php');
    $id_projeto = $_GET['id_projeto'];

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Projeto</title>
        <!-- CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="../css/estilo.css" rel="stylesheet">
        </style>
    </head>
    
    <body>

        <!--Formulário-->
        <section class="container" id="tela_cadastro">
            <section style="text-align: right" class="botao_voltar">
                <a href="listar_projetos.php" role="button" class="btn btn-sm btn-primary">Voltar</a>
            </section>
            <h4>Formulário de Edição</h4>
                
                <?php
                    $sql = 'SELECT * FROM projetos WHERE id_projeto = '.$id_projeto.';';
                    
                    $buscar = mysqli_query($conexao,$sql);
                    
            
                    while($controle = mysqli_fetch_array($buscar)){
                        
                        $id_usuario = $controle['id_usuario'];
                        $titulo = $controle['titulo'];
                        $equipe = $controle['equipe'];
                        $resumo = $controle['resumo'];
                        $caracteristicas = $controle['caracteristicas'];
                        $localidade = $controle['localidade'];
                        $data = $controle['data_inicio'];
                        $video = $controle['video'];
                        $imagem = $controle['imagem'];
                        $valor = $controle['valor'];
                    
                ?>
            
            <form name="cadastro_usuario" action="atualizar_projeto.php" method="POST" enctype="multipart/form-data">
                <section class="form-row">
                    <section class="col">
                        <section class="form-group">
                            <label>Titulo do Projeto</label>
                            <input name="id_projeto" value="<?php echo($id_projeto); ?>" hidden>
                            <input name="id_usuario" value="<?php echo($id_usuario); ?>" hidden>
                            <input type="text" value="<?php echo($titulo); ?>" name="titulo" class="form-control" autocomplete="off" required placeholder="Nome do Projeto">
                        </section>
                    </section>
                </section>
                <section class="form-row">
                    <section class="col">
                        <section class="form-group">
                            <label>Equipe</label>
                      		<textarea name="equipe" class="form-control" rows="5"><?php echo($equipe); ?></textarea>
                        </section>
                    </section>
                </section>
                <section class="form-row">
                    <section class="col">
                        <section class="form-group">
                            <label>Resumo</label>
                            <textarea name="resumo" class="form-control" rows="5"><?php echo($resumo); ?></textarea>
                        </section>
                    </section>
                </section>
                <section class="form-row">
                    <section class="col">
                        <section class="form-group">
                            <label>Características</label>
                            <input type="text"  name="caracteristicas" value="<?php echo($caracteristicas); ?>" class="form-control" autocomplete="off" required placeholder="Características">
                        </section>
                    </section>
                </section>
                <section class="form-row">
                <section class="col">
                        <section class="form-group">
                            <label>Localidade</label>
                            <input type="text"  name="localidade" value="<?php echo($localidade); ?>" class="form-control" autocomplete="off" required placeholder="Localidade">
                        </section>
                    </section>
                </section>
                <section class="form-row">
                <section class="col">
                        <section class="form-group">
                            <label>Data de Inicio</label>
                            <input type="date"  name="data_inicio" value="<?php echo($data); ?>" class="form-control" autocomplete="off" required placeholder="Data de Inicio">
                        </section>
                    </section>
                </section>
                <section class="form-row">
                <section class="col">
                        <section class="form-group">
                            <label>Vídeo</label>
                            <input type="text"  name="url"  value="<?php echo($video); ?>" class="form-control" autocomplete="off" placeholder="url do youtube">
                        </section>
                    </section>
                </section>
                <section class="form-row">
                <section class="col">
                        <section class="form-group">
                            <label>Imagem</label>
                            <input type="file" class="form-control-file" name="foto">
                        </section>
                    </section>
                </section>
                <section class="form-row">
                    <section class="col">
                        <section class="form-group">
                            <label>Valor de Financiamento</label>
                            <input type="text" maxlength="12" name="valor" class="form-control" value="<?php echo(number_format($valor,2,",","")); ?>" autocomplete="off" required placeholder="dinheiro">
                        </section>
                    </section>
                </section>
				 <section class="botao_cadastrar">
                        <button name="Atualizar" value="Atualizar" type="submit" class="btn btn-sm btn-primary">Atualizar</button>
                  </section>
            </form>
        </section>

                <?php } ?>

        <footer>
            <!-- JS -->
            <script src="../js/bootstrap.bundle.min.js"></script>
            <script src="../js/jquery-3.5.1.min.js"></script>
        </footer>
    </body>
</html>