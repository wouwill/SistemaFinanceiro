<?php

    require_once 'Conexao.php';
    require_once 'UtilDAO.php';

    class ContaDAO extends Conexao{
        // 1ª FUNÇÃO - CADASTRAR
        public function ContaCadastrar($banco, $agencia, $numero, $saldo){
            if(trim($banco) == '' || trim($agencia) == '' || trim($numero) == '' || trim($saldo) == ''){
                return 0;
            }

            $conexao = parent::retornarConexao();

            $comando_sql = 'insert into tb_conta (banco_conta, agencia_conta, numero_conta, saldo_conta, id_usuario)
            values (?, ?, ?, ?, ?);';

            $sql = new PDOStatement();
            $sql = $conexao->prepare($comando_sql);

            $sql->bindValue(1, $banco);
            $sql->bindValue(2, $agencia);
            $sql->bindValue(3, $numero);
            $sql->bindValue(4, $saldo);
            $sql->bindValue(5, UtilDAO::CodigoLogado());

            try{
                $sql->execute();
                return 1;
            }catch(Exception $ex){
                echo $ex->getMessage();
                return -1;
            }
        }
        // 2ª FUNÇÃO - CONSULTAR
        public function ContaConsultar(){
            $conexao = parent::retornarConexao();

            $comando_sql = 'select id_conta, banco_conta, agencia_conta, numero_conta, saldo_conta from tb_conta where id_usuario = ? order by banco_conta ASC';

            $sql = new PDOStatement();

            $sql = $conexao->prepare($comando_sql);

            $sql->bindValue(1, UtilDAO::CodigoLogado());

            $sql->setFetchMode(PDO::FETCH_ASSOC);

            $sql->execute();

            return $sql->fetchAll();
        }
        // 3ª FUNÇÃO - DETALHAR
        public function DetalharConta($idConta){
            $conexao = parent::retornarConexao();

            $comando_sql = 'select id_conta, banco_conta, agencia_conta, numero_conta, saldo_conta from tb_conta where id_conta = ? and id_usuario = ?';

            $sql = new PDOStatement();
            $sql = $conexao->prepare($comando_sql);
            $sql->bindValue(1, $idConta);
            $sql->bindValue(2, UtilDAO::CodigoLogado());
            $sql->setFetchMode(PDO::FETCH_ASSOC);
            $sql->execute();
            return $sql->fetchAll();
        }
        // 4ª FUNÇÃO - ALTERAR
        public function ContaAlterar($banco, $agencia, $numero, $saldo, $idConta){
            if(trim($banco) == '' || trim($agencia) == '' || trim($numero) == '' || trim($saldo) == '' || $idConta == ''){
                return 0;
            }

            $conexao = parent::retornarConexao();
            $comando_sql = 'update tb_conta set banco_conta = ?,  agencia_conta = ?, numero_conta = ?, saldo_conta = ? where id_conta = ? and id_usuario = ?';
            $sql = new PDOStatement();
            $sql = $conexao->prepare($comando_sql);
            $sql->bindValue(1, $banco);
            $sql->bindValue(2, $agencia);
            $sql->bindValue(3, $numero);
            $sql->bindValue(4, $saldo);
            $sql->bindValue(5, $idConta);
            $sql->bindValue(6, UtilDAO::CodigoLogado());

            try{
                $sql->execute();
                return 1;
            }catch(Exception $ex){
                echo $ex->getMessage();
                return -1;
            }
        }
        // 5ª FUNÇÃO - EXCLUIR
        public function ContaExcluir($idConta){
            if($idConta == ''){
                return 0;
            }
            
            $conexao = parent::retornarConexao();
            $comando_sql = 'delete from tb_conta where id_conta = ? and id_usuario = ?';
            $sql = new PDOStatement();
            $sql = $conexao->prepare($comando_sql);
            $sql->bindValue(1, $idConta);
            $sql->bindValue(2, UtilDAO::CodigoLogado());

            try{
                $sql->execute();
                return 1;
            }catch(Exception $ex){
                return -4;
            }
        }   
    }
//Se os Campos não forem preenchidos corretamente, retorna 0
//Se os Campos cadastraram corretamente no Banco de Dados, retorna 1
//Se ocorreu algum erro na gravação no Banco de Dados, retornar -1