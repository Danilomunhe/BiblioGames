<?php
   
        /****************************************************
         * Objetivo: Arquivo responsável pelo upload de imagens
         * Autor:Danilo
         * Data:25/04
         * Versão:1.0
         ****************************************************/

         //import do arquivo de configurações
         require_once('modulo/config.php');

         //função para realizar upload de imagem

         function uploadFile ($arrayFile){
            $arquivo = $arrayFile;
            $sizeFile = (int) 0;
            $typeFile = (string) null;
            $nameFile = (string) null;
            $tempFile = (string) null;

            //validação para verificar se existe um arquivo válido (Maior que 0 e que tenha uma extensão)
            if($arquivo['size'] > 0 && $arquivo['type'] != ""){

                //recupera o arquivo em bytes e cinverte para kb
                $sizeFile = $arquivo['size'] / 1024;

                //recupera o tipo, nome e o diretório que o arquivo está
                $typeFile = $arquivo['type'];
                $nameFile = $arquivo['name'];
                $tempFile = $arquivo['tmp_name'];

                //Validação para permitir o upload d arquivos de no máximo 5mb
                    if($sizeFile <= MAX_FILE_UPLOAD){
                        if(in_array($typeFile, EXT_FILE_UPLOAD)){
                            //Separa somente o nome do arquivo, sem a sua extenão
                            $nome = pathinfo($nameFile, PATHINFO_FILENAME);

                            //Separa somente a extensão
                            $extensao = pathinfo($nameFile, PATHINFO_EXTENSION);

                            //Criptografando o nome
                            $nomeCripty = md5($nome.uniqid(time()));

                            //montamos novamente o nome do arquivo com a extensão
                            $foto = $nomeCripty.".".$extensao;

                            // echo(move_uploaded_file($tempFile, DIRETORIO_FILE_UPLOAD.$foto));
                            // die;
                            if(move_uploaded_file($tempFile, DIRETORIO_FILE_UPLOAD.$foto)){
                                return $foto;
                            }else{
                                return array('idErro' => 13, 
                                'message' => 'Não foi possível mover o arquivo para o servidor');
                            }
                        }else{
                            return array('idErro' => 12, 
                            'message' => 'A extensão do arquivo selecionado não é permitida no upload ');
                        }
                    }else{
                        return array('idErro' => 10, 
                        'message' => 'Tamanho de arquivo inválido no upload');
                    }
            }else {
                return array('idErro' => 11, 
                'message' => 'Não é possível realizar o upload sem um arquivo selecionado');
       }
    }
?>