<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/estilo.css" rel="stylesheet">
		<link rel="shortcut icon" href="icons/world_connection.ico">
        <title>Ver Projeto</title>
    </head>
    <body>
		
		<header>
			<?php
				include('navbar.php');
				include('valida_login.php');
			?>
		</header>	

		<!-- Statup -->

		<?php

			include('conexao.php');
			if(isset($_POST['Detalhes'])){
				$_SESSION['liberar'] = "liberar";

				$id_projeto = $_POST['id_projeto'];
				#echo($id_projeto);
				#$id_usuario = $_SESSION['id_usuario'];
				$_SESSION['id_projeto'] = $id_projeto;
				$var_pagina = $_POST['var_pagina'];	

				$_SESSION['var_pagina'] = $var_pagina;

				$var_pagina_atual = "ver_projeto.php";

				$sql = 'SELECT * FROM projetos WHERE id_projeto = '.$_SESSION['id_projeto'].' AND id_projeto = '.$id_projeto.';';
				#echo($sql);
				$busca = mysqli_query($conexao,$sql);
				#$linhas = mysqli_num_rows($busca);
						
				while($controle = mysqli_fetch_array($busca)){

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
					$data = date("d/m/Y",strtotime($data));

					$sql_like_total = 'SELECT * FROM likes WHERE id_projeto = '.$id_projeto.' AND curtiu = "sim";';

					$busca_total_like = mysqli_query($conexao,$sql_like_total);

					$resultado_total_like = mysqli_num_rows($busca_total_like);

					$total_likes = $resultado_total_like;

					$sql_deslike_total = 'SELECT * FROM likes WHERE id_projeto = '.$id_projeto.' AND curtiu = "não";';

					$busca_total_deslike = mysqli_query($conexao,$sql_deslike_total);

					$resultado_total_deslike = mysqli_num_rows($busca_total_deslike);

					$total_deslikes = $resultado_total_deslike;


					$sql_contato = 'SELECT id_usuario,nome,email from usuarios WHERE id_usuario = '.$id_usuario.';';

					$resultado_contato = mysqli_query($conexao,$sql_contato);

					while($controle_contato = mysqli_fetch_array($resultado_contato)){
						$email = $controle_contato['email'];
					}
	
					echo('
							<section id="projeto">
								<section class="row">	
									<section class="col-sm-8">
										<div class="container">
											<h1 id="titulo_projeto">Projeto</h1>
											<div id="meu_slideshow" class="carousel slide carousel-fade" data-ride="carousel" data-interval="0" style="text-align:center;">
				
												<!-- conteudo = imagens -->
												<div class="carousel-inner">
				
													<!-- Imagem 1 -->
													<div class="carousel-item active">
														<img class="card-img-top img-fluid" src="img_projetos/'.$imagem.'" style="width: 800px; height: 560px;">
													</div>
						');


					if(!empty($video)){

						echo('
														<!-- Imagem 2 -->
														<div class="carousel-item">
																	<iframe width="800" height="560px"
																	src="https://www.youtube.com/embed/'.$video.'"
																	frameborder="0"
																	allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
																	allowfullscreen>
																	</iframe>
														</div>	
							');
					}

					echo('								
				
												</div>
											</div>
										</div>
									</section>
									<!-- Voltar -->
									<a class="carousel-control-prev" href="#meu_slideshow" style="margin-top: 400px" data-slide="prev">
										<span class="carousel-control-prev-icon"></span>
										<span class="sr-only">Anterior</span>
									</a>
									
									
									<section class="col-sm-4">
										<h1 id="titulo_projeto">Informações</h1>
										<label>Titulo:<br>'.$titulo.'</label><br><br>
										<label>Equipe:<br>'.$equipe.'</label><br><br>
										<label>Resumo:<br>'.$resumo.'</label><br><br>
										<label>Caracteristicas:<br>'.$caracteristicas.'</label><br><br>
										<label>Localidade:<br>'.$localidade.'</label><br><br>
										<label>Contato:<br>'.$email.'</label><br><br>
										<label>Data:<br>'.$data.'</label><br><br>
										<label>Valor Total para financiamento:<br>R$ '.number_format($valor, 2,",","").'</label><br><br>
										<p class="cart-tetx">Likes: '.$total_likes.' &nbsp;&nbsp; Deslikes: '.$total_deslikes.'</p>
				
										<br>
										<section class="botao_cadastrar">
											<table align="right">
												<tr>
					');
				}
				
				
					echo('
							<td>
								<a href="'.$var_pagina.'" role="button" class="btn btn-primary">Voltar</a>
							</td>
						');
				
					#echo($var_pagina);

					$sql_projeto = 'SELECT id_projeto,id_usuario FROM projetos WHERE id_projeto = '.$id_projeto.' AND id_usuario = '.$_SESSION['id_usuario'].';';

					$busca_projeto = mysqli_query($conexao,$sql_projeto);
					#echo('<br>');
					#echo($sql_projeto);
					$resultado_projeto = mysqli_num_rows($busca_projeto);

					if($resultado_projeto == 0){
						echo('
														<td>
															<form name="financ" action="insertfinanc.php" method="POST">
																<input name="id_projeto" value="'.$id_projeto.'" hidden>
																<input name="financiar" value="sim" hidden>
																<input name="Financiar" value="Financiar" type="submit" class="btn btn-primary">
															</form>
														</td>
							');

							$consulta_like =  'SELECT * FROM likes WHERE id_projeto = '.$id_projeto.' AND id_usuario = '.$_SESSION['id_usuario'].';';

										$result_like = mysqli_query($conexao,$consulta_like);

										$linhas_like = mysqli_num_rows($result_like);

										if($linhas_like){

											while($controle_like = mysqli_fetch_array($result_like)){
												if($controle_like['curtiu'] == "sim"){
													echo('
																					<td>
																					<form name="like-form" method="POST" action="like.php">
																						<input name="id_projeto" value="'.$id_projeto.'" hidden>
																						<input name="var_pagina" value="'.$var_pagina_atual.'" hidden>
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
														
														
												');
												}
												elseif($controle_like['curtiu'] == "não"){

													echo('

																						<td>
																							<form name="like-form" method="POST" action="like.php">
																							<input name="var_pagina" value="'.$var_pagina_atual.'" hidden>
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
															
														');


												}else{
													echo('
																					<td>
																					<form name="like-form" method="POST" action="like.php">
																					<input name="var_pagina" value="'.$var_pagina_atual.'" hidden>
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
														
													');
												}
											}
											
										}else{
											echo('
																					<td>
																					<form name="like-form" method="POST" action="like.php">
																					<input name="var_pagina" value="'.$var_pagina_atual.'" hidden>	
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
							');
					}

					//$id_usuario = $_SESSION['id_usuario'];
					//$_SESSION['id_projeto'] = $id_projeto;
				
					$consulta_financ = 'SELECT * FROM financiamentos WHERE id_projeto = '.$id_projeto.' AND id_usuario = '.$_SESSION['id_usuario'].';';
					$query_consulta = mysqli_query($conexao,$consulta_financ);
					$result_consulta = mysqli_num_rows($query_consulta);

					$consulta = 'SELECT * FROM projetos WHERE id_usuario = '.$_SESSION['id_usuario'].' AND id_projeto = '.$id_projeto.';';
					#echo($consulta);
					$busca_projeto = mysqli_query($conexao,$consulta);
					$resultado_projeto = mysqli_num_rows($busca_projeto);
				
					if($resultado_projeto > 0 or $result_consulta > 0){	

						$consulta_usuario = 'SELECT id_usuario,nome FROM usuarios WHERE id_usuario = '.$_SESSION['id_usuario'].';';
						$busca_usuario = mysqli_query($conexao,$consulta_usuario);



						while($controle_usuario = mysqli_fetch_array($busca_usuario)){

							//$id_projeto = $controle['id_projeto'];
							$nome = $controle_usuario['nome'];
						}

						$consulta_projeto = 'SELECT id_projeto FROM projetos WHERE id_projeto = '.$id_projeto.';';
						$busca_projeto = mysqli_query($conexao,$consulta_projeto);

						while($controle_projeto = mysqli_fetch_array($busca_projeto)){
							$id_projeto = $controle_projeto['id_projeto'];
						}

							echo('
									<section class="ali">
										<div class="comentarios mb-3" style="max-width: 80rem;">
											<div class="card-header alinhar_texto">Comentar</div>
											<div class="card-body">
												<form name="coment" method="POST" action="insertcoment.php">
													<input name="id_projeto" value="'.$id_projeto.'" hidden>
													<input name="nome" value="'.$nome.'" hidden>
													<div class="form-group">
														<label  id="caca" for="exampleInputEmail1">Usuario</label>
														<input type="text" name="nome" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Seu nome" value="'.$nome.'" readonly>
														<small id="emailHelp" class="form-text text-muted"></small>
													</div>
							
													<div class="form-group">
														<label id="caca"> Seu comentario </label>
														<textarea class="form-control" name="comentario" placeholder="Comente"></textarea>
													</div>
							
													<section id="bot">
														<button type="submit" value="Enviar" name="Enviar" class="btn btn-sm btn-primary">Enviar</button>
													</section>
												</form>
											</div>
										</div>
									</section><br><br>
								');

								#$data_horario = date('d/m/Y H:i');
								#echo($data_horario);
						


						echo('<div class="">');
							echo('<div class="comentarios" style="max-width: 80rem; padding:30px;>');
								echo('<div class="">');

									include('conexao.php');
									$_SESSION['id_projeto'] = $id_projeto;
									$sql = 'SELECT * FROM comentarios WHERE id_projeto = '.$id_projeto.' ORDER BY id_comentario desc;';

									$executar = mysqli_query($conexao,$sql);

									$linhas = mysqli_num_rows($executar);

									if ($linhas > 0){

										echo('<table>');

										while($controle = mysqli_fetch_array($executar)){
											$nome = $controle['nome'];
											$comentario = $controle['comentario'];
											$data_coment = $controle['data_coment'];
											$data_coment = date('d/m/Y',strtotime($data_coment));
											echo('<tr>');
											echo('<td>');
											echo('<img src="icons/perfil3.png" width="130px">');
											echo('</td>');
											echo('<td>');
											echo ('Data: '.$data_coment.'<br>');
											echo ('Nome: '.$nome.'<br>');
											echo ('Comentario: '.$comentario.'<br>');
											echo ('<br>');
											echo('</td>');
											echo('</tr>');
										}

										echo('</table>');
									}
									else{
										echo ('<p class="mensagem_comentario">ainda não existem comentarios</p>');
									}
								echo('</div>');
							echo('</div>');
						echo('</div>');
					}else{
						echo('<p class="mensagem_comentario">Como você não criou e nem financiou este projeto você não pode comentar e nem ver os comentários</p>');
				}
	
			}elseif(isset($_SESSION['liberar'])){

				$var_pagina = $_SESSION['var_pagina'];
				#unset($_SESSION['var_pagina']);
				$var_pagina_atual = "ver_projeto.php";

				$sql = 'SELECT * FROM projetos WHERE id_projeto = '.$_SESSION['id_projeto'].';';
				#echo($sql);
				$busca = mysqli_query($conexao,$sql);
				#$linhas = mysqli_num_rows($busca);
						
				while($controle = mysqli_fetch_array($busca)){

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
					$data = date("d/m/Y",strtotime($data));

					$sql_like_total = 'SELECT * FROM likes WHERE id_projeto = '.$id_projeto.' AND curtiu = "sim";';

					$busca_total_like = mysqli_query($conexao,$sql_like_total);

					$resultado_total_like = mysqli_num_rows($busca_total_like);

					$total_likes = $resultado_total_like;

					$sql_deslike_total = 'SELECT * FROM likes WHERE id_projeto = '.$id_projeto.' AND curtiu = "não";';

					$busca_total_deslike = mysqli_query($conexao,$sql_deslike_total);

					$resultado_total_deslike = mysqli_num_rows($busca_total_deslike);

					$total_deslikes = $resultado_total_deslike;


					$sql_contato = 'SELECT id_usuario,nome,email from usuarios WHERE id_usuario = '.$id_usuario.';';

					$resultado_contato = mysqli_query($conexao,$sql_contato);

					while($controle_contato = mysqli_fetch_array($resultado_contato)){
						$email = $controle_contato['email'];
					}
	
					echo('
							<section id="projeto">
								<section class="row">	
									<section class="col-sm-8">
										<div class="container">
											<h1 id="titulo_projeto">Projeto</h1>
											<div id="meu_slideshow" class="carousel slide carousel-fade" data-ride="carousel" data-interval="0" style="text-align:center;">
				
												<!-- conteudo = imagens -->
												<div class="carousel-inner">
				
													<!-- Imagem 1 -->
													<div class="carousel-item active">
														<img class="card-img-top img-fluid" src="img_projetos/'.$imagem.'" style="width: 800px; height: 560px;">
													</div>
						');


					if(!empty($video)){

						echo('
														<!-- Imagem 2 -->
														<div class="carousel-item">
																	<iframe width="800" height="560px"
																	src="https://www.youtube.com/embed/'.$video.'"
																	frameborder="0"
																	allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
																	allowfullscreen>
																	</iframe>
														</div>	
							');
					}

					echo('								
				
												</div>
											</div>
										</div>
									</section>
									<!-- Voltar -->
									<a class="carousel-control-prev" href="#meu_slideshow" style="margin-top: 400px" data-slide="prev">
										<span class="carousel-control-prev-icon"></span>
										<span class="sr-only">Anterior</span>
									</a>
									
									
									<section class="col-sm-4">
										<h1 id="titulo_projeto">Informações</h1>
										<label>Titulo:<br>'.$titulo.'</label><br><br>
										<label>Equipe:<br>'.$equipe.'</label><br><br>
										<label>Resumo:<br>'.$resumo.'</label><br><br>
										<label>Caracteristicas:<br>'.$caracteristicas.'</label><br><br>
										<label>Localidade:<br>'.$localidade.'</label><br><br>
										<label>Contato:<br>'.$email.'</label><br><br>
										<label>Data:<br>'.$data.'</label><br><br>
										<label>Valor Total para financiamento:<br>R$ '.number_format($valor, 2,",","").'</label><br><br>
										<p class="cart-tetx">Likes: '.$total_likes.' &nbsp;&nbsp; Deslikes: '.$total_deslikes.'</p>
				
										<br>
										<section class="botao_cadastrar">
											<table align="right">
												<tr>
					');
				}
				
				
					echo('
							<td>
								<a href="'.$var_pagina.'" role="button" class="btn btn-primary">Voltar</a>
							</td>
						');
				
					#echo($var_pagina);

					$sql_projeto = 'SELECT id_projeto,id_usuario FROM projetos WHERE id_projeto = '.$id_projeto.' AND id_usuario = '.$_SESSION['id_usuario'].';';

					$busca_projeto = mysqli_query($conexao,$sql_projeto);
					#echo('<br>');
					#echo($sql_projeto);
					$resultado_projeto = mysqli_num_rows($busca_projeto);

					if($resultado_projeto == 0){
						echo('
														<td>
															<form name="financ" action="insertfinanc.php" method="POST">
																<input name="id_projeto" value="'.$id_projeto.'" hidden>
																<input name="financiar" value="sim" hidden>
																<input name="Financiar" value="Financiar" type="submit" class="btn btn-primary">
															</form>
														</td>
							');

							$consulta_like =  'SELECT * FROM likes WHERE id_projeto = '.$id_projeto.' AND id_usuario = '.$_SESSION['id_usuario'].';';

										$result_like = mysqli_query($conexao,$consulta_like);

										$linhas_like = mysqli_num_rows($result_like);

										if($linhas_like){

											while($controle_like = mysqli_fetch_array($result_like)){
												if($controle_like['curtiu'] == "sim"){
													echo('
																					<td>
																					<form name="like-form" method="POST" action="like.php">
																						<input name="id_projeto" value="'.$id_projeto.'" hidden>
																						<input name="var_pagina" value="'.$var_pagina_atual.'" hidden>
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
														
														
												');
												}
												elseif($controle_like['curtiu'] == "não"){

													echo('

																						<td>
																							<form name="like-form" method="POST" action="like.php">
																							<input name="var_pagina" value="'.$var_pagina_atual.'" hidden>
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
															
														');


												}else{
													echo('
																					<td>
																					<form name="like-form" method="POST" action="like.php">
																					<input name="var_pagina" value="'.$var_pagina_atual.'" hidden>
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
														
													');
												}
											}
											
										}else{
											echo('
																					<td>
																					<form name="like-form" method="POST" action="like.php">
																					<input name="var_pagina" value="'.$var_pagina_atual.'" hidden>	
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
							');
					}

					//$id_usuario = $_SESSION['id_usuario'];
					//$_SESSION['id_projeto'] = $id_projeto;
				
					$consulta_financ = 'SELECT * FROM financiamentos WHERE id_projeto = '.$id_projeto.' AND id_usuario = '.$_SESSION['id_usuario'].';';
					$query_consulta = mysqli_query($conexao,$consulta_financ);
					$result_consulta = mysqli_num_rows($query_consulta);

					$consulta = 'SELECT * FROM projetos WHERE id_usuario = '.$_SESSION['id_usuario'].' AND id_projeto = '.$id_projeto.';';
					$busca_projeto = mysqli_query($conexao,$consulta);
					$resultado_projeto = mysqli_num_rows($busca_projeto);
				
					if($result_consulta > 0 or $resultado_projeto > 0){	

						$consulta_usuario = 'SELECT id_usuario,nome FROM usuarios WHERE id_usuario = '.$_SESSION['id_usuario'].';';
						$busca_usuario = mysqli_query($conexao,$consulta_usuario);



						while($controle_usuario = mysqli_fetch_array($busca_usuario)){

							//$id_projeto = $controle['id_projeto'];
							$nome = $controle_usuario['nome'];
						}

						$consulta_projeto = 'SELECT id_projeto FROM projetos WHERE id_projeto = '.$id_projeto.';';
						$busca_projeto = mysqli_query($conexao,$consulta_projeto);

						while($controle_projeto = mysqli_fetch_array($busca_projeto)){
							$id_projeto = $controle_projeto['id_projeto'];
						}

							echo('
									<section class="ali">
										<div class="comentarios mb-3" style="max-width: 80rem;">
											<div class="card-header alinhar_texto">Comentar</div>
											<div class="card-body">
												<form name="coment" method="POST" action="insertcoment.php">
													<input name="id_projeto" value="'.$id_projeto.'" hidden>
													<input name="nome" value="'.$nome.'" hidden>
													<div class="form-group">
														<label  id="caca" for="exampleInputEmail1">Usuario</label>
														<input type="text" name="nome" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Seu nome" value="'.$nome.'" readonly>
														<small id="emailHelp" class="form-text text-muted"></small>
													</div>
							
													<div class="form-group">
														<label id="caca"> Seu comentario </label>
														<textarea class="form-control" name="comentario" placeholder="Comente"></textarea>
													</div>
							
													<section id="bot">
														<button type="submit" value="Enviar" name="Enviar" class="btn btn-sm btn-primary">Enviar</button>
													</section>
												</form>
											</div>
										</div>
									</section><br><br>
								');

								#$data_horario = date('d/m/Y H:i');
								#echo($data_horario);
						


						echo('<div class="">');
							echo('<div class="comentarios" style="max-width: 80rem; padding:30px;>');
								echo('<div class="">');

									include('conexao.php');
									$_SESSION['id_projeto'] = $id_projeto;
									$sql = 'SELECT * FROM comentarios WHERE id_projeto = '.$id_projeto.' ORDER BY id_comentario desc;';

									$executar = mysqli_query($conexao,$sql);

									$linhas = mysqli_num_rows($executar);

									if ($linhas > 0){

										echo('<table>');

										while($controle = mysqli_fetch_array($executar)){
											$nome = $controle['nome'];
											$comentario = $controle['comentario'];
											$data_coment = $controle['data_coment'];
											$data_coment = date('d/m/Y',strtotime($data_coment));
											echo('<tr>');
											echo('<td>');
											echo('<img src="icons/perfil3.png" width="130px">');
											echo('</td>');
											echo('<td>');
											echo ('Data: '.$data_coment.'<br>');
											echo ('Nome: '.$nome.'<br>');
											echo ('Comentario: '.$comentario.'<br>');
											echo ('<br>');
											echo('</td>');
											echo('</tr>');
										}

										echo('</table>');
									}
									else{
										echo ('<p class="mensagem_comentario">ainda não existem comentarios</p>');
									}
								echo('</div>');
							echo('</div>');
						echo('</div>');
					}else{
						echo('<p class="mensagem_comentario">Como você não criou e nem financiou este projeto você não pode comentar e nem ver os comentários</p>');
				}
			}
			
		?>
				
		<!-- Statup -->
		
		<!-- comentários -->
			
			
			</div><br><br>	
		<!-- comentários -->

		<!-- rodape -->
		<footer class="rodape bg-dark">
			<?php
				include('rodape.html');
			?>
			<script src="js/jquery-3.5.1.min.js"></script>
			<script src="js/bootstrap.bundle.min.js"></script>
		</footer>
		<!-- rodape -->
    </body>
</html>