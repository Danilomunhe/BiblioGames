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
                    md5('".$dadosUsuarios['senha']."'), 
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

    function updateUsuario($dadosUsuarios){
        //iniciando variavel de resposta
        $statusResposta = (boolean) false;

        //abre a conexao
        $conexao = conexaoMySql();

        $sql = "update tblusuarios set  nome     ='".$dadosUsuarios['nome']."', 
                                    login  ='".$dadosUsuarios['login']."', 
                                    senha  =md5('".$dadosUsuarios['senha']."'), 
                                    imagem ='".$dadosUsuarios['imagem']."'
                                    where idusuario=".$dadosUsuarios['idUsuario'];

        //executar o script no bd
        //validação para verificar se o script está correto
        
            if(mysqli_query($conexao, $sql)){
                //validação para ver se a linha foi afetada
                if(mysqli_affected_rows($conexao))
                    $statusResposta = true;
            }
            //Solicita o fechamento da conexão com o bd
            encerrarConexao($conexao);
    
            return $statusResposta;  
    }
    function deleteUsuario($id){
        $statusResposta = (boolean) false;

        //abre conexao
        $conexao = conexaoMySql();

        //script delete 
        $sql = "delete from tblusuarios where idusuario=".$id;

        //validando se o script está correto
            if(mysqli_query($conexao, $sql)){
                //validando se o bd teve sucesso na execução
                if(mysqli_affected_rows($conexao))
                    $statusResposta = true;
            }
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
                     "id"    => $rsDados['idusuario'],
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
    
    function selectByIdUsuario($id){
        //abre conexao
        $conexao = conexaoMySql();

        $sql = "select * from tblusuarios where idusuario =" .$id;

        $result = mysqli_query($conexao, $sql);

        if($result){
           if($rsDados = mysqli_fetch_assoc($result)){
                //Cria um array de dados
                $arrayDados = array(
                "id"       => $rsDados['idusuario'],
                "nome"     => $rsDados['nome'],
                "login"     => $rsDados['login'],
                "senha"     => $rsDados['senha'],
                "imagem"     => $rsDados['imagem'],
            );
           }
        }
           //solicita o fechamento da conexao com o banco de dados
           encerrarConexao($conexao);

           return $arrayDados;
     }
?>