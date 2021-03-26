<?php

    include ('../conexao.php'); 
         
    if(isset($_POST['Atualizar'])){
        
        $id_financiamento = $_POST['id_financiamento'];
        $id_usuario = $_POST['id_usuario'];
        $id_projeto = $_POST['id_projeto'];
        $quantidade_vezes = $_POST['quantidade_vezes'];
        $financiar = $_POST['financiar'];
        $data = date("Y/m/d");


        $sql = 'UPDATE financiamentos SET quantidade_vezes = "'.$quantidade_vezes.'", financiar = "'.$financiar.'", data_financ = "'.$data.'" WHERE id_financiamento = '.$id_financiamento.';';

        $atualizar = mysqli_query($conexao,$sql);
        #echo($sql);
        
        if($atualizar){
            echo('<script>window.alert("Atualizado com sucesso!");window.location="listar_financiamento.php";</script>'); 
        }
        else{
            echo('<script>window.alert("Falha ao atualizar!");window.location="listar_financiamento.php";</script>');
        }
        
    }

?>
