<?php
    require_once './DAO/UtilDAO.php';
    UtilDAO::VerificarLogado();
    require_once './DAO/EmpresaDAO.php';

    //Criou Objeto Global
    $objDAO = new EmpresaDAO();

    if(isset($_GET['cod']) && is_numeric($_GET['cod'])){
        $idEmpresa = $_GET['cod'];
        $dados = $objDAO->DetalharEmpresa($idEmpresa);

        //Se tem alguma coisa dentro do Array $dados
        if(count($dados) == 0){
            header('location: consultar_empresa.php');
            exit;
        }
    }else if(isset($_POST['btnSalvar'])) {
        $idEmpresa = $_POST['cod'];
        $nome = $_POST['nome'];
        $telefone = $_POST['telefone'];
        $endereco = $_POST['endereco'];

        // Obrigatorio que esteja na ordem que os parametros desta função, esteja esperando        
        $ret = $objDAO->EmpresaAlterar($nome, $telefone, $endereco, $idEmpresa);

        header('location: consultar_empresa.php?ret=' . $ret);
        exit;
    } else if (isset($_POST['btnExcluir'])) {
        $idEmpresa = $_POST['cod'];
        $ret = $objDAO->EmpresaExcluir($idEmpresa);

        header('location: consultar_empresa.php?ret=' . $ret);
        exit;
    }else{
        header('location: consultar_empresa.php');
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
                        <h2>Alterar Empresa</h2>
                        <h5>Aqui você podera ALTERAR ou EXCLUIR suas Empresas!</h5>
                    </div>
                </div>
                <hr />
                <form action="alterar_empresa.php" method="post">
                    <!-- Este input (Campo Oculto) valida, fixa o id_categoria na alteração, mesmo sendo violada na url -->
                    <input type="hidden" name="cod" value="<?= $dados[0]['id_empresa'] ?>">
                    <div class="form-group">
                        <label>Nome da Empresa:</label>
                        <input class="form-control" placeholder="Digite nome da Empresa..." name="nome" id="nomeempresa" value="<?= $dados[0]['nome_empresa'] ?>" maxlength="20"/>
                    </div>
                    <div class="form-group">
                        <label>Telefone/Whatsapp:</label>
                        <input class="form-control" placeholder="Digite Telefone/Whatsapp da Empresa..." name="telefone" id="telefone" value="<?= $dados[0]['telefone_empresa'] ?>" maxlength="12"/>
                    </div>
                    <div class="form-group">
                        <label>Endereço:</label>
                        <input class="form-control" placeholder="Digite Endereço da Empresa..." name="endereco" id="endereco" value="<?= $dados[0]['endereco_empresa'] ?>" maxlength="100"/>
                    </div>
                    <button type="submit" class="btn btn-success" name="btnSalvar" onclick="return ValidarEmpresa()">Salvar</button>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalExcluir">Excluir</button>
                    <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Confirmação de Exclusão!</h4>
                                </div>
                                <div class="modal-body">
                                    Deseja excluir a Empresa: <b><?= $dados[0]['nome_empresa'] ?>?</b>
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