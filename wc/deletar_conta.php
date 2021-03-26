<?php
    session_start();
    include('conexao.php');

    if(isset($_POST['deletar'])){

        $sql_busca = 'SELECT id_projeto,id_usuario,imagem FROM projetos WHERE id_usuario = '.$_SESSION['id_usuario'].';';

        $busca = mysqli_query($conexao,$sql_busca);

        while($controle = mysqli_fetch_array($busca)){
            $imagem = $controle['imagem'];
            if($imagem == ""){

            }else{
                #echo($sql3);
                #echo($imagem);
                unlink('img_projetos/'.$imagem);
            }
        }   
        $sql1 = 'DELETE FROM likes WHERE id_usuario = '.$_SESSION['id_usuario'].';';
        $sql2 = 'DELETE FROM comentarios WHERE id_usuario = '.$_SESSION['id_usuario'].';';
        $sql3 = 'DELETE FROM financiamentos WHERE id_usuario = '.$_SESSION['id_usuario'].';';
        $sql4 = 'DELETE FROM projetos WHERE id_usuario = '.$_SESSION['id_usuario'].';';
        $sql5 = 'DELETE FROM usuarios WHERE id_usuario = '.$_SESSION['id_usuario'].';';

        $deletar1 = mysqli_query($conexao,$sql1);
        $deletar2 = mysqli_query($conexao,$sql2);
        $deletar3 = mysqli_query($conexao,$sql3);
        $deletar4 = mysqli_query($conexao,$sql4);
        $deletar5 = mysqli_query($conexao,$sql5);
        
        if($deletar1 and $deletar2 and $deletar3 and $deletar4 and $deletar5){
            echo('<script>window.alert("Deletado com sucesso!");window.location="logout.php";</script>');
        }
        else{
            echo('<script>window.alert("Falha ao deletar!");window.location="perfil_usuario.php";</script>');
        }
        
    }

?>