<?php

    require_once('CMS.php');

    $form= (string) "router.php?component=usuario&action=inserir";

    //valida se a utilização de variaveis de sessao
        if(session_status()){
            if(!empty($_SESSION['dadosUsuarios'])){
                $id = $_SESSION['dadosUsuarios']['id'];
                $nome = $_SESSION['dadosUsuarios']['nome'];
                $login = $_SESSION['dadosUsuarios']['login'];
                $senha = $_SESSION['dadosUsuarios']['senha'];
                $imagem = $_SESSION['dadosUsuarios']['imagem'];

                $form= (string) "router.php?component=usuario&action=editar&id=".$id;
            
                //Destrói uma variavel de sessao
                unset($_SESSION['dadosUsuarios']);
            }
        }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/usuarios.css">
    <title>Usuarios</title>
</head>
<body>
    <main>
    <div class="form-usuario">
        <form action="<?=$form?>" name="frmUsuario" method="post">
            <div class="campos">
                <label>Nome:</label>
                <input type="text" name='txtUsuario' value="<?=isset($nome)?$nome:null?>">
            </div>
            <div class="campos">
                <label>Login:</label>
                <input type="text" name='txtLogin' value="<?=isset($login)?$login:null?>">
            </div>
            <div class="campos">
                <label>Senha:</label>
                <input type="password" name='txtSenha' value="<?=isset($senha)?$senha:null?>">
            </div>
            <div class="campos">
                <label>Confirme a senha:</label>
                <input type="password" name='txtSenhaConfirmada' value="<?=isset($senha)?$senha:null?>">
            </div>
            <div class="campos">
                <label>Foto do usuário:</label>
                <input type="file" name='fileImagem' value="<?=isset($imagem)?$imagem:null?>">
            </div>
            <div class="btn">
                <input type="submit" value="Salvar">
            </div>
        </form>
    </div>
    <table>
            <tr>
                <td>Usuário</td>
                <td>Login</td>
                <td>Senha</td>
                <td>Opções</td>
            </tr>
            <?php
                //import do arquivo da controller
                require_once ('controller/controllerUsuarios.php');
                $listUsario = listarUsuarios();
                
                //Laço para listar os dados do array
                foreach($listUsario as $item){
            ?>
            <tr>
                <td><?=$item['nome']?></td>
                <td><?=$item['login']?></td>
                <td><?=$item['senha']?></td>
                <td>

                        <a href="router.php?component=usuario&action=buscar&id=<?=$item['id']?>">
                            <img src="img/editar.png" alt="lupa" title="editar">
                        </a>

                        <a onclick="return confirm('Deseja mesmo excluir esse usuario?')" href="router.php?component=usuario&action=deletar&id=<?=$item['id']?>">
                            <img src="img/lixo.png" alt="lixo" title="excluir">
                        </a>
                       
                    
                  
            </td> 
            </tr>
            <?php
                }
            ?>
        </table>
    </main>
</body>
</html>