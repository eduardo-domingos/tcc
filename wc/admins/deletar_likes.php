<?php
    session_start();
    include ('../conexao.php');
    $id_like = $_GET['id_like'];
    $id_usuario = $_GET['id_usuario'];
    
    $sql = 'DELETE FROM likes WHERE id_like = '.$id_like.' AND id_usuario = '.$id_usuario.';';
    $deletar = mysqli_query($conexao,$sql);

    if($deletar){
        echo('<script>window.alert("Deletado com sucesso!");window.location="listar_likes.php";</script>');
    }
    else{
        echo('<script>window.alert("Falha ao deletar!");window.location="listar_likes.php";</script>');
    }
    
?>