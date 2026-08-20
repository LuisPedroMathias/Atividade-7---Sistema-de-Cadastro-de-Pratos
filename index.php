<?php

include "infra/conexao.php";

$filtro_usuario = isset($_GET["nome_user"]) ? $_GET["nome_user"] : "";

if ($filtro_usuario !== "") {
    $sql = "SELECT idprato, nome_prato, descricao, preco, categoria, nome_user FROM pratos WHERE nome_user = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "s", $filtro_usuario);
    mysqli_stmt_execute($stmt);
    $pratos = mysqli_stmt_get_result($stmt);
} else {
    $pratos = mysqli_query($conexao, "SELECT idprato, nome_prato, descricao, preco, categoria, nome_user FROM pratos");
}

if (!$pratos) {
    die("Erro na consulta: " . mysqli_error($conexao));
}

$usuarios = mysqli_query($conexao, "SELECT nome_user FROM usuarios");

if (!$usuarios) {
    die("Erro na consulta: " . mysqli_error($conexao));
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Cadastro de Pratos</title>
    <link rel="stylesheet" href="style/styles.css">
</head>

<body>
    <header>
        <h1>Sistema de Cadastro de Pratos</h1>
    </header>
    <main>

        <h2>Cadastrar Usuário!</h2>
        <form action="public/cadastrar_usuario.php" method="POST">
            <label for="nome_user">Nome:</label>
            <input type="text" id="nome_user" name="nome_user" required>
            <br>
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required>
            <br>
            <button type="submit">Cadastrar</button>
        </form>

        <h2>Cadastrar Prato!</h2>
        <form action="public/cadastrar_prato.php" method="POST">
            <label for="nome_prato">Nome:</label>
            <input type="text" id="nome_prato" name="nome_prato" required>
            <br>
            <label for="descricao">Descrição:</label>
            <input type="text" id="descricao" name="descricao" required>
            <br>
            <label for="categoria">Categoria:</label>
            <input type="text" id="categoria" name="categoria" required>
            <br>
            <label for="preco">Preço:</label>
            <input type="number" id="preco" name="preco" step="0.01" required>
            <br>
            <label for="nome_user">Usuário:</label>
            <select name="nome_user" id="nome_user" required>
                <?php while ($usuario = mysqli_fetch_assoc($usuarios)) { ?>
                    <option value="<?php echo $usuario["nome_user"] ?>"><?php echo $usuario["nome_user"] ?></option>
                <?php } ?>
            </select>
            <br>
            <button type="submit">Cadastrar</button>
        </form>

        <div>
            <h2>Pratos Cadastrados</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Categoria</th>
                    <th>Preço</th>
                    <th>Usuário</th>
                    <th>Ações</th>
                </tr>

                <form action="" method="GET">
                    <label for="nome_user_filtro">Usuário:</label>
                    <select name="nome_user" id="nome_user_filtro">
                        <option value="">Todos</option>
                        <?php
                        mysqli_data_seek($usuarios, 0);
                        while ($usuario = mysqli_fetch_assoc($usuarios)) {
                        ?>
                            <option value="<?php echo htmlspecialchars($usuario["nome_user"]) ?>" <?php echo ($usuario["nome_user"] == $filtro_usuario) ? "selected" : "" ?>>
                                <?php echo htmlspecialchars($usuario["nome_user"]) ?>
                            </option>
                        <?php } ?>
                    </select>
                    <button type="submit">Filtrar</button>
                </form>

                <?php while ($prato = mysqli_fetch_assoc($pratos)) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($prato["idprato"]) ?></td>
                        <td><?php echo htmlspecialchars($prato["nome_prato"]) ?></td>
                        <td><?php echo htmlspecialchars($prato["descricao"]) ?></td>
                        <td><?php echo htmlspecialchars($prato["categoria"]) ?></td>
                        <td><?php echo number_format($prato["preco"], 2, ',', '.') ?></td>
                        <td><?php echo htmlspecialchars($prato["nome_user"]) ?></td>
                        <td>
                            <a href="public/editar.php?idprato=<?php echo urlencode($prato["idprato"]) ?>">Editar</a>
                            <a href="public/deletar.php?idprato=<?php echo urlencode($prato["idprato"]) ?>">Excluir</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </main>
    <footer>

    </footer>
</body>

</html>