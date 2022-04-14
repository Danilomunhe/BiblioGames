<?php
    /****************************************************
     * Objetivo: Arquivo responsável por manipular dentro do banco de dados(insert, update, select e delete)
     * Autor:Danilo
     * Data:14/04/2022
     * Versão:1.0
     ****************************************************/

     function inserirUsuario($dadosUsuarios){

        //validação para verificar se o objeto está vazio
            if(!empty($dadosUsuarios)){
                //validação para verificar se a caixa do elemento está vazia
                    if(!empty($dadosUsuarios['txtUsuario']) && !empty($dadosUsuarios['txtLogin']) && !empty($dadosUsuarios['txtSenha'])){
                        if($dadosUsuarios['txtSenha'] == $dadosUsuarios['txtSenhaConfirmada']){
                                 //Criação do array de dados que será encaminhado à model para inserir no banco de dados, 
                                //é importante criar este array conforme as necessisdade de manipulação do banco de dados.
                                //OBS: criar a chaves do array conforme os nomes dos atributos do banco de dados para uma facilidade maior
                                $arrayDados = array(
                                    "nome"      => $dadosUsuarios['txtUsuario'],
                                    "login"      => $dadosUsuarios['txtLogin'],
                                    "senha"      => $dadosUsuarios['txtSenha'],
                                    "imagem"      => $dadosUsuarios['fileImagem'],
                                );

                                //import arquivo do banco
                                require_once('model/bd/usuario.php');
                                //chama a função para inserir no bd
                                    if(insertUsuario($arrayDados))
                                        return true;
                                    else 
                                        return array('idErro' => 1,
                                                    'message' => 'Não foi possível inserir os dados ');
                                }else{
                                    echo("<script> alert('Senhas diferentes');
                                    window.history.back(); </script>");
                            }
                               
                        }else{
                            return array('idErro' => 2,
                                'message' => 'Existem campos obrigatórios que não foram preenchidos');
                        }
                        }
                       
            }
     
     
     function excluirUsuario($id){
         //validação para um id valido
         if($id!=0 && !empty($id) && is_numeric($id)){
               //import arquivo de conexão
            require_once('model/bd/usuario.php');

            //Cgama função para deletar
            if(deleteUsuario($id))
                return true;
            else 
                return array('idErro' => 3,
                             'message' => 'O banco de dados não pode excluir o registro');    
        }else
             return array('idErro' => 4,
             'message' => 'Não é possível excluir um registro sem informar um id válido'); 
         
     }
    function atualizarUsuario($dadosUsuarios, $id){
        //validação para verificar se o objeto está vazio
        if(!empty($dadosUsuarios)){
            //validação para verificar se a caixa do elemento está vazia
                if(!empty($dadosUsuarios['txtUsuario']) && !empty($dadosUsuarios['txtLogin']) && !empty($dadosUsuarios['txtSenha'])){
                    if($dadosUsuarios['txtSenha'] == $dadosUsuarios['txtSenhaConfirmada']){
                        if(!empty($id) && $id != 0 && is_numeric($id)){
                                //Criação do array de dados que será encaminhado à model para inserir no banco de dados, 
                            //é importante criar este array conforme as necessisdade de manipulação do banco de dados.
                            //OBS: criar a chaves do array conforme os nomes dos atributos do banco de dados para uma facilidade maior
                            $arrayDados = array(
                                "idUsuario" => $id,
                                "nome"      => $dadosUsuarios['txtUsuario'],
                                "login"      => $dadosUsuarios['txtLogin'],
                                "senha"      => $dadosUsuarios['txtSenha'],
                                "imagem"      => $dadosUsuarios['fileImagem']
                            );
                            
                            //import arquivo do banco
                            require_once('model/bd/usuario.php');
                            //chama a função para inserir no bd
                            
                                if(updateUsuario($arrayDados))
                                    return true;
                                else 
                                    return array('idErro' => 1,
                                                'message' => 'Não foi possível atualizar os dados ');
                            }else{
                                return array('idErro' => 2,
                                'message' => 'Existem campos obrigatórios que não foram preenchidos');
                        }
                           
                    }else{
                            echo("<script> alert('Senhas diferentes');
                            window.history.back(); </script>");
                    }
                }
                             
            }
}
     function buscarUsuario($id){
        //validação para ver se o id é valido
        if($id!=0 && !empty($id) && is_numeric($id)){
            //import do arquivo de conexão
            require_once('model/bd/usuario.php');

            //chama a função que busca pelo id
            $dados = selectByIdUsuario($id);

            if(!empty($dados))
                return $dados;
            else 
                return false;
        }else{
            return array('idErro' => 4,
                     'message' => 'Não é possível buscar um registro sem informar um id válido');  
    }
}
    function listarUsuarios(){
        //import arquivo
        require_once('model/bd/usuario.php');

        //chama função que busca os dados
        $dados = selectAllUsuarios();

        if(!empty($dados))
            return $dados;
        else    
            return false;
     }
    
?>