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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete_id'])) { 
        $cod = $_POST['delete_id'];
        $sql = "DELETE FROM aluno WHERE aluno_cod = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("i", $cod);
        $stmt->execute();
        echo "<script>alert('Aluno excluído com sucesso!');</script>";
    } 
    elseif (!empty($cod) && isset($_POST['nome'], $_POST['endereco'], $_POST['telefone'])) { 
        $nome = $_POST['nome'];
        $endereco = $_POST['endereco'];
        $telefone = $_POST['telefone'];
    
        $sql = "UPDATE aluno SET nome = ?, endereco = ?, telefone = ? WHERE aluno_cod = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("sssi", $nome, $endereco, $telefone, $cod);
        echo "<script>alert('Dados atualizados com sucesso!');</script>";
    }
}
$sql = "SELECT * FROM aluno";
$result = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de alunos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <nav class="navbar">
        <ul>
            <li><a href="aulas.php">Aulas</a></li>
            <li><a href="aluno.php">Alunos</a></li>
            <li><a href="instutor.php">Instrutores</a></li>
            <li><a class="sair" href="login.php">Sair</a></li>
        </ul>
    </nav>
    <h2 class="titulo">Lista de alunos</h2>
    <table border="1" class="tabela_alunos">
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
                <form method="post" style="display:inline;">
                    <input type="hidden" name="delete_id" value="<?= $row['aluno_cod'] ?>">
                    <button type="submit">Excluir</button>
                </form>
                <form method="post" style="display:inline;">
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
</body>
</html>

<?php $conexao->close(); ?>