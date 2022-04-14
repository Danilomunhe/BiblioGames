<?php
    /****************************************************
     * Objetivo: Arquivo responsável por manipular dentro do banco de dados(insert, update, select e delete)
     * Autor:Danilo
     * Data:14/04/2022
     * Versão:1.0
     ****************************************************/

     //import conexão
     require_once('conexaoBD.php');

    function insertUsuario($dadosUsuarios){
        //iniciando variavle resposta
        $statusResposta = (boolean) false;

        //abre conexao
        $conexao = conexaoMySql();

        //script para enviar os dados
        $sql = "insert into tblusuarios(nome, login, senha, imagem)
                    values('".$dadosUsuarios['nome']."', 
                    '".$dadosUsuarios['login']."', 
                    '".$dadosUsuarios['senha']."', 
                    '".$dadosUsuarios['imagem']."');";

        //Executa o script no banco 
        if(mysqli_query($conexao, $sql)){
            if(mysqli_affected_rows($conexao))
                $statusResposta = true;
        }
            //Fechando conexao com o bd
            encerrarConexao($conexao);
            return $statusResposta;
    }
    function selectAllUsuarios(){
         //abre conexao
         $conexao = conexaoMySql();

         //script de listagem
         $sql = "select * from tblusuarios";

         //Executa um script no banco
         $result = mysqli_query($conexao, $sql);

         //Valida se o bd registrou dados
         if($result){
             $cont = 0;
             while($rsDados = mysqli_fetch_assoc($result)){
                 //cria um array com os dados no bd
                 $arrayDados[$cont] = array(
                    //  "id"    => $rsDados['idusario'],
                     "nome"  => $rsDados['nome'],
                     "login" => $rsDados['login'],
                     "senha" => $rsDados['senha'],
                     "foto"  => $rsDados['imagem']
                 );
                 $cont++;
             }
             encerrarConexao($conexao);

             return $arrayDados;
         }
     }
?>