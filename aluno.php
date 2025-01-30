<!-- Flávia Glenda e Julia Conconi -->
<?php

$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'db_academia';

$conexao = new mysqli( $hostname, $username, $password, $database);

if ($conexao->connect_error){
    die('Conexão falhou: ' . $conexao->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['delete_id'])) {
        $id = $_POST['delete_id'];
        $sql = "DELETE FROM aluno WHERE id=$id";
        $conexao->query($sql);
    } elseif (isset($_POST['update_id'])) {
        $id = $_POST['update_id'];
        $aluno_nome = $POST['nome'];
        $aluno_endereco = $POST['endereco'];
        $aluno_telefone = $POST['telefone'];
        $sql = "UPDATE alunos SET nome='$nome', endereco='$endereco', telefone='$telefone' WHERE id=$id";
        $conexao->query($sql);
    }
}

$sql = "SELECT aluno_cod, aluno_nome, aluno_cpf, aluno_telefone, FROM aluno";
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
    <h2>Lista de alunos</h2>
    <table border="1">
        <tr>
            <th>Nome</th>
            <th>CPF</th>
            <th>Telefone</th>
            <th>Ações</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['nome']?></td>
            <td><?= $row['cpf']?></td>
            <td><?= $row['telefone']?></td>
            <td>
                <form method="post" style="display:inline;">
                    <input type="hidden" name="delete_id" value="<?= $row['id'] ?>">
                    <button type="submit">Excluir</button>
                </form>
                <form method="post" style="display:inline;">
                    <input type="hidden" name="update_id" value="<?= $row['id'] ?>">
                    <input type="text" name="nome" value="<?= $row['nome'] ?>" required>
                    <input type="text" name="endereco" placeholder="Endereço" required>
                    <input type="text" name="telefone" value="<?= $row['telefone']?>" required>
                    <button type="submit">Atualizar</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>

<?php $conexao->close(); ?>