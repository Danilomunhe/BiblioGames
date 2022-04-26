<?php
    /****************************************************
     * Objetivo: Arquivo responsável por manipular dentro do banco de dados(insert, update, select e delete)
     * Autor:Danilo
     * Data:14/04/2022
     * Versão:1.0
     ****************************************************/

     //import conexão
     require_once('conexaoBD.php');

     function selectAllProdutos(){
         //abre a conexao
         $conexao = conexaoMySql();

         //script de listagem
         $sql = "select * from tblprodutos";

         //executa um script no banco
         $result = mysqli_query($conexao, $sql);

         //valida se o bd registrou os dados
         if($result){
            $cont = 0;
            while($rsDados = mysqli_fetch_assoc($result)){
                //cria um array com os dados no bd
                $arrayDados[$cont] = array(
                    "id"    => $rsDados['idproduto'],
                    "nome"  => $rsDados['nome'],
                    "preco" => $rsDados['preco'],
                    "desconto" => $rsDados['desconto'],
                    "descricao" => $rsDados['descricao'],
                    "foto"  => $rsDados['foto']
                );
                $cont++;
            }
            encerrarConexao($conexao);

            return $arrayDados;
        }
     }
?>