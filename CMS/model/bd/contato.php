<?php
    /****************************************************
     * Objetivo: Arquivo responsável por manipular dentro do banco de dados(insert, update, select e delete)
     * Autor:Danilo
     * Data:11/03/2022
     * Versão:1.0
     ****************************************************/

     //import do arquivo de conexão
     require_once('conexaoBD.php');
     
     function deleteContato($id){
        $statusResposta = (boolean) false;

        //Abre a conexão com o bd
        $conexao = conexaoMySql();

        //Sriprt de delete
        $sql = "delete from tblcontatos where idcontato=".$id;

        //Valida se o script está correto, sem erro de sintaxe e executa no bd
        if(mysqli_query($conexao, $sql)){
            //valida se o bd teve sucesso na execução do script
                if(mysqli_affected_rows($conexao))
                    $statusResposta = true;
        }
        encerrarConexao($conexao);
        return $statusResposta;
     }

     function selectAllContato(){
         //abre a conexão com o bd
         $conexao = conexaoMySql();
         
         //Script para listar contatos
         $sql = "select * from tblcontatos";

         //executa um script e guarda o retorno
         $result = mysqli_query($conexao, $sql);

         //Valida se o bd retornou registro
         if($result){

            $cont = 0;
            while($rsDados = mysqli_fetch_assoc($result)){

                //Criando um array com dados do banco
                $arrayDados[$cont] = array(
                    "id" => $rsDados['idcontato'],
                    "nome" => $rsDados['nome'],
                    "email" => $rsDados['email'],
                    "obs" => $rsDados['obs'],
                );
                $cont++;
            }
            //solicita o fechamento da conexao com o banco de dados
            encerrarConexao($conexao);

            return $arrayDados;
        }
    }
?>  
