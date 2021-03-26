<?php
    session_start();
    include('valida_login.php');
    include('conexao.php');
    
    if(isset($_POST['Financiar'])){
        $id_projeto = $_POST['id_projeto'];
        $financiar = $_POST['financiar'];
        $data_finac = date("Y/m/d");

        $sql_consulta_financ = 'SELECT * FROM financiamentos WHERE id_usuario = '.$_SESSION['id_usuario'].' AND id_projeto = '.$id_projeto.';';
        $resultado = mysqli_query($conexao,$sql_consulta_financ);
        #echo($sql_consulta_financ);
        $linhas = mysqli_num_rows($resultado);
        #echo($sql_consulta_financ);
        #echo($linhas);

        while($controle2 = mysqli_fetch_array($resultado)){
            $quantidade_vezes = $controle2['quantidade_vezes'];
        }
        #echo($quantidade_vezes);
        if($linhas > 0){
            $quantidade_vezes = $quantidade_vezes + 1;
            #echo($quantidade_vezes);
            $sql = 'UPDATE financiamentos set quantidade_vezes = '.$quantidade_vezes.' WHERE id_usuario = '.$_SESSION['id_usuario'].' AND id_projeto = '.$id_projeto.';';
            $comando = mysqli_query($conexao,$sql);
            
            if($comando){
                echo('<script>window.alert("Você financiou este projeto por cerca de '.$quantidade_vezes.'x!");window.location="financiamentos.php";</script>');
            }
            exit;
        }else{
            $quantidade_vezes = 1;
            $sql = 'INSERT INTO financiamentos(id_projeto, id_usuario, financiar, quantidade_vezes, data_financ) VALUES('.$id_projeto.', '.$_SESSION['id_usuario'].', "'.$financiar.'", '.$quantidade_vezes.', "'.$data_finac.'");';
            #echo($sql);
            $comando = mysqli_query($conexao,$sql);
            #echo($sql);
        }
        
        if($comando){
            echo('<script>window.alert("Você financiou este projeto!");window.location="financiamentos.php";</script>');
        }else{
            echo('<script>window.alert("Falha ao financiar este projeto!");window.location="financiamentos.php";</script>');
        }
    }
?>