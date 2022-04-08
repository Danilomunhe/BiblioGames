<?php
    /****************************************************
     * Objetivo: Arquivo responsável por manipular dentro do banco de dados(insert, update, select e delete)
     * Autor:Danilo
     * Data:07/04/2022
     * Versão:1.0
     ****************************************************/

     //Import conexão
     require_once('conexaoBD.php');

     function insertCategoria($dadosCategoria){
         //iniciando variavel de resposta
         $statusResposta = (boolean) false;

         //Abre conexão
         $conexao = conexaoMySql();

         //Script para enviar os dados
         $sql = "insert into tblcategorias(nome)
                    values('".$dadosCategoria['nome']."');";

        //Executa o script no bd
            //valida se o scriprt sql está correto
        if(mysqli_query($conexao, $sql)){
            //validação para verificar se uma linha foi acrescentada no bd
            if(mysqli_affected_rows($conexao))
                $statusResposta = true;
        }

        //Fechando conexao com o bd
        encerrarConexao($conexao);
        return $statusResposta;
     }
     function updateCategoria($dadosCategoria){
         //iniciando variavel de status resposta
         $statusResposta = (boolean) false;

         //abre conexão
         $conexao = conexaoMySql();

         $sql = "update tblcategorias set nome ='".$dadosCategoria['nome']."'
         where idcategoria=".$dadosCategoria['idCategoria'];

         //Executa o script no bd
         //validação para verificar se o script está certo
            if(mysqli_query($conexao, $sql)){
                //validação para verificar se uma linha foi afetada no bd
                if(mysqli_affected_rows($conexao))
                    $statusResposta = true;
            }
              //Solicita o fechamento da conexão com o bd
              encerrarConexao($conexao);
    
              return $statusResposta; 

     }
     function deleteCategoria($id){
         $statusResposta = (boolean) false;

         //abre conexao
         $conexao = conexaoMySql();

         //Script de delete
         $sql = "delete from tblcategorias where idcategoria=".$id;

         //Validando se o script está correto
            if(mysqli_query($conexao, $sql)){
                //valida se o bd teve sucesso na execução do script
                    if(mysqli_affected_rows($conexao))
                        $statusResposta = true;
            }
            encerrarConexao($conexao);
            return $statusResposta;
     }

     function selectAllCategoria(){

        //abre conexao
        $conexao = conexaoMySql();

        //Script de listagem
       $sql = "select * from tblcategorias";

       // executa uma script e aguarda um retorno de dados
       $result = mysqli_query($conexao, $sql);
       
       //valida se o bd registrou os dados
       if($result){

        $cont = 0;
        while($rsDados = mysqli_fetch_assoc($result)){

            //Cria um array com os dados no bd
            $arrayDados[$cont] = array(
                "id"   => $rsDados['idcategoria'],
                "nome" => $rsDados['nome']
            );
            $cont++;
        }
         //solicita o fechamento da conexao com o banco de dados
         encerrarConexao($conexao);

         return $arrayDados;
       }
     }

    function selectByIdCategoria($id){

        //abre a conexão com o banco
        $conexao = conexaoMySql();

        $sql = "select * from tblcategorias where idcategoria =" .$id;

        $result = mysqli_query($conexao, $sql);

        if($result){

            if($rsDados = mysqli_fetch_assoc($result)){

                //Cria um array de dados
                $arrayDados = array(
                    "id"       => $rsDados['idcategoria'],
                    "nome"     => $rsDados['nome'],
                );
            }
        }
         //solicita o fechamento da conexao com o banco de dados
         encerrarConexao($conexao);

         return $arrayDados;
    }
?>