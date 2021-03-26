<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/estilo.css" rel="stylesheet">
		<link rel="shortcut icon" href="icons/world_connection.ico">
        <title>Todos os projetos</title>
    </head>
    <body>
		
		<header>
			<?php
				include('navbar.php');
			?>
		</header>

			<section class="card_pesquisa">
				<section class="card-body">
			    	<form method="GET" action="#">
			    		<section class="row">
			    			<section class="col">
      							<input class="form-control campo_pesquisar" name="busca" type="search" placeholder="pesquise pelo título da startup" required>
      						</section>
      						<section class="col">
     			 				<button class="btn btn-primary botao_pesquisa" name="pesquisar" type="submit">Pesquisar</button>
     			 			</section>
     			 		</section>
   				 	</form>
				</section>
			</section>

		<main>
			<section class="cards-projeto">
				<?php
					include('conexao.php');

						# começo da paginação
						$limite = 9;
						if(!isset($_GET['pag'])){
							$pagina = 1;
						}else{
							$pagina = $_GET['pag'];
						}

						$inicio = ($pagina * $limite)-$limite;
						# começo da paginação
					
					if(isset($_GET['pesquisar'])){
						$busca = htmlEntities($_GET['busca']);
					
						if(empty($busca)){
							echo('<script>window.alert("Preencha o campo!");window.location="todos_projetos.php";</script>');
						}else{

							#$sql = 'SELECT * FROM livros WHERE nome LIKE "'.$busca.'%";';
							$sql = 'SELECT * FROM projetos WHERE titulo LIKE "%'.$busca.'%";';
							#$sql = 'SELECT * FROM livros WHERE id_livros = '.$busca.';';

							$busca = mysqli_query($conexao,$sql);

							$linhas = mysqli_num_rows($busca);

							if($linhas == 0) echo('<script>window.alert("Projeto não encontrado!");window.location="todos_projetos.php";</script>');
						}
					}
					else{

						$sql = 'SELECT * FROM projetos LIMIT '.$inicio.', '.$limite.';';  

					}
									
					$resul = mysqli_query($conexao,$sql);

					$test = mysqli_num_rows($resul);
					
					$total_paginas = ceil($test / $limite);

					$quant_project = 'SELECT * FROM projetos;';
					$quant_2 = mysqli_query($conexao,$quant_project);
					$quant_linhas = mysqli_num_rows($quant_2);
					
					#echo($quant_linhas);
					if($quant_linhas == 10){
						$total_paginas = $total_paginas + 1;
					}else{

					}
					

					#echo($total_paginas);
			
					
					if($test > 0){

						while($controle = mysqli_fetch_array($resul)){
							
							$id_usuario = $controle['id_usuario'];
							$id_projeto =$controle['id_projeto'];
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

						
							#$_SESSION['var_pagina'] = "todos_projetos.php";
							#$var_pagina = $_SESSION['var_pagina'];
							$var_pagina = "todos_projetos.php";
							#echo($var_pagina);
							#echo($id_projeto);
							
							echo('
									<section class="sec-cards-projeto">
										<section class="cards-index"  style="max-width: 25rem">
											<section class="card-deck">
												<section class="card">
													<img class="card-img-top img-fluid" src="img_projetos/'.$imagem.'" alt="imagem relacionada ao projeto">
													<section class="card-body">
														<h5 class="card-title">Título: '.$titulo.'</h5>
														<p class="card-text">Resumo: '.$resumo.'</p>
														<p class="cart-text">Localidade: '.$localidade.'</p>
														<p class="cart-text">Data: '.date("d/m/Y",strtotime($data)).'</p>
														<p class="cart-tetx">Likes: '.$total_likes.' &nbsp;&nbsp;Deslikes: '.$total_deslikes.'</p>
														<table align="right">
															<tr>
																<td>
																	<form action="ver_projeto.php" method="POST">
																		<input name="id_projeto" value="'.$id_projeto.'" hidden>
																		<input name="var_pagina" value="'.$var_pagina.'" hidden>
																		<input name="Detalhes" value="Detalhes" type="submit" class="btn btn-primary">
																	</form>
																</td>
							');

								if(!empty($_SESSION['id_usuario'])){

								
									$sql = 'SELECT id_projeto,id_usuario FROM projetos WHERE id_projeto = '.$id_projeto.' AND id_usuario = '.$_SESSION['id_usuario'].';';

									$busca = mysqli_query($conexao,$sql);
									#echo($sql);
									$resultado = mysqli_num_rows($busca);

									if($resultado == 0){


										echo('
																		<td>
																			<form action="insertfinanc.php" method="POST">
																				<input name="id_projeto" value="'.$id_projeto.'" hidden>
																				<input name="financiar" value="sim" hidden>
																				<input name="id_usuario" value="'.$id_usuario.'" hidden>
																				<input name="Financiar" value="Financiar" type="submit" class="btn btn-primary">
																			</form>
																		</td>
											');

										$consulta_like =  'SELECT * FROM likes WHERE id_projeto = '.$id_projeto.' AND id_usuario = '.$_SESSION['id_usuario'].';';

										$result_like = mysqli_query($conexao,$consulta_like);

										$linhas_like = mysqli_num_rows($result_like);

										if($linhas_like > 0){

											while($controle_like = mysqli_fetch_array($result_like)){
												if($controle_like['curtiu'] == "sim"){
													echo('
																					<td>
																					<form name="like-form" method="POST" action="like.php">
																						<input name="id_projeto" value="'.$id_projeto.'" hidden>
																						<input name="var_pagina" value="'.$var_pagina.'" hidden>
																						<button type="submit" name="like" class="btn btn-primary btn-sm">
																							<img src="icons/like2.png" id="logo_like">
																						</button>
																						<button name="deslike" type="submit" class="btn btn-primary btn-sm">
																							<img src="icons/deslike.png" id="logo_like">
																						</button>	
																					</form>
																					</td>
																				</tr>
																			</table>
																		</section>
																	</section>
																</section>
															</section>
														</section>
												');
												}
												elseif($controle_like['curtiu'] == "não"){

													echo('

																						<td>
																							<form name="like-form" method="POST" action="like.php">
																							<input name="var_pagina" value="'.$var_pagina.'" hidden>
																								<input name="id_projeto" value="'.$id_projeto.'" hidden>
																								<button type="submit" name="like" class="btn btn-primary btn-sm">
																									<img src="icons/like.png" id="logo_like">
																								</button>
																								<button name="deslike" type="submit" class="btn btn-primary btn-sm">
																									<img src="icons/deslike2.png" id="logo_like">
																								</button>
																							</form>
																						</td>
																						<td>
																					</tr>
																				</table>
																			</section>
																		</section>
																	</section>
																</section>
															</section>
														');


												}else{
													echo('
																					<td>
																					<form name="like-form" method="POST" action="like.php">
																					<input name="var_pagina" value="'.$var_pagina.'" hidden>
																						<input name="id_projeto" value="'.$id_projeto.'" hidden>
																						<button type="submit" name="like" class="btn btn-primary btn-sm">
																							<img src="icons/like.png" id="logo_like">
																						</button>
																						<button name="deslike" type="submit" class="btn btn-primary btn-sm">
																							<img src="icons/deslike.png" id="logo_like">
																						</button>	
																					</form>
																					</td>
																				</tr>
																			</table>
																		</section>
																	</section>
																</section>
															</section>
														</section>
												');
												}
											}

											

											
										}else{

										

											echo('
																	
																			<td>
																				<form name="like-form" method="POST" action="like.php">
																				<input name="var_pagina" value="'.$var_pagina.'" hidden>
																					<input name="id_projeto" value="'.$id_projeto.'" hidden>
																					<button type="submit" name="like" class="btn btn-primary btn-sm">
																						<img src="icons/like.png" id="logo_like">
																					</button>
																					<button name="deslike" type="submit" class="btn btn-primary btn-sm">
																						<img src="icons/deslike.png" id="logo_like">
																					</button>
																				</form>
																			</td>
																		</tr>
																	</table>
																</section>
															</section>
														</section>
													</section>
												</section>
					
										
											');
										}
										
									}else{

										echo('


																				
																				
																					<td>
																						<form name="dados_porjeto" action="editar_projeto.php" method="POST">
																							<input name="id_projeto" value="'.$id_projeto.'" hidden>
																							<input name="Editar" value="Editar" type="submit" class="btn btn-primary">
																						</form>
																					</td>
																					<td>
																						<form name="dados_porjeto" action="deletar_projeto.php" method="POST">
																							<input name="id_projeto" value="'.$id_projeto.'" hidden>
																							<input name="Deletar" value="Deletar" type="submit" class="btn btn-primary">
																						</form>
																					</td>
																				</tr>
																			</table>
																		</section>
																	</section>
																</section>
															</section>
														</section>
												
											');
										
									}
								}else{
									echo('
																	<td>
																		<form action="insertfinanc.php" method="POST">
																			<input name="id_projeto" value="'.$id_projeto.'" hidden>
																			<input name="financiar" value="sim" hidden>
																			<input name="Financiar" value="Financiar" type="submit" class="btn btn-primary">
																		</form>
																	</td>
																	<td>
																			<button type="button" class="btn btn-primary btn-sm">
																				<img src="icons/like.png" id="logo_like">
																			</button>
																		</td>
																		<td>
																			<button type="button" class="btn btn-primary btn-sm">
																				<img src="icons/deslike.png" id="logo_like">
																			</button>
																		</td>
																</tr>
															</table>
														</section>
													</section>
												</section>
											</section>
										</scetion>
									</section>
										
									');
								}
						}	
						
					}else{

						echo('
								<table align="center" style="margin-top: 90px; margin-bottom: 200px;">
									<tr>
										<td align="center";"><h5>Sem projetos</h5><td>
									</tr>

									<tr>
										<td align="center"><p>Não há Dados</p></td>
									</tr>
								</table>
								
							');
					}
				?>
			</section>
		</main>

			<table align="center">
						<tr>
							<td>
								<nav aria-label="paginação">
									<ul class="pagination justify-content-center">
										<?php 
											if($pagina > 1){
												$anterior = $pagina - 1;
												echo('
														<li class="page-item">
															<a class="page-link" href="todos_projetos.php?pag='.$anterior.'">Anterior</a>
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
																<a class="page-link" href="todos_projetos.php?pag='.$cont.'">'.$cont.'</a>
															</li>
														');
												}else{
													echo('
															<li class="page-item">
																<a class="page-link" href="todos_projetos.php?pag='.$cont.'">'.$cont.'</a>
															</li>
														');
													}
											}

											if($pagina < $total_paginas){
												$proximo = $pagina + 1;
												echo('
														<li class="page-item">
															<a class="page-link" href="todos_projetos.php?pag='.$proximo.'">Próximo</a>
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

			<footer class="rodape bg-dark">
				<?php
					include('rodape.html');
				?>
				<script src="js/jquery-3.5.1.min.js"></script>
				<script src="js/bootstrap.bundle.min.js"></script>
		</footer>
    </body>
</html>