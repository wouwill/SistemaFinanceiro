<?php
require_once './DAO/UsuarioDAO.php';

$nome ='';
$email = '';
$senha = '';
$repsenha = '';

if(isset($_POST['btnCadastrar'])){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $repsenha = $_POST['repsenha'];

    $objDAO = new UsuarioDAO();
    $ret = $objDAO->CriarCadastro($nome, $email, $senha, $repsenha);
}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <?php
        include_once '_head.php';
    ?>
<body>
    <div class="container">
        <div class="row text-center  ">
            <div class="col-md-12">
                <br /><br />
                <?php include_once '_msg.php'; ?>
                <h2>Sistema Financeiro: Cadastro</h2>

                <h5>(Registre seu Cadastro aqui)</h5>
                <br />
            </div>
        </div>
        <div class="row">

            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>Novo usuário? Cadastre-se agora!</strong>
                    </div>
                    <div class="panel-body">
                        <form action="cadastro.php" method="post">
                            <br />
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-circle-o-notch"></i></span>
                                <input type="text" class="form-control" placeholder="Digite seu nome..." name="nome" id="usuarionome" maxlength="50"/>
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon">@</span>
                                <input type="text" class="form-control" placeholder="Digite seu E-mail..." name="email" id="usuarioemail" maxlength="50"/>
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" class="form-control" placeholder="Digite sua Senha (Mínimo 6 Caracteres)..." name="senha" id="senhausuario" maxlength="10"/>
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" class="form-control" placeholder="Digite novamente sua Senha..." name="repsenha" id="repsenhausuario" maxlength="10"/>
                            </div>

                            <button class="btn btn-primary" name="btnCadastrar" onclick="return ValidarCadastro()">Cadastrar</button>
                            <hr />
                            Já possui Cadastro? <a href="index.php">Clique aqui!</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>