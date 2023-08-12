<?php

    require_once 'Conexao.php';
    require_once 'UtilDAO.php';

    class CategoriaDAO extends Conexao{
        // 1ª FUNÇÃO - CADASTRAR
        public function CategoriaCadastrar($nome){
            if(trim($nome) == ''){
                return 0;
            }
            //1 Passo: Criar uma variável que receberá o objeto de conexao
            //Comando parent é acessar recuros da Classe herdada
            //Os :: pois a função é estática, não possui alterações
            $conexao = parent::retornarConexao();

            //2 Passo: Criar uma variável que receberá o texto do comando SQL que deverá ser executado no BD
            $comando_sql = 'insert into tb_categoria (nome_categoria, id_usuario) values (?, ?);';

            //3 Passo: Criar um Objeto que será configurado e levado no BD para ser executado
            $sql = new PDOStatement();

            //4 Passo: Colocar dentro do Objeto a conexão preparada para executar o comando_sql
            $sql = $conexao->prepare($comando_sql);

            //5 Passo: Verificar se no comando_sql eu tenho ? para ser configurado. Se tiver, configurar os bindValues
            //bindValues: Valor Vinculado
            $sql->bindValue(1, $nome);
            $sql->bindValue(2, UtilDAO::CodigoLogado());
    
            //EXECUTAR QUALQUER COMDANDO QUE PODERA DAR ERRADO
            //Comando try significa "TENTE", tentar sua execução
            try{
              //6 passo: executar no BD
              $sql->execute();
              return 1;
            }catch(Exception $ex){
              echo $ex->getMessage();
               return -1;
            }
        }
        // 2ª FUNÇÃO - CONSULTAR
        public function CategoriaConsultar(){
            $conexao = parent::retornarConexao();

            $comando_sql = 'select id_categoria, nome_categoria from tb_categoria where id_usuario = ? order by nome_categoria ASC';

            $sql = new PDOStatement();

            $sql = $conexao->prepare($comando_sql);

            $sql->bindValue(1, UtilDAO::CodigoLogado());

            $sql->setFetchMode(PDO::FETCH_ASSOC);

            $sql->execute();

            return $sql->fetchAll();
        }        
        // 3ª FUNÇÃO - DETALHAR
        public function DetalharCategoria($idCategoria){
            $conexao = parent::retornarConexao();

            // O Filtro where com id_categoria e id_usuario fecha as possibilidade de existir uma falha ao realizar uma alteração no ID da url (cod)
            $comando_sql = 'select id_categoria, nome_categoria from tb_categoria where id_categoria = ? and id_usuario = ?';

            $sql = new PDOStatement();
            $sql = $conexao->prepare($comando_sql);
            $sql->bindValue(1, $idCategoria);
            $sql->bindValue(2, UtilDAO::CodigoLogado());
            $sql->setFetchMode(PDO::FETCH_ASSOC);
            $sql->execute();
            return $sql->fetchAll();
        }
        // 4ª FUNÇÃO - ALTERAR
        public function AlterarCategoria($nome, $idCategoria){
            if(trim($nome) == '' || $idCategoria == ''){
                return 0;
            }

            $conexao = parent::retornarConexao();
            $comando_sql = 'update tb_categoria set nome_categoria = ? where id_categoria = ? and id_usuario = ?';
            $sql = new PDOStatement();
            $sql = $conexao->prepare($comando_sql);
            $sql->bindValue(1, $nome);
            $sql->bindValue(2, $idCategoria);
            $sql->bindValue(3, UtilDAO::CodigoLogado());

            try{
                $sql->execute();
                return 1;
            }catch(Exception $ex){
                echo $ex->getMessage();
                return -1;
            }
        }
        // 5ª FUNÇÃO - EXCLUIR
        public function CategoriaExcluir($idCategoria){
            if($idCategoria == ''){
                return 0;
            }

            $conexao = parent::retornarConexao();
            $comando_sql = 'delete from tb_categoria where id_categoria = ? and id_usuario = ?';
            $sql = new PDOStatement();
            $sql = $conexao->prepare($comando_sql);
            $sql->bindValue(1, $idCategoria);
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