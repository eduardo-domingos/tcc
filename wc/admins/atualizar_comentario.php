<?php

    include ('../conexao.php'); 
         
    if(isset($_POST['Atualizar'])){
        
        $id_comentario = $_POST['id_comentario'];
        $id_usuario = $_POST['id_usuario'];
        $id_projeto = $_POST['id_projeto'];
        $comentario = $_POST['comentario'];
        $nome = $_POST['nome'];
        $data = date("Y/m/d");


        $sql = 'UPDATE comentarios SET comentario = "'.$comentario.'", data_coment = "'.$data.'" WHERE id_comentario = '.$id_comentario.';';

        $atualizar = mysqli_query($conexao,$sql);

        
        if($atualizar){
            echo('<script>window.alert("Atualizado com sucesso!");window.location="listar_comentarios.php";</script>'); 
        }
        else{
            echo('<script>window.alert("Falha ao atualizar!");window.location="listar_comentarios.php";</script>');
        }
        
    }

?>
