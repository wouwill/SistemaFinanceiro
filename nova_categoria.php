<?php
    require_once './DAO/UtilDAO.php';
    UtilDAO::VerificarLogado();
    require_once './DAO/CategoriaDAO.php';

    if(isset($_POST['btnGravar'])){
        $nome = $_POST['nome_categoria'];

        $objDAO = new CategoriaDAO();
        $ret = $objDAO->CategoriaCadastrar($nome);
    }
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <?php
        include_once '_head.php';
    ?>
<body>
    <div id="wrapper">
        <?php
            include_once '_topo.php';
            include_once '_menu.php';
        ?>
        <!--Conteudo visto pelo usuário-->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                    <?php include_once '_msg.php'; ?>
                    <h2>Nova Categoria</h2>   
                        <h5>Aqui você podera Cadastrar todas as suas Categorias!</h5>
                    </div>
                </div>
                <hr/>
                <form action="nova_categoria.php" method="post">
                    <div class="form-group" id="divNome">
                        <label>Nome da Categoria:</label>
                        <input class="form-control" placeholder="Digite Nome da Categoria. Exemplo: Conta de Internet..." name="nome_categoria" id="nomecategoria" onchange="ValidarCampo()" maxlength="35"/>
                    </div>
                    <button type="submit" class="btn btn-success" name="btnGravar" onclick="return ValidarCategoria()">Gravar</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>