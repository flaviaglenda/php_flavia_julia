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
</body>
</html>

<?php $conexao->close(); ?>