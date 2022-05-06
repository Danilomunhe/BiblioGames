<?php
    /****************************************************
     * Objetivo: Arquivo responsável por manipular dentro do banco de dados(insert, update, select e delete)
     * Autor:Danilo
     * Data:14/04/2022
     * Versão:1.0
     ****************************************************/
    function inserirProduto($dadosProduto, $file){

        $nomeFoto = (string) null;

        //validação para verificar se o objeto está vazio
        if(!empty($dadosProduto)){
            //validação de caixa vazia dos elementos
            if(!empty($dadosProduto['txtProduto']) && !empty($dadosProduto['txtValor']) && !empty($dadosProduto['txtDesconto']) && $file['fleFoto']['name']!=null){

                if($file['fleFoto']['name']!=null){

                    //import da função upload
                    require_once('modulo/upload.php');

                    //chama a função upload
                    $nomeFoto = uploadFile($file['fleFoto']);

                    if(is_array($nomeFoto)){
                        //caso aconteça algum erro no processo de upload a função irá retornar um array com a possível mensagem de erro
                        //esse array será retornado para router e ela irá exibir a mensagem para o usuário
                        return $nomeFoto;
                    }

                }
                //Criação do array de dados que será encaminhado à model para inserir no banco de dados, 
                //é importante criar este array conforme as necessisdade de manipulação do banco de dados.
                //OBS: criar a chaves do array conforme os nomes dos atributos do banco de dados para uma facilidade maior

                $arrayDados = array(
                    "nomeProduto" => $dadosProduto['txtProduto'],
                    "valor" => $dadosProduto['txtValor'],
                    "desconto" => $dadosProduto['txtDesconto'],
                    "descricao" => $dadosProduto['txtDesc'],
                    "foto" => $nomeFoto,
                    "destaque" => $dadosProduto['sltDestaque']
                );

               
                //import do arquivo de modalegem para manipular o BD
                require_once('model/bd/produto.php');
                //chama a função que fará o insert no bd
                if(insertProduto($arrayDados))
                    return true;
                else
                    return array('idErro' => 1, 
                    'message' => 'Não foi possível inserir os dados no Banco de Dados');
            
                }else{
                return array('idErro' => 2,
                             'message' => 'Existem campos obrigatórios que não foram preenchidos');
            }
        }
     }
    function atualizarProduto($dadosProduto, $arrayDados){
        $statusUpload = (boolean) false;

        //recebe o id enviado pelo array dados 
        $id = $arrayDados['id'];

        //recebe a foto enviada pelo array dados (nome da foto que já existe no bd)
        $foto = $arrayDados['foto'];

        //recebe o objeto de array com a nova foto que poderá ser enviada ao servidor
        $file = $arrayDados['file'];

        if(!empty($dadosProduto)){
            //Validação de caixa vazia dos elementos nome, celular e email pois são obrigatórios no BD
            if(!empty($dadosProduto['txtProduto']) && !empty($dadosProduto['txtValor']) && !empty($dadosProduto['txtDesconto'])){
                
                //Validação para que o id seja válido
                if(!empty($id) && $id != 0 && is_numeric($id)){
                    require_once('modulo/config.php');
                    //validação para identificar se será enviado ao servidor uma nova foto
                    if($file['fleFoto']['name'] != null){
                        //import da função de upload
                        require_once('modulo/upload.php');
                       
                        //chama a função de upload
                        $novaFoto = uploadFile($file['fleFoto']);
                        $statusUpload  = true;
                    }else{
                        //permanece a mesma foto no bd
                        $novaFoto = $foto;
                    }
                    //Criação do array de dados que será encaminhado à model para inserir no banco de dados, 
                    //é importante criar este array conforme as necessisdade de manipulação do banco de dados.
                    //OBS: criar a chaves do array conforme os nomes dos atributos do banco de dados para uma facilidade maior
                    $arrayDados = array(
                        "idProduto"  => $id,
                        "nomeProduto" => $dadosProduto['txtProduto'],
                        "valor" => $dadosProduto['txtValor'],
                        "desconto" => $dadosProduto['txtDesconto'],
                        "descricao" => $dadosProduto['txtDesc'],
                        "foto" => $novaFoto,
                        "destaque" => $dadosProduto['sltDestaque']
                    );
    
                    //Import do arquivo de modelagem para manipular o BD
                    require_once('model/bd/produto.php');

                    //Chama a função que fará o insert no BD (etstá função está na model)
                    if(updateProduto($arrayDados)){
                        if($statusUpload)
                            unlink(DIRETORIO_FILE_UPLOAD.$foto);    
                        return true;
                    }
                        
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
    function excluirProduto($arrayDados){
        //Recebe o id do registro que será excluido
        $id = $arrayDados['id'];
        $foto = $arrayDados['foto'];

        //validação para realizar se o id contém um número válido
        if($id!=0 && !empty($id) && is_numeric($id)){

            //import do arquivo de conexao
            require_once('model/bd/produto.php');
            require_once('modulo/config.php');

               //Chama a função da model e valida se o retorno foi verdadeiro ou falso 
               if(deleteProduto($id)){
                  
                if($foto != null){
                    
                   //unlink() - função para apagar um arquivo de uma pasta
                   //permite apagar a foto da pasta
                   if(unlink(DIRETORIO_FILE_UPLOAD.$foto))
                        return true;
                   else
                        return array('idErro' => 5,
                        'message' => 'O registro foi excluido com sucesso, porém a imagem não foi excluida do diretorio do servidor');  
                }else
                    return true;                             
            }

            else 
                return array('idErro' => 3,
                             'message' => 'O banco de dados não pode excluir o registro');    
        }else
            return array('idErro' => 4,
                     'message' => 'Não é possível excluir um registro sem informar um id válido');   
        
     }
    function buscarProduto($id){

        //validação para realizar se o id contém um número válido
        if($id!=0 && !empty($id) && is_numeric($id)){
        
             //Import do arquivo de conexão
             require_once('model/bd/produto.php');

             //Chama a função na modal e vai buscar no banco de dados, valida se existem dados para serem devolvidos
             $dadosProduto = selectByIdProduto($id);

             if(!empty($dadosProduto))
                return $dadosProduto;
            else
                return false;
        }else{
            return array('idErro' => 4,
                     'message' => 'Não é possível buscar um registro sem informar um id válido');  
        }
     }

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