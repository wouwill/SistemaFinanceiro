<?php
    require_once './DAO/UtilDAO.php';
    UtilDAO::VerificarLogado();
    require_once './DAO/ContaDAO.php';

    if (isset($_POST['btnGravar'])) {
        $banco = $_POST['nome_banco'];
        $agencia = $_POST['agencia'];
        $numero = $_POST['num_conta'];
        $saldo = $_POST['saldo'];

        $objDAO = new ContaDAO();
        $ret = $objDAO->ContaCadastrar($banco, $agencia, $numero, $saldo);
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
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <?php require_once '_msg.php'; ?>
                        <h2>Nova Conta</h2>
                        <h5>Aqui você podera Cadastrar todas as suas Contas Bancárias.</h5>
                    </div>
                </div>
                <hr />
                <form action="nova_conta.php" method="post">
                    <div class="form-group">
                        <label>Nome do Banco:</label>
                        <input class="form-control" placeholder="Digite nome do Banco..." name="nome_banco" id="nomebanco" maxlength="20"/>
                    </div>
                    <div class="form-group">
                        <label>Agência:</label>
                        <input class="form-control" placeholder="Digite Agência..." name="agencia" id="agencia" maxlength="8"/>
                    </div>
                    <div class="form-group">
                        <label>Número da Conta:</label>
                        <input class="form-control" placeholder="Digite Número da Conta..." name="num_conta" id="num_conta" maxlength="12"/>
                    </div>
                    <div class="form-group">
                        <label>Saldo:</label>
                        <input class="form-control" placeholder="Digite Saldo da Conta..." name="saldo" id="saldo" maxlength="10000000000"/>
                    </div>
                    <button type="submit" class="btn btn-success" name="btnGravar" onclick="return ValidarConta()">Gravar</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>