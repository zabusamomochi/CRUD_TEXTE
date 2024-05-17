<?php
//incluir a conexão na pagina e todo o seu conteúdo
include_once 'conexao.php';
include_once 'funcoes.php';

if (isset($_GET['acao']) && $_GET['acao'] == 'excluir') {
    $id = $_GET['id'];

    if($id > 0){
         //Abrir conexao com o banco de dados 
         $conexao = abrirBanco();
         //Preparar um SQL de Exclusão
         $sql = "DELETE FROM pessoas WHERE id = $id";
         //Executar comando no banco
         if($conexao->query($sql) === TRUE){
            echo "<script>alert('Contato excluido com sucesso!)</script>";
         }else{
            echo "Contato excluido com sucesso!";

         }


    }
fecharBanco($conexao);
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>

<body>
    <header>
        <h1>Agenda de Contatos</h1>
        <nav>
            <ul>
                <li><a href="index.php"> Home </a></li>
                <li><a href="cadastrar.php"> Cadastro</a></li>
            </ul>
        </nav>
    </header>
    <section>
        <h2>Lista de contato</h2>
        <table border="1">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Nome</td>
                    <td>Sobrenome</td>
                    <td>Nascimento</td>
                    <td>Endereco</td>
                    <td>Telefone</td>
                    <td>E-mail</td>
                    <td>CPF</td>
                    <td>Estado Civil</td>
                    <td>Ações</td>
                </tr>
            </thead>
            <tbody>

                <?php
                //Abrir conexao com o banco de dados 
                $conexao = abrirBanco();

                //Preparar a consulta SQL para selecionar os dados no BD
                $query = "SELECT id, nome, sobrenome, nascimento, endereco, telefone, email, cpf, estado_civil
                        FROM pessoas";

                //Executar a query(o SQL no banco)


                $result = $conexao->query($query);
                //$registros = $result->fetch_assoc();
                if ($result->num_rows > 0) {
                    //tem registro no banco
                    while ($registros = $result->fetch_assoc()) {
                        // echo "<pre>";
                        // print_r($registros);
                        // echo "</pre>";
                        // exit;
                ?>
                        <tr>
                            <td><?= $registros['id'] ?></td>
                            <td><?= $registros['nome'] ?></td>
                            <td><?= $registros['sobrenome'] ?></td>
                            <td><?= date("d/m/Y", strtotime($registros['nascimento'])) ?></td>
                            <td><?= $registros['endereco'] ?></td>
                            <td><?= $registros['telefone'] ?></td>
                            <td><?= $registros['email'] ?></td>
                            <td><?= $registros['cpf'] ?></td>
                            <td><?= $registros['estado_civil'] ?></td>
                            <td>
                                <a href="editar.php?acao=editar&id=<?= $registros['id'] ?>"><button>Editar</button></a>
                                <a href="?acao=excluir&id=<?= $registros['id'] ?>" onclick="return confirm
                                ('Tem certeza que deseja excluir?');">
                                    <button>Excluir</button></a>
                            </td>

                        </tr>
                    <?php


                    }
                } else {
                    ?>

                    <tr>
                        <td colspan='7'>Nenhum registro encontrado no banco de dados</td>
                    </tr>
                <?php

                }

                //Criar um laço de repetição para preencher a tabela 


                ?>

            </tbody>


        </table>
    </section>
</body>

</html>