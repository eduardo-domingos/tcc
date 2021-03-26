<?php
    session_start();
    include ('../conexao.php');
    $id_comentario = $_GET['id_comentario'];
    $id_usuario = $_GET['id_usuario'];
    
    $sql = 'DELETE FROM comentarios WHERE id_comentario = '.$id_comentario.' AND id_usuario = '.$id_usuario.';';
    $deletar = mysqli_query($conexao,$sql);

    if($deletar){
        echo('<script>window.alert("Deletado com sucesso!");window.location="listar_comentarios.php";</script>');
    }
    else{
        echo('<script>window.alert("Falha ao deletar!");window.location="listar_comentarios.php";</script>');
    }
    
?>