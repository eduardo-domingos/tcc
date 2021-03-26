<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/estilo.css" rel="stylesheet">
		<link rel="shortcut icon" href="icons/world_connection.ico">
        <title>Criar Projetos</title>
    </head>
    <body>
		
		<header>
			<?php
				include('navbar.php');
				include('valida_login.php');
			?>
		</header>	
        <section class="container" id="tela_cadastro" >
            
            <section class="botao_cadastrar">
                <a href="Index.php" role="button" class="btn btn-sm btn-primary">Voltar</a>
            </section>
            
            <form name="cadastro_usuario" action="cadastrar_projeto.php" method="POST" enctype="multipart/form-data">
                <section class="form-row">
                    <section class="col">
                        <section class="form-group">
                            <label>Titulo do Projeto</label>
                            <input type="text"  name="titulo" class="form-control" autocomplete="off" required placeholder="Nome do Projeto">
                        </section>
                    </section>
                </section>
                <section class="form-row">
                    <section class="col">
                        <section class="form-group">
                            <label>Equipe</label>
                      		<textarea class="form-control" name="equipe" rows="5"></textarea>
                        </section>
                    </section>
                </section>
                <section class="form-row">
                    <section class="col">
                        <section class="form-group">
                            <label>Resumo</label>
                            <textarea class="form-control" name="resumo" rows="5"></textarea>
                        </section>
                    </section>
                </section>
                <section class="form-row">
                    <section class="col">
                        <section class="form-group">
                            <label>Características</label>
                            <input type="text"  name="caracteristicas" class="form-control" autocomplete="off" required placeholder="Características">
                        </section>
                    </section>
                </section>
                <section class="form-row">
                    <section class="col">
                        <section class="form-group">
                            <label>Localidade</label>
                            <input type="text"  name="localidade" class="form-control" autocomplete="off" required placeholder="Localidade">
                        </section>
                    </section>
                </section>
                <section class="form-row">
                <section class="col">
                        <section class="form-group">
                            <label>Data de Inicio</label>
                            <input type="date"  name="data" class="form-control" autocomplete="off" required placeholder="Data de Inicio">
                        </section>
                    </section>
                </section>
                <section class="form-row">
                    <section class="col">
                        <section class="form-group">
                            <label>Vídeo</label>
                            <input type="url"  name="url" class="form-control" autocomplete="off" placeholder="url do youtube">
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
                            <input type="text" name="valor" class="form-control" autocomplete="off" required placeholder="dinheiro">
                        </section>
                    </section>
                </section>
				 <section class="botao_cadastrar">
                        <button name="Cadastrar" value="Cadastrar" type="submit" class="btn btn-sm btn-primary">Cadastrar</button>
                        <input class="btn btn-sm btn-primary" type="reset" value="Resetar">
                  </section>
            </form>
        </section>
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