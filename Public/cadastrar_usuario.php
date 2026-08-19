<?php

include '../infra/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome_user = $_POST['nome_user'] ?? '';
    $email = $_POST['email'] ?? '';

    $sql = "INSERT INTO usuarios (nome_user, email) VALUES (?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);

    if ($stmt === false) {
        die('Erro ao preparar a consulta: ' . mysqli_error($conexao));
    }

    mysqli_stmt_bind_param($stmt, 'ss', $nome_user, $email);

    if (mysqli_stmt_execute($stmt)) {
        echo "Usuário cadastrado com sucesso!";
        echo "<br><a href='../index.php'>Voltar</a>";
        mysqli_stmt_close($stmt);
        exit();
    } else {
        echo "Erro ao cadastrar usuário: " . mysqli_error($conexao);
    }

    mysqli_stmt_close($stmt);
}

?>