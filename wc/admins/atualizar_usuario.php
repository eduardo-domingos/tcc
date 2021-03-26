<?php

    include ('../conexao.php'); 
         
    if(isset($_POST['Atualizar'])){
        
        $id_usuario = $_POST['id_usuario'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $numero = $_POST['numero'];
        $cpf_cnpj = $_POST['cpf_cnpj'];
        $senha = $_POST['senha'];
        $flag = $_POST['flag'];

        if(strlen($senha) == 40){
            $nome = ucfirst(strtolower($nome));

            $sql = 'UPDATE usuarios SET nome = "'.$nome.'", email = "'.$email.'", numero = "'.$numero.'", cpf_cnpj = "'.$cpf_cnpj.'", senha = "'.$senha.'" WHERE id_usuario = '.$id_usuario.';';

            $atualizar = mysqli_query($conexao,$sql);
            
            
            if($atualizar){
                echo('<script>window.alert("Atualizado com sucesso!");window.location="listar_usuarios.php";</script>'); 
            }
            else{
                echo('<script>window.alert("Falha ao atualizar!");window.location="listar_usuarios.php";</script>');
            }
        }else{
            $nome = ucfirst(strtolower($nome));
            $senha = sha1($senha);

            $sql = 'UPDATE usuarios SET nome = "'.$nome.'", email = "'.$email.'", numero = "'.$numero.'", cpf_cnpj = "'.$cpf_cnpj.'", senha = "'.$senha.'" WHERE id_usuario = '.$id_usuario.';';

            $atualizar = mysqli_query($conexao,$sql);
            
            if($atualizar){
                echo('<script>window.alert("Atualizado com sucesso!");window.location="listar_usuarios.php";</script>'); 
            }
            else{
                echo('<script>window.alert("Falha ao atualizar!");window.location="listar_usuarios.php";</script>');
            }
        }
    }

?>
