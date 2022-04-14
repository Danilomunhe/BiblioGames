<?php

    require_once('CMS.php');

    $form= (string) "router.php?component=usuario&action=inserir";
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
                <input type="text" name='txtUsuario' value="">
            </div>
            <div class="campos">
                <label>Login:</label>
                <input type="text" name='txtLogin' value="">
            </div>
            <div class="campos">
                <label>Senha:</label>
                <input type="password" name='txtSenha' value="">
            </div>
            <div class="campos">
                <label>Confirme a senha:</label>
                <input type="password" name='txtSenhaConfirmada' value="">
            </div>
            <div class="campos">
                <label>Foto do usuário:</label>
                <input type="file" name='fileImagem' value="">
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
                        <img src="img/editar.png" alt="lupa" title="editar">
                        <img src="img/lixo.png" alt="lixo" title="excluir">
                    
                  
            </td> 
            </tr>
            <?php
                }
            ?>
        </table>
    </main>
</body>
</html>