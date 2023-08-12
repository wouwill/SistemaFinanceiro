<?php

    // Formatando os numeros com casas decimais
    // $numero = 100;
    // Uma função nativa apra tratar números
    // echo number_format($numero, 2, ',', '.');
    require_once './DAO/UtilDAO.php';
    UtilDAO::VerificarLogado();    
    require_once './DAO/MovimentoDAO.php';

        // Variáveis Globais
        $tipomovi = '';
        $datainicial = '';
        $datafinal = '';

    if(isset($_POST['btnPesquisar'])){
        $tipomovi = $_POST['tipomov'];
        $datainicial = $_POST['dataini'];
        $datafinal = $_POST['datafinal'];

        $objDAO = new MovimentoDAO();
        $movs = $objDAO->FiltrarMovimento($tipomovi, $datainicial, $datafinal);
    }else if(isset($_POST['btnExcluir'])){
        $idMov = $_POST['idMov'];
        $idConta = $_POST['idConta'];
        $tipo = $_POST['tipo'];
        $valor = $_POST['valor'];

        $objDAO = new MovimentoDAO();
        $ret = $objDAO->MovimentoExcluir($idMov, $idConta, $tipo, $valor);
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
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                    <?php include_once '_msg.php'; ?>
                    <h2>Consultar Movimentos</h2>   
                    <h5>Consulte todos os Movimentos em um determinado período!</h5>
                    </div>
                </div>
                <hr/>
                <form action="consultar_movimento.php" method="post">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Tipo do Movimento:</label>
                            <select class="form-control" name="tipomov" id="tipomov">
                                <!-- Tratamento das OPTIONS: A condição é, se for verdadeiro marca, se não não! -->
                                <option value="0" <?= $tipomovi == '0' ? 'selected' : '' ?>>Todos</option>
                                <option value="1" <?= $tipomovi == '1' ? 'selected' : '' ?>>Entrada</option>
                                <option value="2" <?= $tipomovi == '2' ? 'selected' : '' ?>>Saida</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Data Inicial:</label>
                            <input type="date" class="form-control" placeholder="Digite Data do Movimento realizado..." name="dataini" id="dataini" value="<?= $datainicial ?>"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Data Final:</label>
                            <input type="date" class="form-control" placeholder="Digite Data do Movimento realizado..." name="datafinal" id="datafinal" value="<?= $datafinal ?>"/>
                        </div>
                    </div>
                    <center>
                        <button class="btn btn-info" name="btnPesquisar" onclick="return ConsultarMovimento()">Pesquisar</button>
                    </center>
                </form>
                <hr>
                <?php if(isset($movs)){ ?>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Advanced Tables -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Resultado de Movimentos encontrados foi:
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>Data</th>
                                                    <th>Tipo</th>
                                                    <th>Categoria</th>
                                                    <th>Empresa</th>
                                                    <th>Conta</th>
                                                    <th>Valor</th>
                                                    <th>Observação</th>
                                                    <th>Ação</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                                // O Motivo da Variável TOTAL, é somar todos os valores encontrados pelo ARRAY MOVS
                                                // Desta forma ele sempre ira somar os valores adicionadaos em cada posição do ARRAY
                                                $total = 0;
                                                for($i=0; $i<count($movs); $i++){ 
                                                    if($movs[$i]['tipo_movimento'] == 1){
                                                        $total = $total + $movs[$i]['valor_movimento'];
                                                    }else{
                                                        $total = $total - $movs[$i]['valor_movimento'];
                                                    }
                                            ?>
                                                <tr class="odd gradeX">
                                                    <th><?= $movs[$i]['data_movimento'] ?></th>
                                                    <th><?= $movs[$i]['tipo_movimento'] == 1 ? 'Entrada' : 'Saída' ?></th>
                                                    <th><?= $movs[$i]['nome_categoria'] ?></th>
                                                    <th><?= $movs[$i]['nome_empresa'] ?></th>
                                                    <th><?= $movs[$i]['banco_conta'] ?> / <?= $movs[$i]['agencia_conta'] ?> - <?= $movs[$i]['numero_conta'] ?></th>
                                                    <th>R$ <?= number_format($movs[$i]['valor_movimento'], 2, ',', '.') ?></th>
                                                    <th><?= $movs[$i]['obs_movimento'] ?></th>
                                                    <td>
                                                        <!-- O motivo da $i estar dentro das tags do Modal é para que seja renderizado o Modal para cada Linha da TB Consultar -->
                                                        <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#modalExcluir<?= $i ?>">Excluir</a>
                                                        <form action="consultar_movimento.php" method="POST">
                                                            <!-- Aqui será os inputs oculto, para armazenar os dados do Movimento -->
                                                            <input type="hidden" name="idMov" value="<?= $movs[$i]['id_movimento'] ?>">
                                                            <input type="hidden" name="idConta" value="<?= $movs[$i]['id_conta'] ?>">
                                                            <input type="hidden" name="tipo" value="<?= $movs[$i]['tipo_movimento'] ?>">
                                                            <input type="hidden" name="valor" value="<?= $movs[$i]['valor_movimento'] ?>">
                                                            <!-- FIM -->
                                                            <div class="modal fade" id="modalExcluir<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                            <h4 class="modal-title" id="myModalLabel">Confirmação de Exclusão!</h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <center>
                                                                                <b>Deseja excluir o Movimento: </b>
                                                                            </center>
                                                                            <p>
                                                                                <b>Data do Movimento: </b><?= $movs[$i]['data_movimento'] ?>?
                                                                                <br>
                                                                                <b>Tipo do Movimento: </b><?= $movs[$i]['tipo_movimento'] == 1 ? 'Entrada' : 'Saída' ?>?
                                                                                <br>
                                                                                <b>Categoria: </b><?= $movs[$i]['nome_categoria'] ?>?
                                                                                <br>
                                                                                <b>Empresa: </b><?= $movs[$i]['nome_empresa'] ?>?
                                                                                <br>
                                                                                <b>Conta: </b><?= $movs[$i]['banco_conta'] ?> / <?= $movs[$i]['agencia_conta'] ?> - <?= $movs[$i]['numero_conta'] ?>?
                                                                                <br>
                                                                                <b>Valor: R$ </b><?= number_format($movs[$i]['valor_movimento'], 2, ',', '.') ?>
                                                                            </p>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                                            <button type="submit" name="btnExcluir" class="btn btn-primary">Sim</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                        <center>
                                            <label style="color: <?= $total < 0 ? 'red' : 'green' ?>;"><b>TOTAL: </b>R$ <?= number_format($total, 2, ',', '.'); ?></label>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div> 
</body>
</html>