<?php
    session_start();
    include ('../conexao.php');


    $sql = 'DELETE FROM admins WHERE id_admin = '.$_SESSION['id_admin'].';';
    $deletar = mysqli_query($conexao,$sql);

    if($deletar){
        echo('<script>window.alert("Deletado com sucesso!");window.location="login_admin.html";</script>');
    }
    else{
        echo('<script>window.alert("Falha ao deletar!");window.location="painel_controle.php";</script>');
    }
    
?>