<?php

include "infra/conexao.php";
$pratos = mysqli_query($conexao, "SELECT idprato, nome_prato, descricao, preco, categoria, nome_user FROM pratos");

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
            <input type="text" id="nome_user" name="nome_user">
            <br>
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email">
            <br>
            <button type="submit">Cadastrar</button>
        </form>

        <h2>Cadastrar Prato!</h2>
        <form action="public/cadastrar_prato.php" method="POST">
            <label for="nome_prato">Nome:</label>
            <input type="text" id="nome_prato" name="nome_prato">
            <br>
            <label for="descricao">Descrição:</label>
            <input type="text" id="descricao" name="descricao">
            <br>
            <label for="categoria">Categoria:</label>
            <input type="text" id="categoria" name="categoria">
            <br>
            <label for="preco">Preço:</label>
            <input type="float" id="preco" name="preco">
            <br>
            <label for="nome_user">Usuário:</label>
            <select name="nome_user" id="nome_user">
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
                    <th>Usuário</th>
                    <th>Ações</th>
                </tr>
                <?php while ($prato = mysqli_fetch_assoc($pratos)) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($prato["idprato"]) ?></td>
                        <td><?php echo htmlspecialchars($prato["nome_prato"]) ?></td>
                        <td><?php echo htmlspecialchars($prato["descricao"]) ?></td>
                        <td><?php echo htmlspecialchars($prato["categoria"]) ?></td>
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