<?php
    session_start();
    include ('conexao.php');

    if(isset($_POST['Deletar'])){

        $id_usuario = $_SESSION['id_usuario'];
        $id_projeto = $_POST['id_projeto'];
        #echo($id_projeto);

        $sql = 'SELECT * FROM projetos WHERE id_projeto = '.$id_projeto.' AND id_usuario = '.$id_usuario.';';

        $busca = mysqli_query($conexao,$sql);

        while($controle = mysqli_fetch_array($busca)){

            $imagem = $controle['imagem'];
        }
        
        $sql2 ='DELETE FROM comentarios WHERE id_usuario = '.$id_usuario.' AND id_projeto = '.$id_projeto.';';
        $sql3 = 'DELETE FROM financiamentos WHERE id_projeto = '.$id_projeto.';';
        $sql4 = 'DELETE FROM likes WHERE id_projeto = '.$id_projeto.';';
        $sql5 = 'DELETE FROM projetos WHERE id_usuario = '.$id_usuario.' AND id_projeto = '.$id_projeto.';';

        #echo($sql2.'<br>');
        #echo($sql3);
        $deletar2 = mysqli_query($conexao,$sql2);
        $deletar3 = mysqli_query($conexao,$sql3);
        $deletar4 = mysqli_query($conexao, $sql4);
        $deletar5 = mysqli_query($conexao, $sql5);
        
        if($deletar2 and $deletar3 and $deletar4 and $deletar5){
            echo('<script>window.alert("Deletado com sucesso!");window.location="projetos.php";</script>');
            unlink('img_projetos/'.$imagem);
        }
        else{
            echo('<script>window.alert("Falha ao deletar!");window.location="projetos.php";</script>');
        }

    }
    
?>
