<!-- Flávia Glenda e Julia Conconi -->
<?php
include 'conexao.php';

// cancelar aula
if (isset($_GET['excluir'])) {
    $nome = $_GET['excluir'];
    $sql = "DELETE FROM instrutor WHERE instrutor_nome = '$nome'";
    $conexao->query($sql);
    echo "<script>alert('Instrutor excluído!'); window.location='instrutor.php';</script>";
}

// editar aula
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
