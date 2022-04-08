<?php
    /****************************************************
     * Objetivo: Arquivo responsável pela manipulação de dados de contatos
     * Obs: Esse arquivo fará a ponte entre a View e a model
     * Todos os tartamentos de erros devem ser realizados nesse arquivo
     * Autor:Danilo
     * Data:04/03
     * Versão:1.0
     ****************************************************/
     function excluirContato($id){

      //validação para ver se o id contém um número válido
         if($id!=0 && !empty($id) && is_numeric(($id))){
            //import do arquvo de conexão
            require_once('model/bd/contato.php');

            //Chama função da model e valida se o retorno foi verdadeiro ou falso
            if(deleteContato($id))
               return true;
            else 
               return array('idErro' => 3,
                            'message' => 'O banco de dados não pode excluir o registro');    
       }else
            return array('idErro' => 4,
            'message' => 'Não é possível excluir um registro sem informar um id válido');   
         
     } 
     function listarContato(){
         require_once('model/bd/contato.php');

         //Chama função que vai buscar os dados no banco
         $dados = selectAllContato();

         if(!empty($dados))
            return $dados;
         else 
            return false;
     }
?>