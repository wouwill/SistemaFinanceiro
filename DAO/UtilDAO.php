<?php

class UtilDAO{
    // Criando a Validação de Sessão, Usuário Logado
    private static function IniciarSessao(){
        if(!isset($_SESSION)){
            session_start();
        }
    }

    public static function CriarSessao($cod, $nome){
        // Comando self chama uma Função Estática
        self::IniciarSessao();

        $_SESSION['cod'] = $cod;
        $_SESSION['nome'] = $nome;
    }
    
    public static function CodigoLogado(){
        // return 1; //Valor fixo por eqto, simulando o usuario cod. logado 1
        self::IniciarSessao();
        return $_SESSION['cod'];
    }

    public static function NomeLogado(){
        self::IniciarSessao();
        return $_SESSION['nome'];
    }

    public static function Deslogar(){
        self::IniciarSessao();
        // Comando unset elimina a Sessão logada
        unset($_SESSION['cod']);
        unset($_SESSION['nome']);

        // Após a Sessão destruida, volta para a página de Login
        header('location: index.php');
        exit;
    }

    public static function VerificarLogado(){
        self::IniciarSessao();
        if(!isset($_SESSION['cod']) || $_SESSION['cod'] == ''){

            header('location: index.php');
            exit;
        }
    }
}