<?php
     require_once('CMS.php');

     $form= (string) "router.php?component=produto&action=inserir";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="CSS/produtos.css">
     <title>Games</title>
</head>
<body>
<main>
    <div class="form-usuario">
        <form action="<?=$form?>" name="frmUsuario" method="post">
            <div class="campos">
                <label>Nome do produto:</label>
                <input type="text" name='txtProduto' value="<?=isset($nome)?$nome:null?>">
            </div>
            <div class="campos">
                <label>Valor:</label>
                <input type="text" name='txtValor' value="">
            </div>
            <div class="campos">
                <label>Desconto em %:</label>
                <input type="text" name='txtDesconto' value="">
            </div>
            <div class="campos">
                <label>Foto do produto:</label>
                <input type="file" name='fileImagem' value="">
            </div>
            <div class="campos">
                <label> Descrição</label>
                <textarea name="txtDesc" id="" cols="40" rows="7"></textarea>
            </div>
            <div class="btn">
                <input type="submit" value="Salvar">
            </div>
        </form>
    </div>

    <table>
            <tr>
                <td>Jogo</td>
                <td>Valor</td>
                <td>Desconto</td>
                <td>Imagem</td>
                <td>Opções</td>
            </tr>
            <?php
                //import do arquivo da controller
                require_once ('controller/controllerProdutos.php');
                $listProduto = listarProdutos();
                
                //Laço para listar os dados do array
                foreach($listProduto as $item){
            ?>
            <tr>
                <td><?=$item['nome']?></td>
                <td><?=$item['preco']?></td>
                <td><?=$item['desconto']?></td>
                <td><?=$item['foto']?></td>
                <td>

                        <a href="router.php?component=produto&action=buscar&id=<?=$item['id']?>">
                            <img src="img/editar.png" alt="lupa" title="editar">
                        </a>

                        <a onclick="return confirm('Deseja mesmo excluir esse usuario?')" href="router.php?component=produto&action=deletar&id=<?=$item['id']?>">
                            <img src="img/lixo.png" alt="lixo" title="excluir">
                        </a>
                       
                    
                  
            </td> 
            </tr>
            <?php
                }
            ?>
        </table>
</body>
</html>