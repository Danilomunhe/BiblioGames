<?php
    /****************************************************
     * Objetivo: Arquivo responsável por manipular dentro do banco de dados(insert, update, select e delete)
     * Autor:Danilo
     * Data:14/04/2022
     * Versão:1.0
     ****************************************************/

     //import conexão
     require_once('conexaoBD.php');

     function insertProduto($dadosProduto){

        //iniciando a variavel de resposta
        $statusResposta = (boolean) false;

        //abre a conexão com o banco
        $conexao = conexaoMySql();

          //Monta o script para enviar para o banco de dados
          $sql = "insert into tblcontatos(nome, 
                                        preco, 
                                        desconto, 
                                        descricao, 
                                        foto)
                                    values('".$dadosProduto['nome']."', 
                                    '".$dadosProduto['preco']."', 
                                    '".$dadosProduto['desconto']."', 
                                    '".$dadosProduto['descricao']."', 
                                    '".$dadosProduto['foto']."');";

                //Executa o script no BD
                //Valiação para verificar se o script sql está correto
                if (mysqli_query($conexao, $sql)){
                //Validação para verificar se uma linha foi acescentado no BD
                if(mysqli_affected_rows($conexao))
                $statusResposta = true;
                }

            //Solicita o fechamento da conexão com o bd
            encerrarConexao($conexao);

            return $statusResposta;
     }
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