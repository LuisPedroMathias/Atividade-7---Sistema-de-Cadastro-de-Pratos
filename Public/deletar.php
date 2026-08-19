<?php

include "../infra/conexao.php";

$idprato = $_GET['idprato'];

$stmt = mysqli_prepare($conexao, "DELETE FROM pratos WHERE idprato = ?");
mysqli_stmt_bind_param($stmt, 'i', $idprato);

if (mysqli_stmt_execute($stmt)) {
    echo "Prato excluído com sucesso.";
    echo "<br><a href='../index.php'>Voltar</a>";
} else {
    echo "Erro ao excluir prato: " . mysqli_error($conexao);
}

mysqli_stmt_close($stmt);

?>