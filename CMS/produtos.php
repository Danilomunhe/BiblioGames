<?php
     require_once('CMS.php');
     require_once('modulo/config.php');

      //Variavel para carregar o nome da foto
      $foto = (string) null;

     $form= (string) "router.php?component=produto&action=inserir";

     if(session_status()){
        //valida se a variável de sessão dados contatos não está vazia
        if(!empty($_SESSION['dadosProduto'])){
            $id         = $_SESSION['dadosProduto']['id'];
            $nomeProduto       = $_SESSION['dadosProduto']['nomeProduto'];
            $valor   = $_SESSION['dadosProduto']['valor'];
            $desconto    = $_SESSION['dadosProduto']['desconto'];
            $descricao      = $_SESSION['dadosProduto']['descricao'];
            $foto        = $_SESSION['dadosProduto']['foto'];
            $destaque        = $_SESSION['dadosProduto']['destaque'];

            //Mudamos a ação para editar
            $form = "router.php?component=produto&action=editar&id=".$id."&foto=".$foto;

            //Destrói uma variável
            unset($_SESSION['dadosProduto']);
        }
    }

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
        <form action="<?=$form?>" name="frmUsuario" method="post" enctype="multipart/form-data">
            <div class="campos">
                <label>Nome do produto:</label>
                <input type="text" name='txtProduto' value="<?=isset($nomeProduto)?$nomeProduto:null?>">
            </div>
            <div class="campos">
                <label>Valor:</label>
                <input type="text" name='txtValor' value="<?=isset($valor)?$valor:null?>">
            </div>
            <div class="campos">
                <label>Desconto em %:</label>
                <input type="text" name='txtDesconto' value="<?=isset($desconto)?$desconto:null?>">
            </div>
            <div class="campos">
                <label>Foto do produto:</label>
                <input type="file" name='fleFoto' value="">
            </div>
            <div class="campos">
                <label>Destaque:</label>
                <select name="sltDestaque" id="">
                    <option value="1">Sim</option>
                    <option value="0" selected>Não</option>
                </select>
            </div>
            <div class="campos">
                <label> Descrição</label>
                <textarea name="txtDesc" id="" cols="40" rows="7">
                <?=isset($descricao)?$descricao:null?>
                </textarea>
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
                    $foto = $item['foto']   
            ?>
            <tr>
                <td><?=$item['nome']?></td>
                <td><?=$item['preco']?></td>
                <td><?=$item['desconto']?></td>
                <td><img src = "<?=DIRETORIO_FILE_UPLOAD.$foto?>" class="foto"></td>
                <td>

                        <a href="router.php?component=produto&action=buscar&id=<?=$item['id']?>">
                            <img src="img/editar.png" alt="lupa" title="editar">
                        </a>

                        <a onclick="return confirm('Deseja mesmo excluir esse usuario?')" href="router.php?component=produto&action=deletar&id=<?=$item['id']?>&foto=<?=$foto?>">
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