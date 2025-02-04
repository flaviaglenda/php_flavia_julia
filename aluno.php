<!-- Flávia Glenda e Julia Conconi -->

<?php
include 'conexao.php';

$cod = $_GET['cod'] ?? null;
$resultado = null;

if (!empty($cod)) {
    $sql = "SELECT * FROM aluno WHERE aluno_cod = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $cod);
    $stmt->execute();
    $resultado = $stmt->get_result()->fetch_assoc();
}

<<<<<<< HEAD
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete_id'])) {  // Excluir aluno
        $cod = $_POST['delete_id'];
        $sql = "DELETE FROM aluno WHERE aluno_cod = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("i", $cod);
        $stmt->execute();
        echo "<script>alert('Aluno excluído com sucesso!'); window.location.href='aluno.php';</script>";
    } 
    elseif (isset($_POST['cod'], $_POST['nome'], $_POST['endereco'], $_POST['telefone'])) {  // Atualizar aluno
        $cod = $_POST['cod'];
        $nome = $_POST['nome'];
        $endereco = $_POST['endereco'];
        $telefone = $_POST['telefone'];

        $sql = "UPDATE aluno SET aluno_nome = ?, aluno_endereco = ?, aluno_telefone = ? WHERE aluno_cod = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("sssi", $nome, $endereco, $telefone, $cod);
        $stmt->execute();
        echo "<script>alert('Dados atualizados com sucesso!'); window.location.href='aluno.php';</script>";
    }
}

// Buscar todos os alunos
=======
>>>>>>> 53b8232a31d896410ecbcbfa987acf14f0d22340
$sql = "SELECT * FROM aluno";
$result = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Alunos</title>
    <link rel="stylesheet" href="style.css">
</head>
<<<<<<< HEAD
<body class="instrutor_fundo">

<header>
    <nav class="navbar">
        <img src="img/logoo.png" alt="Logo" class="logo">
        <ul>
            <li><a href="home.php">Início</a></li>
            <li><a href="aulas.php">Aulas</a></li>
            <li><a href="aluno.php">Alunos</a></li>
            <li><a href="instrutor.php">Instrutores</a></li>
            <li><a class="sair" href="login.php">Sair</a></li>
        </ul>
    </nav>
</header>

<h2 class="titulo">Lista de Alunos</h2>

<table border="1" class="tabela_alunos">
    <tr>
        <th>Nome</th>
        <th>CPF</th>
        <th>Telefone</th>
        <th>Endereço</th>
        <th>Ações</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= htmlspecialchars($row['aluno_nome']) ?></td>
        <td><?= htmlspecialchars($row['aluno_cpf']) ?></td>
        <td><?= htmlspecialchars($row['aluno_telefone']) ?></td>
        <td><?= htmlspecialchars($row['aluno_endereco']) ?></td>
        <td>
        <!-- excluir -->
            <form method="post" style="display:inline;">
                <input type="hidden" name="delete_id" value="<?= $row['aluno_cod'] ?>">
                <button class="excluir_aluno" type="submit" onclick="return confirm('Tem certeza que deseja excluir este aluno?');">Excluir</button>
            </form>

            <!-- atualizar -->
            <form method="post" style="display:inline;">
                <input type="hidden" name="cod" value="<?= $row['aluno_cod'] ?>">
                <input type="text" name="nome" value="<?= htmlspecialchars($row['aluno_nome']) ?>" required>
                <input type="text" name="endereco" value="<?= htmlspecialchars($row['aluno_endereco']) ?>" required>
                <input type="text" name="telefone" value="<?= htmlspecialchars($row['aluno_telefone']) ?>" required>
                <button class="atualizar_aluno" type="submit">Atualizar</button>
            </form>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<?php $conexao->close(); ?>

=======
<body>
        <tr>
            <th>Nome</th>
            <th>CPF</th>
            <th>Telefone</th>
            <th>Endereço</th>
            <th>Modificar</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['aluno_nome']?></td>
            <td><?= $row['aluno_cpf']?></td>
            <td><?= $row['aluno_telefone']?></td>
            <td><?= $row['aluno_endereco']?></td>
            <td>
                <form action="excluir.php" method="post" style="display:inline;">
                    <input type="hidden" name="delete_id" value="<?= $row['aluno_cod'] ?>">
                    <button type="submit">Excluir</button>
                </form>

                <form action="atualizar.php" method="post" style="display:inline;">
                    <input type="hidden" name="update_id" value="<?= $row['aluno_cod'] ?>">
                    <input type="text" name="aluno_nome" value="<?= $row['aluno_nome'] ?>" required>
                    <input type="text" name="aluno_endereco" value="<?= $row['aluno_endereco'] ?>" required>
                    <input type="text" name="aluno_telefone" value="<?= $row['aluno_telefone']?>" required>
                    <button type="submit">Atualizar</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
>>>>>>> 53b8232a31d896410ecbcbfa987acf14f0d22340
</body>
</html>
