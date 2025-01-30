<?php
include 'conexao.php';

// excluir instrutor
if (isset($_GET['excluir'])) {
    $nome = $_GET['excluir'];
    $sql = "DELETE FROM instrutor WHERE instrutor_nome = '$nome'";
    $conexao->query($sql);
    echo "<script>alert('Instrutor excluído!'); window.location='instrutor.php';</script>";
}

// editar instrutor
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['atualizar'])) {
    $nomeAntigo = $_POST['nome_antigo'];
    $novoNome = $_POST['nome'];
    $especialidade = $_POST['especialidade'];

    $sql = "UPDATE instrutor SET instrutor_nome='$novoNome', instrutor_especialidade='$especialidade' WHERE instrutor_nome='$nomeAntigo'";
    $conexao->query($sql);
    echo "<script>alert('Instrutor atualizado!'); window.location='instrutor.php';</script>";
}

// lista dos instrutores
$sql = "SELECT * FROM instrutor";
$resultado = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Instrutores</title>
</head>
<body>
<nav class="navbar">
        <ul>
            <li><a href="home.php">Início</a></li>
            <li><a href="aulas.php">Aulas</a></li>
            <li><a href="aluno.php">Alunos</a></li>
            <li><a href="instrutor.php">Instrutores</a></li>
            <li><a class="sair" href="login.php">Sair</a></li>
        </ul>
    </nav>
    <h2>Instrutores</h2>

    <table>
        <tr>
            <th>Nome</th>
            <th>Especialidade</th>
            <th>Ações</th>
        </tr>
        <?php while ($linha = $resultado->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $linha["instrutor_nome"]; ?></td>
                <td><?php echo $linha["instrutor_especialidade"]; ?></td>
                <td>
                    <a href="instrutor.php?editar=<?php echo urlencode($linha["instrutor_nome"]); ?>">Editar</a> |
                    <a href="instrutor.php?excluir=<?php echo urlencode($linha["instrutor_nome"]); ?>" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                </td>
            </tr>
        <?php } ?>
    </table>

    <?php if (isset($_GET['editar'])) {
        $nome = $_GET['editar'];
        $sql = "SELECT * FROM instrutor WHERE instrutor_nome = '$nome'";
        $resultado = $conexao->query($sql);
        $linha = $resultado->fetch_assoc();
    ?>
        <h2>Editar Instrutor</h2>
        <form class="instrutores_form" method="post">
            <input type="hidden" name="nome_antigo" value="<?php echo $linha['instrutor_nome']; ?>">
            <label>Nome:</label>
            <input type="text" name="nome" value="<?php echo $linha['instrutor_nome']; ?>" required><br><br>
            <label>Especialidade:</label>
            <input type="text" name="especialidade" value="<?php echo $linha['instrutor_especialidade']; ?>" required><br><br>
            <input type="submit" name="atualizar" value="Atualizar">
        </form>
    <?php } ?>

</body>
</html>

<?php $conexao->close(); ?>
