<?php

    include ('../conexao.php'); 
         
    if(isset($_POST['Atualizar'])){
        
        $id_like = $_POST['id_like'];
        $id_usuario = $_POST['id_usuario'];
        $id_projeto = $_POST['id_projeto'];
        $curtiu = $_POST['curtiu'];
        $pontos = 1;
        #$data = date("Y/m/d");


        $sql = 'UPDATE likes SET curtiu = "'.$curtiu.'" WHERE id_like = '.$id_like.';';

        $atualizar = mysqli_query($conexao,$sql);

        
        if($atualizar){
            echo('<script>window.alert("Atualizado com sucesso!");window.location="listar_likes.php";</script>'); 
        }
        else{
            echo('<script>window.alert("Falha ao atualizar!");window.location="listar_likes.php";</script>');
        }
        
    }

?>
