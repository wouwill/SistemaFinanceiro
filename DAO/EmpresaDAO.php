<?php

    require_once 'Conexao.php';
    require_once 'UtilDAO.php';

    class EmpresaDAO extends Conexao{
        // 1ª FUNÇÃO - CADASTRAR
        public function EmpresaCadastrar($nome, $telefone, $endereco){
            if(trim($nome) == '' || trim($telefone) == '' || trim($endereco) == ''){
                return 0;
            }

            $conexao = parent::retornarConexao();

            $comando_sql = 'insert into tb_empresa (nome_empresa, telefone_empresa, endereco_empresa, id_usuario) values (?, ?, ?, ?);';

            $sql = new PDOStatement();
            $sql = $conexao->prepare($comando_sql);

            $sql->bindValue(1, $nome);
            $sql->bindValue(2, $telefone);
            $sql->bindValue(3, $endereco);
            $sql->bindValue(4, UtilDAO::CodigoLogado());

            try{
                $sql->execute();
                return 1;
            }catch (Exception $ex){
                echo $ex->getMessage();
                return -1;
            }
        }
        // 2ª FUNÇÃO - CONSULTAR
        public function EmpresaConsultar(){
            $conexao = parent::retornarConexao();
            
            $comando_sql = 'select id_empresa, nome_empresa, telefone_empresa, endereco_empresa from tb_empresa where id_usuario = ? order by nome_empresa ASC';
            
            $sql = new PDOStatement();
            
            $sql = $conexao->prepare($comando_sql);

            $sql->bindValue(1, UtilDAO::CodigoLogado());

            $sql->setFetchMode(PDO::FETCH_ASSOC);

            $sql->execute();

            return $sql->fetchAll();
        }
        // 3ª FUNÇÃO - DETALHAR
        public function DetalharEmpresa($idEmpresa){
            $conexao = parent::retornarConexao();

            // O Filtro where com id_empresa e id_usuario fecha as possibilidade de existir uma falha ao realizar uma alteração no ID da url (cod)
            $comando_sql = 'select id_empresa, nome_empresa, telefone_empresa, endereco_empresa from tb_empresa where id_empresa = ? and id_usuario = ?';

            $sql = new PDOStatement();
            $sql = $conexao->prepare($comando_sql);
            $sql->bindValue(1, $idEmpresa);
            $sql->bindValue(2, UtilDAO::CodigoLogado());
            $sql->setFetchMode(PDO::FETCH_ASSOC);
            $sql->execute();
            return $sql->fetchAll();
        }
        // 4ª FUNÇÃO - ALTERAR
        public function EmpresaAlterar($nome, $telefone, $endereco, $idEmpresa){
            if(trim($nome) == '' || trim($telefone) == '' || trim($endereco) == '' || $idEmpresa == ''){
                return 0;
            }

            $conexao = parent::retornarConexao();
            $comando_sql = 'update tb_empresa set nome_empresa = ?,  telefone_empresa = ?, endereco_empresa = ? where id_empresa = ? and id_usuario = ?';
            $sql = new PDOStatement();
            $sql = $conexao->prepare($comando_sql);
            $sql->bindValue(1, $nome);            
            $sql->bindValue(2, $telefone);
            $sql->bindValue(3, $endereco);                        
            $sql->bindValue(4, $idEmpresa);            
            $sql->bindValue(5, UtilDAO::CodigoLogado());            

            try{
                $sql->execute();
                return 1;
            }catch(Exception $ex){
                echo $ex->getMessage();
                return -1;
            }
        }
        // 5ª FUNÇÃO - EXCLUIR
        public function EmpresaExcluir($idEmpresa){
            if($idEmpresa == ''){
                return 0;
            }

            $conexao = parent::retornarConexao();
            $comando_sql = 'delete from tb_empresa where id_empresa = ? and id_usuario = ?';
            $sql = new PDOStatement();
            $sql = $conexao->prepare($comando_sql);
            $sql->bindValue(1, $idEmpresa);
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