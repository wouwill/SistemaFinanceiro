<?php
    require_once './DAO/UtilDAO.php';
    UtilDAO::VerificarLogado();
    require_once './DAO/ContaDAO.php';

    //Criou Objeto Global
    $objDAO = new ContaDAO();

    if(isset($_GET['cod']) && is_numeric($_GET['cod'])){
        $idConta = $_GET['cod'];
        $dados = $objDAO->DetalharConta($idConta);

        //Se tem alguma coisa dentro do Array $dados
        if(count($dados) == 0){
            header('location: consultar_conta.php');
            exit;
        }
    }else if(isset($_POST['btnSalvar'])) {
        $idConta = $_POST['cod'];
        $banco = $_POST['nome_banco'];
        $agencia = $_POST['agencia'];
        $numero = $_POST['num_conta'];
        $saldo = $_POST['saldo'];

        $ret = $objDAO->ContaAlterar($banco, $agencia, $numero, $saldo, $idConta);

        header('location: consultar_conta.php?ret=' . $ret);
        exit;
    } else if (isset($_POST['btnExcluir'])) {
        $idConta = $_POST['cod'];
        $ret = $objDAO->ContaExcluir($idConta);

        header('location: consultar_conta.php?ret=' . $ret);
        exit;
    }else{
        header('location: consultar_conta.php');
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
                        <h2>Alterar Contas</h2>
                        <h5>Aqui você podera ALTERAR ou EXCLUIR suas Contas Bancárias!</h5>
                    </div>
                </div>
                <hr />
                <form action="alterar_conta.php" method="post">
                    <!-- Este input (Campo Oculto) valida, fixa o id_categoria na alteração, mesmo sendo violada na url -->
                    <input type="hidden" name="cod" value="<?= $dados[0]['id_conta'] ?>">                
                    <div class="form-group">
                        <label>Nome do Banco:</label>
                        <input class="form-control" placeholder="Digite nome do Banco..." name="nome_banco" id="nomebanco" value="<?= $dados[0]['banco_conta'] ?>" maxlength="20"/>
                    </div>
                    <div class="form-group">
                        <label>Agência:</label>
                        <input class="form-control" placeholder="Digite Agência..." name="agencia" id="agencia" value="<?= $dados[0]['agencia_conta'] ?>" maxlength="8"/>
                    </div>
                    <div class="form-group">
                        <label>Número da Conta:</label>
                        <input class="form-control" placeholder="Digite Número da Conta..." name="num_conta" id="num_conta" value="<?= $dados[0]['numero_conta'] ?>" maxlength="12"/>
                    </div>
                    <div class="form-group">
                        <label>Saldo:</label>
                        <input class="form-control" placeholder="Digite Saldo..." name="saldo" id="saldo" value="<?= $dados[0]['saldo_conta'] ?>" maxlength="10000000000"/>
                    </div>
                    <button type="submit" class="btn btn-success" name="btnSalvar" onclick="return ValidarConta()">Salvar</button>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalExcluir">Excluir</button>
                    <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Confirmação de Exclusão!</h4>
                                </div>
                                <div class="modal-body">
                                    Deseja excluir a Conta: <b><?= $dados[0]['banco_conta'] ?>?</b>
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