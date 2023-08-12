<?php
    require_once './DAO/UtilDAO.php';
    UtilDAO::VerificarLogado();
    require_once './DAO/ContaDAO.php';

    $objDAO = new ContaDAO();
    $contas = $objDAO->ContaConsultar();

    // // Este comando, testa o Array, revelando a posição de cada linha da Tabela, qual o Usuario Logado cadastrou
    // echo '<pre>';
    // print_r($contas);
    // echo '</pre>'    
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
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                    <?php include_once '_msg.php'; ?>                    
                    <h2>Consultar Contas</h2>   
                    <h5>Consulte todas as suas Contas Bancárias aqui!</h5>
                    </div>
                </div>
                <hr/>
                <div class="row">
                <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Contas Bancárias Cadastradas. Caso deseja alterar, clique no Botão ALTERAR. 
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Nome do Banco</th>
                                        <th>Agência</th>
                                        <th>Número da Conta</th>
                                        <th>Saldo</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Exemplo de utilização do Laço de Repetição foreach -->
                                    <?php foreach($contas as $item){ ?>
                                    <tr class="odd gradeX">
                                        <td><?= $item['banco_conta']; ?></td>
                                        <td><?= $item['agencia_conta']; ?></td>
                                        <td><?= $item['numero_conta']; ?></td>
                                        <td>R$ <?= $item['saldo_conta']; ?></td>
                                        <td><a href="alterar_conta.php?cod=<?= $item['id_conta'] ?>" class="btn btn-warning">Alterar</a></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                </div>
                </div>
            </div>
        </div>
    </div> 
</body>
</html>