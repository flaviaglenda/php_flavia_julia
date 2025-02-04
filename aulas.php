<?php
include 'conexao.php';

$cod_aula = $_GET['cod'] ?? null;
$resultado = null;

// Buscar dados da aula para edição
if (!empty($cod_aula)) {
    $sql = "SELECT * FROM aula 
            INNER JOIN aluno ON aula.fk_aluno_cod = aluno.aluno_cod
            INNER JOIN instrutor ON aula.fk_instrutor_cod = instrutor.instrututor_cod
            WHERE aula_cod = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $cod_aula);
    $stmt->execute();
    $resultado = $stmt->get_result()->fetch_assoc();
}

// Processar exclusão de aula
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
    $cod_aula = $_POST['delete_id'];
    $sql = "DELETE FROM aula WHERE aula_cod = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $cod_aula);
    $stmt->execute();
    echo "<script>
            Swal.fire('Sucesso!', 'Aula excluída!', 'success')
            .then(() => window.location.href='aulas.php');
          </script>";
}

// Processar edição de aula
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tipo_aula'])) {
    $sql = "UPDATE aula SET aula_tipo = ?, aula_data = ?, fk_instrutor_cod = ?, fk_aluno_cod = ? WHERE aula_cod = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("siiii", $_POST['tipo_aula'], $_POST['data_aula'], $_POST['instrutor_cod'], $_POST['aluno_cod'], $cod_aula);
    if ($stmt->execute()) {
        echo "<script>
                Swal.fire('Sucesso!', 'Aula atualizada!', 'success')
                .then(() => window.location.href='aulas.php');
              </script>";
    } else {
        echo "<script>Swal.fire('Erro!', 'Falha ao atualizar a aula.', 'error');</script>";
    }
}

// Buscar todas as aulas
$sql = "SELECT aula.*, aluno.aluno_nome, instrutor.instrutor_nome FROM aula 
        INNER JOIN aluno ON aula.fk_aluno_cod = aluno.aluno_cod
        INNER JOIN instrutor ON aula.fk_instrutor_cod = instrutor.instrututor_cod";
$result = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Aulas</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
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

<h2>Lista de Aulas Agendadas</h2>
<table class="tabela-instrutores">
    <tr>
        <th>Tipo de Aula</th>
        <th>Data</th>
        <th>Instrutor</th>
        <th>Aluno</th>
        <th>Modificar</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= $row['aula_tipo']?></td>
        <td><?= date('d/m/Y', strtotime($row['aula_data']))?></td>
        <td><?= $row['instrutor_nome']?></td>
        <td><?= $row['aluno_nome']?></td>
        <td>
            <form method="post" style="display:inline;">
                <input type="hidden" name="delete_id" value="<?= $row['aula_cod'] ?>">
                <button type="submit" class="excluir-btn">Excluir</button>
            </form>
            <a href="aulas.php?cod=<?= $row['aula_cod'] ?>" class="editar-btn">Editar</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<?php if ($resultado): ?>
<h2>Editar Aula</h2>
<form method="post">
    <label for="tipo_aula">Tipo de Aula</label>
    <select name="tipo_aula" required>
        <option value="Yoga" <?= $resultado['aula_tipo'] == 'Yoga' ? 'selected' : '' ?>>Yoga</option>
        <option value="Musculação" <?= $resultado['aula_tipo'] == 'Musculação' ? 'selected' : '' ?>>Musculação</option>
        <option value="Pilates" <?= $resultado['aula_tipo'] == 'Pilates' ? 'selected' : '' ?>>Pilates</option>
        <option value="Crossfit" <?= $resultado['aula_tipo'] == 'Crossfit' ? 'selected' : '' ?>>Crossfit</option>
        <option value="Corrida" <?= $resultado['aula_tipo'] == 'Corrida' ? 'selected' : '' ?>>Corrida</option>
    </select><br><br>

    <label for="data_aula">Data da Aula</label>
    <input type="date" name="data_aula" value="<?= date('Y-m-d', strtotime($resultado['aula_data'])) ?>" required><br><br>

    <label for="instrutor_cod">Instrutor</label>
    <select name="instrutor_cod" required>
        <?php
        $instrutores = $conexao->query("SELECT * FROM instrutor");
        while ($instrutor = $instrutores->fetch_assoc()):
        ?>
        <option value="<?= $instrutor['instrututor_cod'] ?>" <?= $instrutor['instrututor_cod'] == $resultado['fk_instrutor_cod'] ? 'selected' : '' ?>>
            <?= $instrutor['instrutor_nome'] ?>
        </option>
        <?php endwhile; ?>
    </select><br><br>

    <label for="aluno_cod">Aluno</label>
    <select name="aluno_cod" required>
        <?php
        $alunos = $conexao->query("SELECT * FROM aluno");
        while ($aluno = $alunos->fetch_assoc()):
        ?>
        <option value="<?= $aluno['aluno_cod'] ?>" <?= $aluno['aluno_cod'] == $resultado['fk_aluno_cod'] ? 'selected' : '' ?>>
            <?= $aluno['aluno_nome'] ?>
        </option>
        <?php endwhile; ?>
    </select><br><br>

    <button type="submit">Atualizar Aula</button>
</form>
<?php endif; ?>

</body>
</html>

<?php $conexao->close(); ?>
