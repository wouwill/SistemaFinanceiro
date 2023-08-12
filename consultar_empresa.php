<?php
    require_once './DAO/UtilDAO.php';
    UtilDAO::VerificarLogado();
    require_once './DAO/EmpresaDAO.php';

    $objDAO = new EmpresaDAO();
    $empresas = $objDAO->EmpresaConsultar();

    // // Este comando, testa o Array, revelando a posição de cada linha da Tabela, qual o Usuario Logado cadastrou
    // echo '<pre>';
    // print_r($empresas);
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
                    <h2>Consultar Empresas</h2>   
                    <h5>Consulte todas as suas Empresas aqui!</h5>
                    </div>
                </div>
                <hr/>
                <div class="row">
                <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Empresas Cadastradas. Caso deseja alterar, clique no Botão ALTERAR. 
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Nome da Empresa</th>
                                        <th>Telefone/Whatsapp</th>
                                        <th>Endereço</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for ($i=0; $i<count($empresas); $i++){ ?>
                                    <tr class="odd gradeX">
                                        <td><?= $empresas[$i]['nome_empresa']; ?></td>
                                        <td><?= $empresas[$i]['telefone_empresa']; ?></td>
                                        <td><?= $empresas[$i]['endereco_empresa']; ?></td>
                                        <td><a href="alterar_empresa.php?cod=<?= $empresas[$i]['id_empresa'] ?>" class="btn btn-warning">Alterar</a></td>
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