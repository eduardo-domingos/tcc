<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/estilo.css" rel="stylesheet">
		<link rel="shortcut icon" href="icons/world_connection.ico">
        <title>Editar Projetos</title>
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
            $id_usuario = $_SESSION['id_usuario'];
            $id_projeto = $_POST['id_projeto'];
            $sql = 'SELECT * FROM projetos WHERE id_projeto = '.$id_projeto.' AND id_usuario = '.$_SESSION['id_usuario'].';';
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
                    $valor = $controle['valor'];
            
        ?>

        <section class="container" id="tela_cadastro" >
            
            <section class="botao_cadastrar">
                <a href="projetos.php" role="button" class="btn btn-sm btn-primary">Voltar</a>
            </section>
            
            <form name="cadastro_usuario" action="atualizar_projeto.php" method="POST" enctype="multipart/form-data">
                <section class="form-row">
                    <section class="col">
                        <section class="form-group">
                            <label>Titulo do Projeto</label>
                            <input name="id_projeto" value="<?php echo($id_projeto); ?>" hidden>
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

                <?php }} ?>
        <footer class="rodape bg-dark">
			<?php
				include('rodape.html');
			?>
            <!-- JS -->
            <script src="js/jquery-3.5.1.min.js"></script>
            <script src="js/bootstrap.bundle.min.js"></script>
            <!-- Valida Senha -->
            <script src="js/valida_senha.js"></script>
		</footer>
    </body>
</html>