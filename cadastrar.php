<?php

    include_once 'conexao.php';
    include_once 'funcoes.php';

    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        //Captura os dados digitando em form e salva em variaveis
        //para facilitar a manipulação dos dados 
        $nome= $_POST['nome'];
        $sobrenome=$_POST['sobrenome'];
        $nascimento=$_POST['nascimento'];
        $endereco=$_POST['endereco'];
        $telefone=$_POST['telefone'];
        $email=$_POST['email'];
        $cpf=$_POST['cpf'];
        $estado_civil=$_POST['estado_civil'];

        //vamos abrir a conexao com o banco de dados 
        $conexaoComBanco = abrirBanco();
        
        //vamos criar o SQL para realizar o insert dos dados no BD 
        $sql =" INSERT INTO pessoas(nome, sobrenome, nascimento, endereco, telefone)
            VALUES('$nome', '$sobrenome', '$nascimento', '$endereco', '$telefone', '$email', '$cpf', '$estado_civil',)";

        if ($conexaoComBanco->query($sql) === TRUE){

            echo ":) Sucesso ao cadastrar o contato :)";
        }else{
            echo":( Erro ao cadastrar o contato :(";

        }
            

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
    <h2>Cadastrar contato</h2>
    <form action ="" method="post" enctype="multipart/form-data">

        <label for=nome>Nome</label>
        <input type="text" id="nome" name="nome" required placeholder="Digite seu nome:">

        <label for=sobrenome>Sobrenome</label>
        <input type="text" id="sobrenome" name="sobrenome" required placeholder="Digite seu sobrenome: ">

        <label for=nascimento>Nascimento</label>
        <input type="date" id="nascimento" name="nascimento" required placeholder="Digite sua data de nascimento: ">

        <label for=endereco>Endereco</label>
        <input type="text" id="endereco" name="endereco" required placeholder="Digite seu endereço:">

        <label for=telefone>Telefone</label>
        <input type="text" id="telefone" name="telefone" required placeholder="Digite seu telefone: ">

        <label for=email>E-mail</label>
        <input type="email" id="email" name="email" required placeholder="Digite seu E-mail ">

        <label for=cpf>CPF</label>
        <input type="cpf" id="cpf" name="cpf" required placeholder="Digite seu CPF ">

        <label for=estado_civil>Estado Civil</label>
        <input type="text" id="estado_civil" name="estado_civil" required placeholder="Qual seu Estado Civil ">

        

        <button type="submit">Cadastrar</button> 






    </form>
</section>

</body>
</html>