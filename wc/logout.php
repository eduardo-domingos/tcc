<?php
	session_start();
	session_destroy();
	echo('<script>window.alert("Você deslogou do sistema!");window.location="Index.php";</script>');
	#header('Location: login_usuario.html');
?>