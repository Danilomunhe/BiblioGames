<?php
   /************************************************ 
        Arquivo para criar a conexao com o banco de dados MySQL
        autor:Danilo 
        Data:25/02/2022
        Versão: 1.0
        ***************************************************/

        //constantes que estabeleecem a conexão com o banco
        const SERVER = 'localhost';
        const USER = 'root';
        const PASSWORD = 'bcd127';
        const DATABASE = 'dbbetagames';

     //abre a conexão com o banco
     function conexaoMySql(){
         $conexao = array();
         
         //Se a conexão se estabelecer teremos um array de dados
         $conexao = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);

         //Validaçã para verificar se deu certo a conexão
         if($conexao)
            return( $conexao);
         else
            return false;
     }

     function encerrarConexao($conexao){
            mysqli_close($conexao);
     }
?>       
       
       
     