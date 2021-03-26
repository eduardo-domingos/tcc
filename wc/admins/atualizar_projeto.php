<?php
    session_start();
    include('../conexao.php');

    if(isset($_POST['Atualizar'])){

        $id_usuario = $_POST['id_usuario'];
        $id_projeto = $_POST['id_projeto'];
        $titulo = htmlEntities($_POST['titulo']);
        $equipe = htmlEntities($_POST['equipe']);
        $resumo = htmlEntities($_POST['resumo']);
        $caracteristicas = htmlEntities($_POST['caracteristicas']);
        $localidade = htmlEntities($_POST['localidade']);
        $data = htmlEntities($_POST['data_inicio']);
        $video = htmlEntities($_POST["url"]);
        $valor = htmlEntities($_POST['valor']);
        $imagem = $_FILES['foto'];

        $converter_numero = str_split($valor);
        $converter_numero = array_reverse($converter_numero);
        #print_r($converter_numero);
        #print_r($converter_numero[2].'<br><br>');
        if($converter_numero[2] == ","){
            $converter_numero = explode(",",$valor);
            #var_dump($converter_numero);
            $valor = $converter_numero[0].'.'.$converter_numero[1];
            #echo($valor);
        }else{
            #echo($valor.'<br>');
        }
        
        # verificando imagem
        if(!empty($imagem['name'])){
            
            $largura = 4800;
            $altura = 4800;
            $tamanho = 2048000; #2MB

            $error = array();
            
            if(!preg_match("/^image\/(jpg|jpeg|gif|bmp|png)$/",$imagem["type"])){
                $error[0] = 'Não é uma imagem!';
            }

            $dimensoes =  getimagesize($imagem["tmp_name"]);

            if($dimensoes[0] > $largura){
                $error[1] = 'A largura da imagem não pode ultrapassar '.$largura.' pixel';
            }

            if($dimensoes[1] > $altura){
                $error[2] = 'A altura da imagem não pode ultrapassar '.$altura.' pixel';
            }

            if($imagem['size'] > $tamanho){
                $error[3] = 'O tamanho da imagem não pode ultrapassar '.$tamanho.' bytes';
            }

            if(count($error) == 0){

                preg_match("/\.(jpg|jpeg|bmp|png|gif){1}$/i", $imagem["name"], $ext);

                #pega o tempo atual e o converte para segundo o torando indentificador da img
                $nome_imagem = md5(uniqid(time())).'.'.$ext[1];

                $caminho_imagem = "../img_projetos/".$nome_imagem;

            }
            
            $totalerro = "";
            
            if(count($error) != 0 ){
                for($cont = 0; $cont <= sizeof($error); $cont++){
                    if(!empty($error[$cont])) $totalerro = $totalerro . $error[$cont] . '\n';
                }

                echo('<script>window.alert("'.$totalerro.'");window.location="criar_projeto.php";</script>');   
            }
    
            $sql = 'SELECT id_usuario,imagem FROM projetos WHERE id_projeto = '.$id_projeto.' AND id_usuario = '.$id_usuario.';';

            $busca = mysqli_query($conexao,$sql);
    
            while($controle = mysqli_fetch_array($busca)){
    
                $imagem_antiga = $controle['imagem'];
            }

            unlink('../img_projetos/'.$imagem_antiga);
            
        }else{

            $sql = 'SELECT id_usuario,imagem FROM projetos WHERE id_projeto = '.$id_projeto.' AND id_usuario = '.$id_usuario.';';

            $busca = mysqli_query($conexao,$sql);
    
            while($controle = mysqli_fetch_array($busca)){
    
                $imagem_antiga = $controle['imagem'];
            }
            
            $nome_imagem = $imagem_antiga;
            #echo('<script>window.alert("Nenhuma imagem selecionada!");window.location="criar_projeto.php";</script>');
        }

        # verificando cod video
        if(!empty($video)){
            $cdvideo = explode("=",$video);
            $youtube = explode(".",$cdvideo[0]);
            if($youtube[1]=="youtube"){
                if(isset($cdvideo[2])){	
                    $valor = explode("&",$cdvideo[1]);
                    $etec = $valor[0];
                }else{
                    $etec = $cdvideo[1];
                }	
            }else{
                echo ('<script>window.alert("URL inválida!");window.location="listar_projetos.php";</script>');
            }
        }else{
            #echo ('<script>window.alert("Você não inseriu nehuma URL!");window.location="projetos.php";</script>');
        }
        
        $sql = 'UPDATE projetos SET titulo = "'.$titulo.'", equipe = "'.$equipe.'", resumo = "'.$resumo.'", caracteristicas = "'.$caracteristicas.'", localidade = "'.$localidade.'", data_inicio = "'.$data.'", video = "'.$video.'", imagem = "'.$nome_imagem.'", valor = "'.$valor.'" WHERE id_usuario = '.$id_usuario.' AND id_projeto = '.$id_projeto.';';

        $atualizar = mysqli_query($conexao,$sql);
       
        #echo($sql);
        # inserindo dados no banco
        
        if($atualizar){
            echo('<script>window.alert("Projeto atualizado com sucesso!");window.location="listar_projetos.php";</script>');
            if(!empty($imagem['name'])){
                move_uploaded_file($imagem["tmp_name"], $caminho_imagem);
            }
        }else{
            echo('<script>window.alert("Falha ao atualizar projeto!");window.location="listar_projetos.php";</script>');
        }
       
    }
?>

