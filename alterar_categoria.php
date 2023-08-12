<?php
    require_once './DAO/UtilDAO.php';
    UtilDAO::VerificarLogado();
    require_once './DAO/CategoriaDAO.php';

    //Criou Objeto Global
    $objDAO = new CategoriaDAO();

    if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {
        $idCategoria = $_GET['cod'];
        $dados = $objDAO->DetalharCategoria($idCategoria);

        //Se tem alguma coisa dentro do Array $dados
        if (count($dados) == 0) {
            header('location: consultar_categoria.php');
            exit;
        }
    } else if (isset($_POST['btnSalvar'])) {
        $idCategoria = $_POST['cod'];
        $nomecategoria = $_POST['nomecategoria'];

        // Obrigatorio que esteja na ordem que os parametros desta função, esteja esperando
        $ret = $objDAO->AlterarCategoria($nomecategoria, $idCategoria);

        header('location: consultar_categoria.php?ret=' . $ret);
        exit;
    } else if (isset($_POST['btnExcluir'])) {
        $idCategoria = $_POST['cod'];
        $ret = $objDAO->CategoriaExcluir($idCategoria);

        header('location: consultar_categoria.php?ret=' . $ret);
        exit;
    } else {
        header('location: consultar_categoria.php');
        exit;
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
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <?php include_once '_msg.php'; ?>
                        <h2>Alterar Categoria</h2>
                        <h5>Aqui você podera ALTERAR ou EXCLUIR suas Categorias!</h5>
                    </div>
                </div>
                <hr />
                <form action="alterar_categoria.php" method="post">
                    <!-- Este input (Campo Oculto) valida, fixa o id_categoria na alteração, mesmo sendo violada na url -->
                    <input type="hidden" name="cod" value="<?= $dados[0]['id_categoria'] ?>">
                    <div class="form-group">
                        <label>Nome da Categoria:</label>
                        <input class="form-control" placeholder="Nome da Categoria..." name="nomecategoria" id="nomecategoria" value="<?= $dados[0]['nome_categoria'] ?>" maxlength="35"/>
                    </div>
                    <button type="submit" class="btn btn-success" name="btnSalvar" onclick="return ValidarCategoria()">Salvar</button>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalExcluir">Excluir</button>
                    <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Confirmação de Exclusão!</h4>
                                </div>
                                <div class="modal-body">
                                    Deseja excluir a Categoria: <b><?= $dados[0]['nome_categoria'] ?>?</b>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" name="btnExcluir" class="btn btn-primary">Sim</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>