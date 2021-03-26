<?php
    include('conexao.php');

    if(isset($_POST['Cadastrar'])){

        $nome = htmlEntities($_POST['nome']);
        $email = htmlEntities($_POST['email']);
        $numero = htmlEntities($_POST['numero']);
        $cpf_cnpj = htmlEntities($_POST['cpf_cnpj']);
        $senha = htmlEntities($_POST['senha']);
        $flag = $_POST['flag'];

        if(is_numeric($numero) and is_numeric($cpf_cnpj)){

        }else{
            echo('<script>window.alert("Digite apenas números");window.location="cadastro_usuario.html";</script>');
            exit;
        }

        #formatando o número
        #DDD 9 (xxx) xxxx-xxxxx
        $quantidade_numero = strlen($numero);
        if($quantidade_numero == 11){
            $vetor = str_split($numero);
            #var_dump($vetor);
            $numero = "($vetor[0]$vetor[1])$vetor[2]$vetor[3]$vetor[4]$vetor[5]-$vetor[6]$vetor[7]$vetor[8]$vetor[9]$vetor[10]";
            #echo($numero.'<br>');
        }
        elseif($quantidade_numero < 11 ){
            echo('<script>window.alert("Digite seu número por completo");window.location="cadastro_usuario.html";</script>');
            exit;
        }else{
            $vetor = str_split($numero);
            $numero = "($vetor[0]$vetor[1]$vetor[2])$vetor[3]$vetor[4]$vetor[5]$vetor[6]-$vetor[7]$vetor[8]$vetor[9]$vetor[10]$vetor[11]";
            #echo($numero.'<br>');
        }

        #formatando cpf/cnpj
        #cpf XXX. XXX. XXX-XX
        #cnpj XX. XXX. XXX/XXXX-XX
        $quantidade_cpf_cnpj = strlen($cpf_cnpj);
        if($quantidade_cpf_cnpj == 14){
            $vetor2 = str_split($cpf_cnpj);
            $cpf_cnpj = "$vetor2[0]$vetor2[1].$vetor2[2]$vetor2[3]$vetor2[4].$vetor2[5]$vetor2[6]$vetor2[7]/$vetor2[8]$vetor2[9]$vetor2[10]$vetor2[11]-$vetor2[12]$vetor2[13]";
            #echo($cpf_cnpj);
        }
        elseif($quantidade_cpf_cnpj < 11 and $quantidade_cpf_cnpj <14){
            echo('<script>window.alert("Digite seu CPF/CNPJ por completo");window.location="cadastro_usuario.html";</script>');
            exit;
        }else{
            $vetor2 = str_split($cpf_cnpj);
            $cpf_cnpj = "$vetor2[0]$vetor2[1]$vetor2[2].$vetor2[3]$vetor2[4]$vetor2[5].$vetor2[6]$vetor2[7]$vetor2[8]-$vetor2[9]$vetor2[10]";
            #echo($cpf_cnpj);
        }
        
        $nome = strtolower(trim($nome));
        $senha = sha1($senha);

        $sql = 'INSERT INTO usuarios(nome, email, numero, cpf_cnpj, flag, senha) VALUES("'.$nome.'", "'.$email.'", "'.$numero.'", "'.$cpf_cnpj.'", "'.$flag.'", "'.$senha.'");';
        #echo($sql);
        $cadastrar = mysqli_query($conexao,$sql);
        
        if($cadastrar){
            echo('<script>window.alert("Cadastrado com sucesso!");window.location="login_usuario.html";</script>');
        }else{
            echo('<script>window.alert("Falha ao cadastrar usuário");window.location="cadastro_usuario.html";</script>');
        }
        
    }
?>
