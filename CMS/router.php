<?php
/*************************************************
     * Objetivo: arquivo de rota, para segmentar as ações encaminhadas pela View
     *  (dados de um form, listagem de dados, ação de excluir ou atualizar)
     *  Esse arquivo será responsável por encaminhar a solicitações para a Controller
     * 
     * Autor: Danilo
     * Data: 04/03/2022
     * versão: 1.0
     */

    $action = (string) null;
    $component = (string) null;
    
     //Validação para verificar se a requisição é um post de um formulário
     if($_SERVER['REQUEST_METHOD'] == 'POST' || $_SERVER['REQUEST_METHOD'] == 'GET'){
         
         $component = strtoupper($_GET['component']);
         $action = strtoupper($_GET['action']);
         

         //Estrutura condicional para validar quem está solicitando algo para o sistema
         switch($component){

            case 'CONTATOS':
                
                //import da controller contatos
                require_once('controller/controllerContatos.php');
                
                //Validação para identificar o tipo de ação que será realizada
                if($action =='DELETAR'){

                     //Recebe o id do registro que deverá ser excluído, 
                    //que foi enviado pela url no link da imagem do excluir
                    //que foi acionado na index 
                    $idContato = $_GET['id'];

                    $resposta = excluirContato($idContato);

                    if(is_bool($resposta)){
                        //verifica se o retorno foi verdadeiro
                        if($resposta){
                            echo("<script>alert('Registro excluído com sucesso');
                            window.location.href='contatos.php'</script>"); 
                        }elseif(is_array($resposta)){
                            echo("<script> alert('".$resposta['message']."');
                            window.history.back(); </script>");
                        }
                    }
                }
            case 'CATEGORIA': 
                //import controller categoria
                require_once('controller/controllerCategorias.php');
                
                //validando o tipo de ação
                if($action == 'INSERIR'){

                    //Chama a função para inserir na controller
                    $resposta = inserirCategoria($_POST);
                    //validando o tipo de retorno
                    if(is_bool($resposta)){
                        //verificar se o retorno foi verdadeiro
                        if($resposta)
                            echo("<script>alert('Registro Inserido com sucesso');
                            window.location.href='categorias.php'</script>"); 
                    }elseif(is_array($resposta))
                        echo("<script> alert('".$resposta['message']."');
                        window.history.back(); </script>");
                }elseif($action == 'DELETAR'){
                    //Recebe o id do registro que deverá ser excluído, 
                    //que foi enviado pela url no link da imagem do excluir
                    //que foi acionado na index 
                    $idCategoria = $_GET['id'];

                    $resposta = excluirCategoria($idCategoria);

                    if(is_bool($resposta)){
                        //verificar se o retorno foi verdadeiro
                        if($resposta){
                            echo("<script>alert('Registro excluído com sucesso');
                            window.location.href='categorias.php'</script>");
                        }elseif(is_array($resposta)){
                            echo("<script> alert('".$resposta['message']."');
                            window.history.back(); </script>");
                        }
                    }
                }elseif($action == 'BUSCAR'){
                     //Recebe o id do registro que deverá ser editado, 
                    //que foi enviado pela url no link da imagem do editar
                    //que foi acionado na index 
                    $idCategoria = $_GET['id'];

                    $dados = buscarCategoria($idCategoria);

                    //Ativa variavel de sessao
                    session_start();

                    //Guarda em uma variável de sessão os dados que o BD retornou para a busca do id
                    //OBS: essa variável de sessão será utilizada na index.php, para colocar os dados
                    //nas caixas de texto.
                    $_SESSION['dadosCategoria'] = $dados;

                    
                    //Utilizando o require apenas iremos importar a tela da index,
                    //assim não ocorrerá um novo carregamento 
                    require_once('categorias.php');
                }elseif($action == 'EDITAR'){

                    //Recebe o id que foi enviado via action do form pela url
                    $idCategoria = $_GET['id'];

                    //Chama a função de inserir na controller
                    $resposta = atualizarCategoria($_POST, $idCategoria);

                    //Valida o tipo de retorno para ver se foi booleano
                      if(is_bool($resposta)){
                          //verificar se o retorno foi verdadeiro
                          if($resposta)
                              echo("<script>alert('Registro Atualizado com sucesso');
                              window.location.href='categorias.php'</script>"); 
  
                      //Se o retorno for um array significa que houve um erro mo processo de inserção
                      }elseif(is_array($resposta))
                          echo("<script> alert('".$resposta['message']."');
                          window.history.back(); </script>");
                }
            case 'USUARIO':
                //import controller usuario
                require_once('controller/controllerUsuarios.php');

                //validando o tipo de ação
                    if($action == 'INSERIR'){
                        
                        //chama a função para inserir da controller
                        $resposta = inserirUsuario($_POST);
                        //validando o tipo de retorno
                        if(is_bool($resposta)){
                            //verifica se o retorno foi verdadeiro
                            if($resposta)
                                echo("<script>alert('Registro Inserido com sucesso');
                                window.location.href='usuarios.php'</script>"); 
                        }elseif(is_array($resposta)){
                            echo("<script> alert('".$resposta['message']."');
                            window.history.back(); </script>");
                        }
                    }elseif($action == 'DELETAR'){
                        //Recebe o id do registro que deverá ser excluído, 
                        //que foi enviado pela url no link da imagem do excluir
                        //que foi acionado na index 
                        $idUsuario = $_GET['id'];

                        $resposta = excluirUsuario($idUsuario);

                        if(is_bool($resposta)){
                            //verifica se o retorno foi verdadeiro
                            if($resposta){
                                echo("<script>alert('Registro excluído com sucesso');
                                window.location.href='usuarios.php'</script>");
                            }elseif(is_array($resposta))
                                echo("<script> alert('".$resposta['message']."');
                                window.history.back(); </script>");
                        }
                    }elseif($action == 'BUSCAR'){
                        //Recebe o id do registro que deverá ser editado, 
                        //que foi enviado pela url no link da imagem do editar
                        //que foi acionado na index 
                        $idUsuario = $_GET['id'];

                        $dados = buscarUsuario($idUsuario);

                        //ativa variavel de sessao
                        session_start();

                        //Guarda em uma variável de sessão os dados que o BD retornou para a busca do id
                        //OBS: essa variável de sessão será utilizada na index.php, para colocar os dados
                        //nas caixas de texto.
                        $_SESSION['dadosUsuarios'] = $dados;

                        //Utilizando o require apenas iremos importar a tela da index,
                        //assim não ocorrerá um novo carregamento 
                        require_once('usuarios.php');
                    }elseif($action == 'EDITAR'){
                        //Recebe o id que foi enviad via form
                        $idUsuario = $_GET['id'];

                        //chama a função de atualizar da controller
                        $resposta = atualizarUsuario($_POST, $idUsuario);
                        
                        //validando o tipo de retorno para ver se é booleano
                         if(is_bool($resposta)){
                             //verificar se o retorno foi verdadeiro
                                if($resposta)
                                    echo("<script>alert('Registro Atualizado com sucesso');
                                    window.location.href='usuarios.php'</script>");
                         }elseif(is_array($resposta))
                            echo("<script> alert('".$resposta['message']."');
                              </script>");

                    }
            case 'PRODUTO':
                //import da controller produtos
                require_once('controller/controllerProdutos.php');

                //validação para identificar o tipo de ação que será realizada
                if($action=='INSERIR'){
                    if(isset($_FILES) && !empty($_FILES)){
                        //chama a função inserir na controller
                        $resposta = inserirProduto($_POST, $_FILES);
                    }else{
                        $resposta = inserirProduto($_POST, null);
                    }

                    //valida o tipo de retorno booleano
                    if(is_bool($resposta)){
                        //verifica se o retorno foi verdadeiro
                        if($resposta)
                            echo("<script>alert('Registro Inserido com sucesso');
                            window.location.href='produtos.php'</script>"); 
                    }elseif(is_array($resposta))
                        echo("<script> alert('".$resposta['message']."');
                        window.history.back(); </script>");
                }elseif($action == 'DELETAR'){
                    $idProduto = $_GET['id'];
                    $foto = $_GET['foto'];

                    //Criamos um array para enviar os dados
                    $arrayDados = array(
                        "id"   => $idProduto,
                        "foto" => $foto
                    );

                    $resposta = excluirProduto($arrayDados);

                    if(is_bool($resposta)){
                        //verificar se o retorno foi verdadeiro
                        if($resposta){
                            echo("<script>alert('Registro excluído com sucesso');
                            window.location.href='produtos.php'</script>"); 
                        }
                    }elseif(is_array($resposta)){
                        echo("<script> alert('".$resposta['message']."');
                        window.history.back(); </script>");
                    }
                }elseif($action == 'BUSCAR'){

                    $idProduto = $_GET['id'];

                    $dados = buscarProduto($idProduto);

                    //ativa variavel de sessao
                    session_start();

                    $_SESSION['dadosProduto'] = $dados;

                    require_once('produtos.php');
                }elseif($action == 'EDITAR'){
                     
                    //Recebe o id que foi enviado via action do form pela url
                    $idProduto = $_GET['id'];

                    //Recebe o nome d foto que foi enviada via get
                    $foto = $_GET['foto'];

                    
                    //Criamos um array para enviar dados
                    $arrayDados = array(
                        "id"    => $idProduto,
                        "foto"  => $foto,
                        "file"  => $_FILES
                      );

                    //Chama a função de inserir na controller
                    $resposta = atualizarProduto($_POST, $arrayDados);

                    //Valida o tipo de retorno para ver se foi booleano
                      if(is_bool($resposta)){
                          //verificar se o retorno foi verdadeiro
                          if($resposta)
                              echo("<script>alert('Registro Atualizado com sucesso');
                              window.location.href='produtos.php'</script>"); 
  
                      //Se o retorno for um array significa que houve um erro mo processo de inserção
                      }elseif(is_array($resposta))
                          echo("<script> alert('".$resposta['message']."');
                          window.history.back(); </script>");
                }
                break;
         }  

     }

?>