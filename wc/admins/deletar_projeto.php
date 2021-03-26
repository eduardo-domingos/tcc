<?php
    session_start();
    include ('../conexao.php');
    $id_projeto = $_GET['id_projeto'];
    $id_usuario = $_GET['id_usuario'];

    $sql3 = 'SELECT id_usuario,imagem FROM projetos WHERE id_usuario = '.$id_usuario.'  AND id_projeto = '.$id_projeto.' ;';

    $busca = mysqli_query($conexao,$sql3);

    while($controle = mysqli_fetch_array($busca)){

        $imagem = $controle['imagem'];

        if($imagem == ""){

        }else{
            unlink('../img_projetos/'.$imagem);
        }

    }
    
    $sql = 'DELETE FROM projetos WHERE id_projeto = '.$id_projeto.';';
    $deletar = mysqli_query($conexao,$sql);

    if($deletar){
        echo('<script>window.alert("Deletado com sucesso!");window.location="listar_projetos.php";</script>');
    }
    else{
        echo('<script>window.alert("Falha ao deletar!");window.location="listar_projetos.php";</script>');
    }
    
?>