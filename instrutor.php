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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="style.css">
    <title>Instrutores</title>
</head>
<body class="instrutor_fundo">
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
    <h2>Instrutores</h2>

    <table class="tabela-instrutores">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Especialidade</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($linha = $resultado->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $linha["instrutor_nome"]; ?></td>
                <td><?php echo $linha["instrutor_especialidade"]; ?></td>
                <td>
                    <a href="instrutor.php?editar=<?php echo urlencode($linha["instrutor_nome"]); ?>" class="editar-btn">Editar</a> |
                    <a href="javascript:void(0);" onclick="confirmarExclusao('<?php echo urlencode($linha["instrutor_nome"]); ?>')" class="excluir-btn">Excluir</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<script>
    function confirmarExclusao(nome) {
        Swal.fire({
            title: 'Tem certeza que deseja excluir?',
            text: "Você não poderá reverter essa ação!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sim, excluir!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'instrutor.php?excluir=' + nome;
            }
        });
    }
</script>

            </tr>
        <?php ?>
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
