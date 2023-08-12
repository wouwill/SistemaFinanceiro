<?php

    require_once 'Conexao.php';
    require_once 'UtilDAO.php';

    class MovimentoDAO extends Conexao{
        // 1ª FUNÇÃO - REALIZAR MOVIMENTO
        public function RealizarMovimento($tipo, $data, $valor, $categoria, $empresa, $conta, $mensagem){
            if($tipo == '' || trim($data) == '' || trim($valor) == '' || $categoria == '' || $empresa == ''  || $conta == ''){
                return 0;
            }
                $conexao = parent::retornarConexao();
                $comando_sql = 'insert into tb_movimento
                                (tipo_movimento, 
                                data_movimento, 
                                valor_movimento, 
                                obs_movimento, 
                                id_empresa, 
                                id_conta, 
                                id_categoria, 
                                id_usuario)
                                values(?,?,?,?,?,?,?,?)';
                $sql = new PDOStatement();
                $sql = $conexao->prepare($comando_sql);

                $sql->bindValue(1, $tipo);
                $sql->bindValue(2, $data);
                $sql->bindValue(3, $valor);
                $sql->bindValue(4, $mensagem);
                $sql->bindValue(5, $empresa);
                $sql->bindValue(6, $conta);
                $sql->bindValue(7, $categoria);
                $sql->bindValue(8, UtilDAO::CodigoLogado());

                $conexao->beginTransaction();

                try{
                    //Inserção na tb_movimento
                    $sql->execute();

                    if($tipo == 1){
                        $comando_sql = 'update tb_conta set saldo_conta = saldo_conta + ? where id_conta = ?';
                    }else if($tipo == 2){
                        $comando_sql = 'update tb_conta set saldo_conta = saldo_conta - ? where id_conta = ?';
                    }

                    $sql = $conexao->prepare($comando_sql);
                    $sql->bindValue(1, $valor);
                    $sql->bindValue(2, $conta);

                    // Atualizar o Saldo da Conta
                    $sql->execute();

                    $conexao->commit();
                    return 1;
                }catch(Exception $ex){
                    echo $ex->getMessage();
                    $conexao->rollBack();
                    return -1;
                }
        }
        // 2ª FUNÇÃO - FILTRAR MOVIMENTO        
        public function FiltrarMovimento($tipomovi, $datainicial, $datafinal){
            if(trim($datainicial) == '' || trim($datafinal) == ''){
                return 0;
            }

            $conexao = parent::retornarConexao();
            $comando_sql = 'select id_movimento,
                            tb_movimento.id_conta,
                            tipo_movimento, 
                            date_format(data_movimento, "%d/%m/%Y") as data_movimento,
                            valor_movimento, 
                            nome_categoria, 
                            nome_empresa, 
                            banco_conta, 
                            numero_conta, 
                            agencia_conta, 
                            obs_movimento
                            from tb_movimento
                            inner join tb_categoria
                                on tb_categoria.id_categoria = tb_movimento.id_categoria
                            inner join tb_empresa
                                on tb_empresa.id_empresa = tb_movimento.id_empresa
                            inner join tb_conta
                                on tb_conta.id_conta = tb_movimento.id_conta
                                where tb_movimento.id_usuario = ?
                                and tb_movimento.data_movimento between ? and ?';
            
            if($tipomovi != 0){
                $comando_sql = $comando_sql . ' and tipo_movimento = ?';
            }

            $sql = new PDOStatement();
            $sql = $conexao->prepare($comando_sql);

            $sql->bindValue(1, UtilDAO::CodigoLogado());
            $sql->bindValue(2, $datainicial);
            $sql->bindValue(3, $datafinal);

            if($tipomovi != 0){
                $sql->bindValue(4, $tipomovi);
            }

            $sql->setFetchMode(PDO::FETCH_ASSOC);
            $sql->execute();
            return $sql->fetchAll();
        }
        // 3ª FUNÇÃO - EXCLUIR MOVIMENTO   
        public function MovimentoExcluir($idMovimento, $idConta, $tipo, $valor){
            if($idMovimento == '' || $idConta == '' || $tipo == '' || $valor == ''){
                return 0;
            }
            $conexao = parent::retornarConexao();
            $comando_sql = 'delete from tb_movimento where id_movimento = ?';
            $sql = new PDOStatement();
            $sql = $conexao->prepare($comando_sql);
            $sql->bindValue(1, $idMovimento);

            $conexao->beginTransaction();

            try{
                //Deleta o registro
                $sql->execute();
                
                if($tipo == 1){
                    // Foi deletado uma entrada, então o valor é retornado ao Saldo da Conta
                    $comando_sql = 'update tb_conta set saldo_conta = saldo_conta - ? where id_conta = ?';
                }else if($tipo == 2){
                    // Foi deletado uma saida, então o valor é retornado ao Saldo da Conta                    
                    $comando_sql = 'update tb_conta set saldo_conta = saldo_conta + ? where id_conta = ?';
                }
                $sql = $conexao->prepare($comando_sql);
                $sql->bindValue(1, $valor);
                $sql->bindValue(2, $idConta);

                //Atuaiza o Saldo
                $sql->execute();
                $conexao->commit();
                return 1;
            }catch(Exception $ex){
                $conexao->rollBack();
                echo $ex->getMessage();
                return -1;
            }
        }
        
        public function TotalEntrada(){
            $conexao = parent::retornarConexao();
            $comando_sql = 'select sum(valor_movimento) as Total from tb_movimento where tipo_movimento = 1 and id_usuario = ?;';
            $sql = new PDOStatement();
            $sql = $conexao->prepare($comando_sql);

            $sql->bindValue(1, UtilDAO::CodigoLogado());
            $sql->setFetchMode(PDO::FETCH_ASSOC);
            $sql->execute();

            return $sql->fetchAll();
        }

        public function TotalSaida(){
            $conexao = parent::retornarConexao();
            $comando_sql = 'select sum(valor_movimento) as Total from tb_movimento where tipo_movimento = 2 and id_usuario = ?;';
            $sql = new PDOStatement();
            $sql = $conexao->prepare($comando_sql);

            $sql->bindValue(1, UtilDAO::CodigoLogado());
            $sql->setFetchMode(PDO::FETCH_ASSOC);
            $sql->execute();

            return $sql->fetchAll();
        }
        
        public function MostrarUltimosLancamentos(){
            $conexao = parent::retornarConexao();
            $comando_sql = 'select id_movimento,
                            tb_movimento.id_conta,
                            tipo_movimento, 
                            date_format(data_movimento, "%d/%m/%Y") as data_movimento,
                            valor_movimento, 
                            nome_categoria, 
                            nome_empresa, 
                            banco_conta, 
                            numero_conta, 
                            agencia_conta, 
                            obs_movimento
                            from tb_movimento
                            inner join tb_categoria
                                on tb_categoria.id_categoria = tb_movimento.id_categoria
                            inner join tb_empresa
                                on tb_empresa.id_empresa = tb_movimento.id_empresa
                            inner join tb_conta
                                on tb_conta.id_conta = tb_movimento.id_conta
                                where tb_movimento.id_usuario = ?
                                order by tb_movimento.id_movimento DESC limit 10';
            
            $sql = new PDOStatement();
            $sql = $conexao->prepare($comando_sql);

            $sql->bindValue(1, UtilDAO::CodigoLogado());
            $sql->setFetchMode(PDO::FETCH_ASSOC);
            $sql->execute();
            return $sql->fetchAll();
        }        
    }
//Se os Campos não forem preenchidos corretamente, retorna 0
//Se os Campos cadastraram corretamente no Banco de Dados, retorna 1
//Se ocorreu algum erro na gravação no Banco de Dados, retornar -1
























//Se os Campos não forem preenchidos corretamente, retorna 0
//Se os Campos cadastraram corretamente no Banco de Dados, retorna 1
//Se ocorreu algum erro na gravação no Banco de Dados, retornar -1