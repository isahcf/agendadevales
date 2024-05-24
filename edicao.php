<?php
    include_once "conexao.php";
    include_once "funcoes.php";

    if(isset($_GET['id']) && $_GET['id'] > 0){
        $id = $_GET['id'];

        $conexaoComBanco = abrirBanco();


        $pegarDados = $conexaoComBanco->prepare("SELECT * FROM vales WHERE id= ?");
        $pegarDados->bind_param("i", $id);
        $pegarDados->execute();
        $result = $pegarDados->get_result();


        if($result->num_rows == 1){
            $registro = $result->fetch_assoc();


        }

    }

    if($_SERVER['REQUEST_METHOD'] == "POST"){


        $id = $_POST['id'];
        $descricao = $_POST ['descricao'];
        $valor_decimal = $_POST ['valor_decimal'];
        $datadovale = $_POST ['datadVale'];
        $atualizado_em = $_POST ['atualizado_em'];
        $criado_em = $_POST ['criado_em'];


        $conexaoComBanco = abrirBanco();

        $sql = "UPDATE vales SET descricao = '$descricao', valor_decimal = '$valor_decimal', datadVale = '$datadovale', 
        atualizado_em = '$atualizado_em', criado_em = '$criado_em' WHERE id = $id";
       
           
         if($conexaoComBanco->query($sql) === TRUE)   {
            echo "Vale atualizado com sucesso no banco de dados";
         } else{
            echo ":(Erro ao salvar no banco de dados" . $conexaoComBanco->error;
         }
          
         fecharBanco($conexaoComBanco);
                
        }
?>




<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GERENCIAR VALES</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <header>
        <h1>CADASTRAR VALES</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="cadastrar.php">Cadastrar</a></li>
            </ul>
        </nav>
    </header>
    <section>
        <h2>Cadastro de vales</h2>
        <form action="" method="POST">
       
        <label for="descricao">DESCRIÇÃO</label>
        <input type="text" name="descricao" value="<?= $registro['descricao']?>" require>
       
        <label for="valor_decimal">VALOR</label>
        <input type="decimal" name="valor_decimal" value="<?= $registro['valor_decimal']?>" require>
      
        <label for="datadVale">DATA DO VALE</label>
        <input type="date" name="datadVale" value="<?= $registro['datadVale']?>" require>

        <label for="atualizado_em">ATUALIZADO EM</label>
        <input type="datetime" name="atualizado_em" value="<?= $registro['atualizado_em']?>" require>

        <label for="criado_em">CRIADO EM</label>
        <input type="datetime" name="criado_em" value="<?= $registro['criado_em']?>" require>


        <input type="hidden" name="id" value="<?= $registro['id']?>">


        <button type="submit">Atualizar Vales</button>

        </form>
    </section>
</body>
</html>