<?php
    
    include ('../conexao.php'); 
         
    if(isset($_POST['Atualizar'])){
        
        $id_admin = $_POST['id_admin'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        if(strlen($senha) == 40){
            $nome = ucfirst(strtolower($nome));

            $sql = 'UPDATE admins SET nome = "'.$nome.'", email = "'.$email.'" WHERE id_admin = '.$id_admin.';';
        
            $atualizar = mysqli_query($conexao,$sql);
            
            if($atualizar){
                echo('<script>window.alert("Atualizado com sucesso!");window.location="listar_admin.php";</script>'); 
            }
            else{
                echo('<script>window.alert("Falha ao atualizar!");window.location="listar_admin.php";</script>');
            }
        }else{

            $nome = ucfirst(strtolower($nome));
            $senha = sha1($senha);

            $sql = 'UPDATE admins SET nome = "'.$nome.'", email = "'.$email.'", senha = "'.$senha.'" WHERE id_admin = '.$id_admin.';';
            
            $atualizar = mysqli_query($conexao,$sql);
            
            if($atualizar){
                echo('<script>window.alert("Atualizado com sucesso!");window.location="listar_admin.php";</script>'); 
            }
            else{
                echo('<script>window.alert("Falha ao atualizar!");window.location="listar_admin.php";</script>');
            }
        }
    }

?>
