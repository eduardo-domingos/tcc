<?php
    session_start();
    include('../conexao.php');

    if(!empty($_POST) && (empty($_POST['Entrar']) || empty($_POST['senha']))){
        echo('<script>window.alert("Preencha os campos!");window.location="login_admin.html";</script>');
        exit;
    }

    $login = $_POST['nome'];
    $senha = sha1(trim($_POST['senha']));

    $sql = 'SELECT id_admin,email,senha FROM admins WHERE email = "'.$login.'" AND senha = "'.$senha.'";';

    $resul = mysqli_query($conexao,$sql);

    $con = mysqli_fetch_array($resul);

    $checar = mysqli_num_rows($resul);
    
    if(isset($checar) and $checar == 1){
        $_SESSION['login_admin'] = $con['email'];
        $_SESSION['id_admin'] = $con['id_admin'];
        echo('<script>window.alert("Logado com sucesso!");window.location="painel_controle.php";</script>');
        #header('location:Index.php');
        
    }else{
        #header('location:login_usuario.html');    
        echo('<script>window.alert("Login ou senha inválido");window.location="login_admin.html";</script>');
    }
?>