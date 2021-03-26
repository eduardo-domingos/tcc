<?php
	session_start();
	include ('conexao.php');
	if(isset($_POST['Enviar'])){

		$id_projeto = $_SESSION['id_projeto'];
		$id_usuario = $_SESSION['id_usuario'];
		$nome = $_POST['nome'];
		//$email = $_POST['email'];
		$comentario = $_POST['comentario'];
		$data_coment = date('Y-m-d');

		$insert= 'INSERT INTO comentarios(id_usuario, id_projeto,comentario, nome, data_coment) VALUES('.$id_usuario.','.$id_projeto.',"'.$comentario.'", "'.$nome.'", "'.$data_coment.'");';
		#echo($insert);
		$query = mysqli_query($conexao, $insert);
		
		
		if($query){
			echo('<script>window.alert("Comentário enviado com sucesso!");window.location="ver_projeto.php";</script>');
		}else{
			echo('<script>window.alert("Falha ao enviar comentário!");window.location="ver_projeto.php";</script>');
		}
	}
?>