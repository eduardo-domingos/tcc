<?php
        
    include ('../conexao.php');
    $id_financiamento = $_GET['id_financiamento'];

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Editar Financiamentos</title>
        <!-- CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="../css/estilo.css" rel="stylesheet">
        </style>
    </head>
    
    <body>

        <!--Formulário-->
        <section class="container" id="tela_cadastro">
            <section style="text-align: right" class="botao_voltar">
                <a href="listar_financiamento.php" role="button" class="btn btn-sm btn-primary">Voltar</a>
            </section>
            <h4>Formulário de Edição</h4>
                
                <?php
                    $sql = 'SELECT * FROM financiamentos WHERE id_financiamento = '.$id_financiamento.';';
                    
                    $buscar = mysqli_query($conexao,$sql);
                    
            
                    while($controle = mysqli_fetch_array($buscar)){
                        
                        $id_projeto = $controle['id_projeto'];
                        $id_usuario = $controle['id_usuario'];
                        $id_financiamento = $controle['id_financiamento'];
                        $financiar = $controle['financiar'];
                        $quantidade_vezes = $controle['quantidade_vezes'];
                        $data = $controle['data_financ'];
                        
                ?>
            
            <form name="cadastro_usuario" action="atualizar_financiamento.php" method="POST">
                <section class="form-row">
                    <section class="col">
                        <section class="form-group">
                            <label>Id Financiamento</label><br>
                            <input name="id_financiamento" value="<?php echo($id_financiamento); ?>" readonly>
                        </section>
                    </section>
                </section>
                <section class="form-row">
                    <section class="col">
                        <section class="form-group">
                            <label>Id Projeto</label><br>
                            <input name="id_projeto" value="<?php echo($id_projeto); ?>" readonly>
                        </section>
                    </section>
                </section>
                <section class="form-row">
                    <section class="col">
                        <section class="form-group">
                            <label>Id Usuario</label><br>
                            <input name="id_usuario" value="<?php echo($id_usuario); ?>" readonly>
                        </section>
                    </section>
                </section>
                <section class="form-row">
                    <section class="col">
                        <section class="form-group">
                            <label>Financiar</label>
                            <input class="form-control" name="financiar" value="<?php echo($financiar); ?>">
                        </section>
                    </section>
                </section>
                <section class="form-row">
                    <section class="col">
                        <section class="form-group">
                            <label>Quantidade</label>
                            <input class="form-control" name="quantidade_vezes" value="<?php echo($quantidade_vezes); ?>">
                        </section>
                    </section>
                </section>
                <section class="form-row">
                    <section class="col">
                            <section class="form-group">
                                <label>Data</label>
                                <input type="date"  name="data_financ" value="<?php echo($data); ?>" class="form-control" autocomplete="off" required>
                            </section>
                        </section>
                    </section>
                        <section class="botao_cadastrar">
                                <button name="Atualizar" value="Atualizar" type="submit" class="btn btn-sm btn-primary">Atualizar</button>
                        </section>
                </section>
            </form>
        </section>
        <?php } ?>

        <footer>
            <!-- JS -->
            <script src="../js/bootstrap.bundle.min.js"></script>
            <script src="../js/jquery-3.5.1.min.js"></script>
        </footer>
    </body>
</html>