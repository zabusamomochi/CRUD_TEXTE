<?php

    include_once 'conexao.php';
    include_once 'funcoes.php';

    if(isset($_GET['acao']) && $_GET['acao'] == 'editar'){

        //if ternário
        $id = isset($_GET['id']) ? $_GET['id'] : 0;

        //Vamos abrir a conexao com o banco de dados
        $conexaoComBanco = abrirBanco();

        $sql = "SELECT * FROM pessoas WHERE id = ?";
        //Preparar o SQL para consultar o id no banco de dados
        $pegarDados = $conexaoComBanco->prepare($sql);
        //Substituir o ????
        $pegarDados->bind_param("i", $id);
        //Executar o SQL que preparamos
        $pegarDados ->execute();
        $result = $pegarDados->get_result();

        if($result->num_rows == 1){
            $registro = $result->fetch_assoc();
        }else{
            echo "Nenhum registro encontrado";
            exit;
        }

        $pegarDados->close();
        fecharBanco($conexaoComBanco);

    }
    IF ($_SERVER['REQUEST_METHOD'] == "POST"){
        //dd($POST);
        $nome= $_POST['nome'];
        $sobrenome=$_POST['sobrenome'];
        $nascimento=$_POST['nascimento'];
        $endereco=$_POST['endereco'];
        $telefone=$_POST['telefone'];
        $telefone=$_POST['email'];
        $telefone=$_POST['cpf'];
        $telefone=$_POST['estado_civil'];

        $conexaoComBanco = abrirBanco();

        $sql ="UPDATE pessoas SET nome = '$nome', sobrenome = '$sobrenome',
        nascimento = '$nascimento', endereco = '$endereco', telefone = '$telefone', '$email', '$cpf', '$estado_civil',
        WHERE id = $id";

        if ($conexaoComBanco->query($sql) === TRUE){
            echo "Sucesso ao atualizar o contato";
        }else{
            echo "Erro ao atualizar o contato";
        }
        fecharBanco($conexaoComBanco);
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
                <li><a href = "index.php" > Home </a></li>
                <li><a href = "cadastrar.php" > Cadastro</a></li>
            </ul>
        </nav>
    </header>
    
<section>
    <h2>Atualizar contato</h2>
    <form action ="" method="post" enctype="multipart/form-data">

        <label for=nome>Nome</label>
        <input type="text" id="nome" name="nome" value="<?= $registro['nome']?>" required placeholder="Digite seu nome:">

        <label for=sobrenome>Sobrenome</label>
        <input type="text" id="sobrenome" name="sobrenome"  value="<?= $registro['sobrenome']?>" required placeholder="Digite seu sobrenome: ">

        <label for=nascimento>Nascimento</label>
        <input type="date" id="nascimento" name="nascimento"  value="<?= $registro['nascimento']?>" required placeholder="Digite sua data de nascimento: ">

        <label for=endereco>Endereco</label>
        <input type="text" id="endereco" name="endereco"  value="<?= $registro['endereco']?>" required placeholder="Digite seu endereço:">

        <label for=telefone>Telefone</label>
        <input type="text" id="telefone" name="telefone"  value="<?= $registro['telefone']?>" required placeholder="Digite seu telefone: ">

        <label for= email>E-mail</label>
        <input type="email" id=" email" name="email"  value="<?= $registro['email']?>" required placeholder="Digite seu email: ">


        <label for=cpf>CPF</label>
        <input type="cpf" id="cpf" name="cpf"  value="<?= $registro['cpf']?>" required placeholder="Digite seu telefone: ">


        <label for=estado_civil>Estado Civil</label>
        <input type="text" id="estado_civil" name="estado_civil"  value="<?= $registro['estado_civil']?>" required placeholder="Digite seu telefone: ">


        <input type="hidden" name="id" value="<?= $registro['id'] ?>">

        <button type="submit">Atualizar</button> 

    </form>
</section>

</body>
</html>