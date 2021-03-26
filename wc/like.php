<?php
    session_start();
    include('conexao.php');
    $id_projeto = $_POST['id_projeto'];
    $var_pagina = $_POST['var_pagina'];

    if(isset($_POST['like'])){

        $sql_consulta = 'SELECT * FROM likes WHERE id_projeto = '.$id_projeto.' AND id_usuario = '.$_SESSION['id_usuario'].';';
        #echo($sql_consulta);
        $resultado_consulta = mysqli_query($conexao,$sql_consulta);

        $linhas = mysqli_num_rows($resultado_consulta);

        while($controle1 = mysqli_fetch_array($resultado_consulta)){
            $curtiu = $controle1['curtiu'];
        }
        #echo($sql_consulta);
        if(empty($curtiu)){
            $pontos = 1;
            $sql = 'INSERT INTO likes(id_usuario, id_projeto, curtiu, pontos) VALUES('.$_SESSION['id_usuario'].','.$id_projeto.', "sim",'.$pontos.');';
            #echo($sql);
            $resultado = mysqli_query($conexao,$sql);

        }elseif($curtiu == "sim"){
            
            $sql_delete = 'DELETE FROM likes WHERE id_projeto = '.$id_projeto.' AND id_usuario = '.$_SESSION['id_usuario'].';';
            #echo($$sql_delete);
            $delete = mysqli_query($conexao,$sql_delete);

            echo('<script>window.alert("Removido como gostei");window.location="'.$var_pagina.'";</script>');
            exit;

        }else{

            $sql_update = 'UPDATE likes set curtiu = "sim" WHERE id_projeto = '.$id_projeto.' AND id_usuario = '.$_SESSION['id_usuario'].';';

            $update = mysqli_query($conexao,$sql_update);


            echo('<script>window.alert("Marcado como gostei");window.location="'.$var_pagina.'";</script>');
            exit;
        }
        
        if($resultado){
            echo('<script>window.alert("Marcado como gostei");window.location="'.$var_pagina.'";</script>');
        }else{
            echo('<script>window.alert("Falha ao marcar como gostei");window.location="'.$var_pagina.'";</script>');
        }
    
    }

    if(isset($_POST['deslike'])){

        $sql_consulta2 = 'SELECT * FROM likes WHERE id_projeto = '.$id_projeto.' AND id_usuario = '.$_SESSION['id_usuario'].';';

        $resultado_consulta2 = mysqli_query($conexao,$sql_consulta2);

        $linhas2 = mysqli_num_rows($resultado_consulta2);

        while($controle2 = mysqli_fetch_array($resultado_consulta2)){
            $curtiu2 = $controle2['curtiu'];
        }

        #echo($sql_consulta2);

        if(empty($curtiu2)){
            $pontos = 1;
            $sql2 = 'INSERT INTO likes(id_usuario, id_projeto, curtiu, pontos) VALUES('.$_SESSION['id_usuario'].','.$id_projeto.', "não", '.$pontos.');';

            $resultado2 = mysqli_query($conexao,$sql2);
            
        }elseif($curtiu2 == "não"){
            
            $sql_delete2 = 'DELETE FROM likes WHERE id_projeto = '.$id_projeto.' AND id_usuario = '.$_SESSION['id_usuario'].';';
            #echo($sql_delete2);
            $delete2 = mysqli_query($conexao,$sql_delete2);

            echo('<script>window.alert("Removido como não gostei");window.location="'.$var_pagina.'";</script>');
            exit;

        }else{

            $sql_update2 = 'UPDATE likes set curtiu = "não" WHERE id_projeto = '.$id_projeto.' AND id_usuario = '.$_SESSION['id_usuario'].';';

            $update2 = mysqli_query($conexao,$sql_update2);


            echo('<script>window.alert("Marcado como não gostei");window.location="'.$var_pagina.'";</script>');
            exit;

        }
        
        if($resultado2){
            echo('<script>window.alert("Marcado como não gostei");window.location="'.$var_pagina.'";</script>');
        }else{
            echo('<script>window.alert("Falha ao marcar como gostei");window.location="'.$var_pagina.'";</script>');
        }

    }

?>