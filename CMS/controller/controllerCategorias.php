<?php
    /****************************************************
     * Objetivo: Arquivo responsável por manipular dentro do banco de dados(insert, update, select e delete)
     * Autor:Danilo
     * Data:07/04/2022
     * Versão:1.0
     ****************************************************/

    function inserirCategoria($dadosCategoria){

        //validação para verificar se o objeto está vazio
        if(!empty($dadosCategoria)){
            //validação para verificar se a caixa do elemento está vazia
            if(!empty($dadosCategoria['txtNomeCategoria'])){

                //Criação do array de dados que será encaminhado à model para inserir no banco de dados, 
                //é importante criar este array conforme as necessisdade de manipulação do banco de dados.
                //OBS: criar a chaves do array conforme os nomes dos atributos do banco de dados para uma facilidade maior
                
                $arrayDados = array(
                    "nome" => $dadosCategoria['txtNomeCategoria']
                );

                //Import arquivo do banco
                require_once('model/bd/categoria.php');
                //Chama a função para inserir no bd
                if(insertCategoria($arrayDados))
                    return true;
                else 
                    return array('idErro' => 1,
                                'message' => 'Não foi possível inserir os dados ');
            }else{
                return array('idErro' => 2,
                            'message' => 'Existem campos obrigatórios que não foram preenchidos');
            }
        }
    }

    function atualizarCategoria($dadosCategoria, $id){
        if(!empty($dadosCategoria)){
            //Validação de caixa vazia dos elementos nome
            if(!empty($dadosCategoria['txtNomeCategoria'])){
                
                //Validação para que o id seja válido
                if(!empty($id) && $id != 0 && is_numeric($id)){
                      
                    //Criação do array de dados que será encaminhado à model para inserir no banco de dados, 
                    //é importante criar este array conforme as necessisdade de manipulação do banco de dados.
                    //OBS: criar a chaves do array conforme os nomes dos atributos do banco de dados para uma facilidade maior
                    $arrayDados = array(
                        "idCategoria" => $id,
                        "nome" => $dadosCategoria['txtNomeCategoria'],
                    );
    
                    //Import do arquivo de modelagem para manipular o BD
                    require_once('model/bd/categoria.php');
                    //Chama a função que fará o insert no BD (etstá função está na model)
                    if(updateCategoria($arrayDados))
                        return true;
                    else 
                        return array('idErro' => 1, 
                                     'message' => 'Não foi possíve atualizar os dados no Banco de Dados');
                }else
                    return array('idErro' => 4,
                    'message' => 'Não é possível editar um registro sem informar um id válido');  
            }else{
                return array('idErro' => 2,
                             'message' => 'Existem campos obrigatórios que não foram preenchidos');
            }
        }
    }
    function buscarCategoria($id){
        //validação para ver se o id é valido
        if($id!=0 && !empty($id) && is_numeric(($id))){
            //import do arqivo de conexão
            require_once('model/bd/categoria.php');

            //chama a função que busca pelo id
            $dados = selectByIdCategoria($id);

            if(!empty($dados))
                return $dados;
            else    
                return false;
        }else{
            return array('idErro' => 4,
                     'message' => 'Não é possível buscar um registro sem informar um id válido');  
        }
    }
    function excluirCategoria($id){
        //validação para ver se o id contém um número válido 
        if($id!=0 && !empty($id) && is_numeric($id)){
            //import arquivo de conexão
            require_once('model/bd/categoria.php');

            //Cgama função para deletar
            if(deleteCategoria($id))
                return true;
            else 
                return array('idErro' => 3,
                             'message' => 'O banco de dados não pode excluir o registro');    
        }else
             return array('idErro' => 4,
             'message' => 'Não é possível excluir um registro sem informar um id válido'); 
    }
    function listarCategoria(){

        //import arquivo 
        require_once('model/bd/categoria.php');

        //chama função que busca os dados
        $dados = selectAllCategoria();

        if(!empty($dados))
            return $dados;
        else
            return false;
    }
?>

 