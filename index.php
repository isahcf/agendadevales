<?php
    include_once "conexao.php";
    include_once "funcoes.php";

if(isset($_GET['acao']) && $_GET ['acao'] == 'deletar'){
    $id = $_GET['id'];

    $conexaoComBanco = abrirBanco();
    $sql = "DELETE FROM vales WHERE id = $id";


    if($conexaoComBanco->query($sql) === TRUE){
        echo "Vale excluido com sucesso";
    }else{
        echo "Erro ao digitar o vale:" .$conexaoComBanco->error;
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
        <h2>Lista de Vales</h2>
        <table>
            <thead>
                <tr>
                    <th>id</th>
                    <th>Descricao</th>
                    <th>Valor</th>
                    <th>Data do vale</th>
                    <th>Atualizado em</th>
                    <th>Criado em</th>
                </tr>
            </thead>
            <tbody>
                
                <?php
                
                $conexaoComBanco = abrirBanco();

                $ql = "SELECT * FROM vales;";

                $result = $conexaoComBanco->query($ql);
              
                if($result->num_rows > 0){

                    while ($registro = $result->fetch_assoc()){
                ?>
                    <tr>
                        <td><?=$registro ['id']?></td>
                        <td><?=$registro ['descricao']?></td>
                        <td><?=$registro ['valor_decimal']?></td>
                        <td><?=$registro ['datadVale']?></td>
                        <td><?=$registro ['atualizado_em']?></td>
                        <td><?=$registro ['criado_em']?></td>
                        <td>
                            <a href="editar.php?id=<?=$registro ['id']?>"><button>Editar</button></a>
                           
                            <a href="?acao=deletar&id=<?=$registro ['id']?> 
                            "onclick="return confirm('Tem certeza que deseja excluir?')"><button>Excluir</button></a>
                        </td>
                    </tr>
                <?php
                    }

                } else {
                    echo("<tr><td colspan = '6'>Nenhum registro para exibir</td></tr>");
                }

                ?>
               
               
            </tbody>
        </table>
    </section>
</body>
</html>