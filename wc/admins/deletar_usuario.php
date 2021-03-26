<?php

    include ('../conexao.php');
    $id_usuario = $_GET['id_usuario'];

    # deletando likes
    $consulta_likes = 'SELECT * FROM likes WHERE id_usuario = '.$id_usuario.';';
    #echo($consulta_financ);
    $busca_likes = mysqli_query($conexao,$consulta_likes);
    $linhas = mysqli_num_rows($busca_likes);
    if($linhas > 0){
        $sql_likes = 'DELETE FROM likes WHERE id_usuario = '.$id_usuario.';';
        #echo($sql_financ);
        $deletar_likes = mysqli_query($conexao,$sql_likes);
    }


    # deletando comentarios
    $consulta_coment = 'SELECT * FROM comentarios WHERE id_usuario = '.$id_usuario.';';
    #echo($consulta_financ);
    $busca_coment = mysqli_query($conexao,$consulta_coment);
    $linhas = mysqli_num_rows($busca_coment);
    if($linhas > 0){
        $sql_coment = 'DELETE FROM comentarios WHERE id_usuario = '.$id_usuario.';';
        #echo($sql_financ);
        $deletar_coment = mysqli_query($conexao,$sql_coment);
    }

    # deletenado financiamento 
    $consulta_financ = 'SELECT * FROM financiamentos WHERE id_usuario = '.$id_usuario.';';
    #echo($consulta_financ);
    $busca_finac = mysqli_query($conexao,$consulta_financ);
    $linhas2 = mysqli_num_rows($busca_finac);
    if($linhas2 > 0){
        $sql_financ = 'DELETE FROM financiamentos WHERE id_usuario = '.$id_usuario.';';
        #echo($sql_financ);
        $deletar_financ = mysqli_query($conexao,$sql_financ);
    }

    # deletando projeto
    $consulta_projeto = 'SELECT * FROM projetos WHERE id_usuario = '.$id_usuario.';';
    $busca = mysqli_query($conexao,$consulta_projeto);
    $linhas3 = mysqli_num_rows($busca);
    if($linhas3 > 0){

        $sql3 = 'SELECT * FROM projetos WHERE id_usuario = '.$id_usuario.';';

        $busca_imagem = mysqli_query($conexao,$sql3);

        while($controle = mysqli_fetch_array($busca_imagem)){
            $imagem = $controle['imagem'];
            if($imagem == ""){

            }else{
                #echo($sql3);
                #echo($imagem);
                unlink('../img_projetos/'.$imagem);
            }
        }   
        
        $sql_projeto = 'DELETE FROM projetos WHERE id_usuario = '.$id_usuario.';';
        $deletar_projeto = mysqli_query($conexao,$sql_projeto);
    }
    
    # deletando conta
    $sql = 'DELETE FROM usuarios WHERE id_usuario = '.$id_usuario.';';
    $deletar = mysqli_query($conexao,$sql);

    
    if($deletar){
        echo('<script>window.alert("Deletado com sucesso!");window.location="listar_usuarios.php";</script>');
    }
    else{
        echo('<script>window.alert("Falha ao deletar!");window.location="listar_usuarios.php";</script>');
    }
    
?>