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
          $sql = "insert into tblprodutos(nome, 
                                        preco, 
                                        desconto, 
                                        descricao, 
                                        foto,
                                        destaque)
                                    values('".$dadosProduto['nomeProduto']."', 
                                    '".$dadosProduto['valor']."', 
                                    '".$dadosProduto['desconto']."', 
                                    '".$dadosProduto['descricao']."', 
                                    '".$dadosProduto['foto']."',
                                    '".$dadosProduto['destaque']."' );";

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

    function updateProduto($dadosProduto){
        //inicando variavel
        $statusResposta = (boolean) false;
        
        //abre a conexao com o bd
        $conexao = conexaoMySql();

        //script de atualizaão
        $sql = "update tblprodutos set      nome     ='".$dadosProduto['nomeProduto']."', 
                                            preco =".$dadosProduto['valor'].", 
                                            desconto  ='".$dadosProduto['desconto']."', 
                                            descricao    ='".$dadosProduto['descricao']."', 
                                            foto    ='".$dadosProduto['foto']."',
                                            destaque    ='".$dadosProduto['destaque']."'   
                                            where idproduto=".$dadosProduto['idProduto'];
        
        if(mysqli_query($conexao, $sql)){
            if(mysqli_affected_rows($conexao))
                $statusResposta= true;
        }

        encerrarConexao($conexao);
        return $statusResposta;
    }
    function deleteProduto($id){

        //declaração variavel resposta
        $statusResposta = (boolean) false;

         //Abre a conexão com o banco de dados
         $conexao = conexaoMySql();

         //Script para deletar um registro no bd
         $sql = "delete from tblprodutos where idproduto=".$id;
 
         //valida se o script está correto, sem erro de sintaxe e executa no bd
         if(mysqli_query($conexao, $sql)){
            //valida se o bd teve sucesso na execução do script
             if(mysqli_affected_rows($conexao))
                 $statusResposta = true;
         }

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
                    "foto"  => $rsDados['foto'],
                    "destaque"      => $rsDados['destaque']
                );
                $cont++;
            }
            encerrarConexao($conexao);

            return $arrayDados;
        }
     }
    function selectByIdProduto($id){

        //abre a conexão
        $conexao = conexaoMySql();

        //script para listar todos os produtos
        $sql = "select * from tblprodutos where idproduto =" .$id;

        //Quando mandamos um script para o banco do tipo insert, update e delete. Eles não devolvem resultados do banco, apenas se deu certo ou não
        //No select o banco deve retornar uma lista de dados;

        //executa um script no banco de dados e guarda o retorno dos dados
        $result = mysqli_query($conexao, $sql);

        if($result){

            //mysqli_fetch_assoc() - permite converter os dados do BD
            //em um array para manipulação no PHP
            //Nesta repetição estamos, convertendo os dados do BD em um array ($rsDados), além de
            //o próprio while conseguir a quantidade de vezes que deveria ser feita a repetição
           
            if($rsDados = mysqli_fetch_assoc($result)){
               
                //Cria um array com os dados do BD
                $arrayDados = array(
                    "id"       => $rsDados['idproduto'],
                    "nomeProduto"     => $rsDados['nome'],
                    "valor" => $rsDados['preco'],
                    "desconto"  => $rsDados['desconto'],
                    "descricao"    => $rsDados['descricao'],
                    "foto"      => $rsDados['foto'],
                    "destaque"      => $rsDados['destaque']
                );
            }
        }
        //fecha conexao
        encerrarConexao($conexao);

        return $arrayDados;
     }
?>