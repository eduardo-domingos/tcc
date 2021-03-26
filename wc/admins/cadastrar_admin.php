<?php
    include('../conexao.php');

    if(isset($_POST['Cadastrar'])){

        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $nome = strtolower(trim($nome));
        $senha = sha1($senha);
        
        $sql = 'INSERT INTO admins(nome, email, senha) VALUES("'.$nome.'", "'.$email.'", "'.$senha.'");';
        $cadastrar = mysqli_query($conexao,$sql);

        if($cadastrar){
            echo('<script>window.alert("Cadastrado com sucesso!");window.location="painel_controle.php";</script>');
        }else{
            echo('<script>window.alert("Falha ao cadastrar usuário");window.location="cadastro_admin.php";</script>');
        }
    }
?>
