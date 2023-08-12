<!-- if($ret == 0){
        echo '<div class="alert alert-warning">
        Preencher o(s) campo(s) obrigatório(s)!
        </div>';
    }else if($ret == 1){
        echo '<div class="alert alert-success">
        Ação realizada com Sucesso!
        </div>';
    }else if($ret == -1){
        echo '<div class="alert alert-danger">
        Ocorreu um erro na operação. tente mais tarde!
        </div>';
    } -->

<?php

    require_once './DAO/UtilDAO.php';
    UtilDAO::VerificarLogado();
    require_once './DAO/UsuarioDAO.php';

    $objDAO = new UsuarioDAO();

    if(isset($_POST['btnGravar'])){
        $nome = $_POST['nome'];
        $email = $_POST['email'];
 
        $ret = $objDAO->GravarMeusDados($nome, $email);
    }
    $dados = $objDAO->CarregarMeusDados();

    // echo '<pre>';
    // print_r($dados);
    // echo '</pre>';    
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <?php
        include_once '_head.php';
    ?>
<body>
    <div id="wrapper">
        <!--Includes que buscam leitura dos arquivos TOPO e MENU-->
        <?php
            include_once '_topo.php';
            include_once '_menu.php';
        ?>
        <!--Conteudo visto pelo usuário-->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <?php include_once '_msg.php'; ?>
                        <h2>Meus Dados</h2>
                        <h5>Seja Bem Vindo Alisson Rocha, amamos vê-lo por aqui.</h5>
                    </div>
                </div>
                <hr/>
                <form action="meus_dados.php" method="post">
                    <div class="form-group">
                        <label>Nome:</label>
                        <input class="form-control" placeholder="Digite seu Nome..." name="nome" id="nome" value="<?= $dados[0]['nome_usuario'] ?>" maxlength="50"/>
                    </div>
                    <div class="form-group">
                        <label>E-mail:</label>
                        <input class="form-control" placeholder="Digite seu E-mail..." name="email" id="email" value="<?= $dados[0]['email_usuario'] ?>" maxlength="50"/>
                    </div>
                    <button type="submit" class="btn btn-success" name="btnGravar" onclick="return ValidarMeusDados()">Gravar</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>