<?php
    require_once './DAO/UtilDAO.php';
    UtilDAO::VerificarLogado();
    require_once './DAO/EmpresaDAO.php';

    if (isset($_POST['btnGravar'])) {
        $nome = $_POST['nome'];
        $telefone = $_POST['telefone'];
        $endereco = $_POST['endereco'];

        $objDAO = new EmpresaDAO();
        $ret = $objDAO->EmpresaCadastrar($nome, $telefone, $endereco);
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
                        <?php include_once '_msg.php'; ?>
                        <h2>Nome da Empresa</h2>
                        <h5>Aqui você podera Cadastrar todos os nomes das Empresas.</h5>
                    </div>
                </div>
                <hr />
                <form action="nova_empresa.php" method="post">
                    <div class="form-group">
                        <label>Nome da Empresa:</label>
                        <input class="form-control" placeholder="Digite Nome da Empresa. Exemplo: Casas Bahia..." name="nome" id="nomeempresa" maxlength="20"/>
                    </div>
                    <div class="form-group">
                        <label>Telefone/Whatsapp:</label>
                        <input class="form-control" placeholder="Digite Telefone/Whatsapp da Empresa (Opcional!)." name="telefone" id="telefone" maxlength="12"/>
                    </div>
                    <div class="form-group">
                        <label>Endereço:</label>
                        <input class="form-control" placeholder="Digite Endereço da Empresa (Opcional!)." name="endereco" id="endereco" maxlength="100"/>
                    </div>
                    <button type="submit" class="btn btn-success" name="btnGravar" onclick="return ValidarEmpresa()">Gravar</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>