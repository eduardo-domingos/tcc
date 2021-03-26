<?php
    session_start();
    include ('../conexao.php');

    $id_admin = $_GET['id_admin'];
    $sql = 'DELETE FROM admins WHERE id_admin = '.$id_admin.';';
    $deletar = mysqli_query($conexao,$sql);

    if($deletar){
        echo('<script>window.alert("Deletado com sucesso!");window.location="listar_admin.php";</script>');
    }
    else{
        echo('<script>window.alert("Falha ao deletar!");window.location="listar_admin.php";</script>');
    }
    
?>