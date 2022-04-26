<?php
    /****************************************************
     * Objetivo: Arquivo responsável por manipular dentro do banco de dados(insert, update, select e delete)
     * Autor:Danilo
     * Data:14/04/2022
     * Versão:1.0
     ****************************************************/

     function listarProdutos(){
         
        //import do arquivo
        require_once('model/bd/produto.php');

        //chama a função que busca os dados
        $dados = selectAllProdutos();

        if(!empty($dados))
            return $dados;
        else
            return false;
     }
?>