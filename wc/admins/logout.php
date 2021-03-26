<?php
	session_start();
	session_destroy();
	echo('<script>window.alert("Você deslogou do sistema!");window.location="login_admin.html";</script>');
	#header('Location: login_usuario.html');
?>