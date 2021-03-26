<!DOCTYPE html>
<html lang="pt-br">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Financiamento</title>
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
					include('conexao.php');
					
					$sql_finac = 'SELECT * FROM financiamentos WHERE id_usuario = '.$_SESSION['id_usuario'].' ;';
									
					$resul = mysqli_query($conexao,$sql_finac);

					$test = mysqli_num_rows($resul);

					while($controle_financ2 = mysqli_fetch_array($resul)){
						$id_projeto = $controle_financ2['id_projeto'];
					}

					if(empty($id_projeto)){
						$id_projeto = 0;	
					}

					$sql_projeto_financ = 'SELECT * FROM projetos WHERE id_projeto = '.$id_projeto.';';

					$result_projeto_financ = mysqli_query($conexao,$sql_projeto_financ);
				
					$test2 = mysqli_num_rows($result_projeto_financ);
					
					if($test2 > 0){

						while($controle = mysqli_fetch_array($result_projeto_financ)){
							
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

							#$var_pagina = "Index.php";
							$var_pagina = "financiamentos.php";

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
														<p class="cart-tetx">Likes: '.$total_likes.' &nbsp;&nbsp;Deslike: '.$total_deslikes.'</p>
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
																					<input name="var_pagina" value="'.$var_pagina.'" hidden>
																						<input name="id_projeto" value="'.$id_projeto.'" hidden>
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
																						<input name="id_projeto" value="'.$var_pagina.'" hidden>
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
								<p class="mensagem_financiamento">Você ainda não financiou nenhum projeto :(</p>
								
							');
					}
				?>
			</section>
					<br><br>
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
