<?php
    include_once "conexao.php";
    //echo "<pre>";
    //print_r($_POST);
    //echo "</pre>";
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        //echo "tem algo que foi enviado pelo formulario"
        $descricao = $_POST ['descricao'];
        $valor_decimal = $_POST ['valor_decimal'];
        $datadVale = $_POST ['datadVale'];
        $atualizado_em = $_POST ['atualizado_em'];
        $criado_em = $_POST ['criado_em'];


        $conexaoComBanco = abrirBanco();

        $sql = "insert into vales (descricao, valor_decimal, datadVale, atualizado_em, criado_em)
                values ('$descricao', '$valor_decimal', '$datadVale', '$atualizado_em', '$criado_em')";

           
         if($conexaoComBanco->query($sql) === TRUE)   {
            echo "Vale salvo com sucesso no banco de dados";
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
        <form action="cadastrar.php" method="POST">
       
        <label for="descricao">DESCRIÇÃO</label>
        <input type="text" name="descricao" require>
       
        <label for="valor_decimal">VALOR</label>
        <input type="decimal" name="valor" require>
      
        <label for="datadVale">DATA DO VALE</label>
        <input type="date" name="datadVale" require>

        <label for="atualizado_em">ATUALIZADO EM</label>
        <input type="datetime" name="atualizado_em" require>

        <label for="criado_em">CRIADO EM</label>
        <input type="datetime" name="criado_em" require>

        <button type="submit">Salvar</button>

        </form>
    </section>
</body>
</html>