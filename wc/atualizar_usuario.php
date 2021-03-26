<?php
    session_start();
    include ('conexao.php'); 
         
    if(isset($_POST['Atualizar'])){
        
        $_SESSION['id_usuario'];
        #$nome = $_POST['nome'];
        $email = htmlEntities($_POST['email']);
        $numero = htmlEntities($_POST['numero']);
        $senha = htmlEntities($_POST['senha']);

        $quantidade_numero_formatado = strlen($numero);
        #echo($quantidade_numero_formatado);
        if($quantidade_numero_formatado == 15){
            #com formatação, DDD
            $numero_formatado = str_split($numero);
            $numero = "$numero_formatado[1]$numero_formatado[2]$numero_formatado[3]$numero_formatado[5]$numero_formatado[6]$numero_formatado[7]$numero_formatado[8]$numero_formatado[10]$numero_formatado[11]$numero_formatado[12]$numero_formatado[13]$numero_formatado[14]";
            echo($numero.'<br>');
            $vetor = str_split($numero);
            #var_dump($vetor);
            $numero = "($vetor[0]$vetor[1]$vetor[2])$vetor[3]$vetor[4]$vetor[5]$vetor[6]-$vetor[7]$vetor[8]$vetor[9]$vetor[10]$vetor[11]";
            echo($numero);
        }elseif($quantidade_numero_formatado == 14){
            # com formatação, DD
            $numero_formatado = str_split($numero);
            $numero = "$numero_formatado[0]$numero_formatado[1]$numero_formatado[2]$numero_formatado[3]$numero_formatado[4]$numero_formatado[5]$numero_formatado[6]$numero_formatado[7]$numero_formatado[8]$numero_formatado[9]$numero_formatado[10]$numero_formatado[11]$numero_formatado[12]$numero_formatado[13]";
            #echo($numero.'<br>');
            #retirando a formatação 
            $vetor = str_split($numero);
            $numero = "($vetor[1]$vetor[2])$vetor[4]$vetor[5]$vetor[6]$vetor[7]-$vetor[9]$vetor[10]$vetor[11]$vetor[12]$vetor[13]";
            #echo($numero);
        }elseif($quantidade_numero_formatado == 11){
            #sem formatação, DD
            $numero_formatado = str_split($numero);
            $numero = "$numero_formatado[0]$numero_formatado[1]$numero_formatado[2]$numero_formatado[3]$numero_formatado[4]$numero_formatado[5]$numero_formatado[6]$numero_formatado[7]$numero_formatado[8]$numero_formatado[9]$numero_formatado[10]";
            #echo($numero.'<br>');
            # aplicando a formatação
            $numero = "($numero_formatado[0]$numero_formatado[1])$numero_formatado[2]$numero_formatado[3]$numero_formatado[4]$numero_formatado[5]-$numero_formatado[6]$numero_formatado[7]$numero_formatado[8]$numero_formatado[9]$numero_formatado[10]";
            #echo($numero);
        }elseif($quantidade_numero_formatado == 12){
            #sem formatação, DDD
            $numero_formatado = str_split($numero);
            $numero = "$numero_formatado[0]$numero_formatado[1]$numero_formatado[2]$numero_formatado[3]$numero_formatado[4]$numero_formatado[5]$numero_formatado[6]$numero_formatado[7]$numero_formatado[8]$numero_formatado[9]$numero_formatado[10]$numero_formatado[11]";
            #echo($numero.'<br>');
            #aplicando formatação
            $numero = "($numero_formatado[0]$numero_formatado[1]$numero_formatado[2])$numero_formatado[3]$numero_formatado[4]$numero_formatado[5]$numero_formatado[6]-$numero_formatado[7]$numero_formatado[8]$numero_formatado[9]$numero_formatado[10]$numero_formatado[11]";
            #echo($numero);
        }else{
            echo('<script>window.alert("Digite seu número por completo");window.location="perfil_usuario.php";</script>');
            exit;
        }
        #print_r($numero_formatado);
        
        if(strlen($senha) == 40){

            $sql = 'UPDATE usuarios SET numero = "'.$numero.'", email = "'.$email.'", senha = "'.$senha.'" WHERE id_usuario = '.$_SESSION['id_usuario'].';';

            $atualizar = mysqli_query($conexao,$sql);
            
            if($atualizar){
                echo('<script>window.alert("Atualizado com sucesso!");window.location="perfil_usuario.php";</script>'); 
            }
            else{
                echo('<script>window.alert("Falha ao atualizar!");window.location="perfil_usuario.php";</script>');
            }
            
        }else{
            $senha = sha1($senha);

            $sql = 'UPDATE usuarios SET email = "'.$email.'", numero = "'.$numero.'", senha = "'.$senha.'" WHERE id_usuario = '.$_SESSION['id_usuario'].';';

            $atualizar = mysqli_query($conexao,$sql);
            
            if($atualizar){
                echo('<script>window.alert("Atualizado com sucesso!");window.location="perfil_usuario.php";</script>'); 
            }
            else{
                echo('<script>window.alert("Falha ao atualizar!");window.location="perfil_usuario.php";</script>');
            }
        }
    }
?>
