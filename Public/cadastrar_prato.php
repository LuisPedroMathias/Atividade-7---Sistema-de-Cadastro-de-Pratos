<?php

include "../infra/conexao.php";

$nome_prato = $_POST["nome_prato"];
$descricao = $_POST["descricao"];
$preco = $_POST["preco"];
$categoria = $_POST["categoria"];
$nome_user = $_POST["nome_user"];

$sql = "INSERT INTO pratos (nome_prato, descricao, preco, categoria, nome_user) VALUES (?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conexao, $sql);

mysqli_stmt_bind_param($stmt, 'ssdsi', $nome_prato, $descricao, $preco, $categoria, $nome_user);

if ($stmt === false) {
    die("Erro ao preparar a inserção do prato: " . mysqli_error($conexao));
}

 if (mysqli_stmt_execute($stmt)) {
        echo "Prato cadastrado com sucesso!";
        echo "<br><a href='../index.php'>Voltar</a>";
        exit();
    } else {
        echo "Erro ao cadastrar prato: " . mysqli_error($conexao);
    }


mysqli_stmt_execute($stmt);

header("Location: ../index.php");
?>