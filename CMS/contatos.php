<?php

    require_once('CMS.php')

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/contatos.css">
    <title>Contatos</title>
</head>
<body>
    <main>
        <table>
            <tr>
                <td>Nome</td>
                <td>Mensagem</td>
                <td>Opções</td>
            </tr>


            <?php
                //import do arquivo da controller para soliciara listagem de dados
                require_once('controller/controllerContatos.php');
                $listContato = listarContato();
                //Estrutura de repetição para exibir todos os contatos
                foreach($listContato as $item){
            ?>
            <tr>
                <td><?=$item['nome']?></td>
                <td><?=$item['email']?></td>
                <td>
                    <img src="img/lupa.png" alt="lupa" title="pesquisar">
                    <a onclick="return confirm('Deseja realmente excluir este item')" href="router.php?component=contatos&action=deletar&id=<?=$item['id']?>">
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