<?php

    require_once('CMS.php');


    $nome = (string) null;
    $form= (string) "router.php?component=categoria&action=inserir";

    //valida se a utilizção de variaveis de session
    if(session_status()){
        if(!empty($_SESSION['dadosCategoria'])){
            $id = $_SESSION['dadosCategoria']['id'];
            $nome = $_SESSION['dadosCategoria']['nome'];

            $form= (string) "router.php?component=categoria&action=editar&id=".$id;
        
            //Destroi uma variavel de session
            unset($_SESSION['dadosContato']);
        }
    }

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/categorias.css">
    <title>Categorias</title>
</head>
<body>
    <main>
    <div class="form-categoria">
        <form action="<?=$form?>" name="frmCategoria" method="post">
            <div class="campos">
                <label>Categoria:</label>
                <input type="text" name='txtNomeCategoria' value="<?=$nome?>">
            </div>
            <div class="btn">
                <input type="submit" value="Salvar">
            </div>
        </form>
    </div>
    <table>
            <tr>
                <td>Categoria</td>
                <td>Opções</td>
            </tr>
            <?php
                //import do arquivo da controller que lista os dados
                require_once ('controller/controllerCategorias.php');
                $listCategoria = listarCategoria();

                //Laço para listar os dados do array
                foreach($listCategoria as $item){
            ?>
            <tr>
                <td><?=$item['nome']?></td>
                <td>
                    <a href="router.php?component=categoria&action=buscar&id=<?=$item['id']?>">
                        <img src="img/editar.png" alt="lupa" title="editar">
                    </a>

                    <a onclick="return confirm('Deseja mesmo excluir essa categoria?')" href="router.php?component=categoria&action=deletar&id=<?=$item['id']?>">
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