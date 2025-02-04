<?php
include 'conexao.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_id'])) {
    $cod = $_POST['update_id'];
    $nome = $_POST['aluno_nome'];
    $endereco = $_POST['aluno_endereco'];
    $telefone = $_POST['aluno_telefone'];

    $sql = "UPDATE aluno SET aluno_nome = ?, aluno_endereco = ?, aluno_telefone = ? WHERE aluno_cod = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("sssi", $nome, $endereco, $telefone, $cod);

    if ($stmt->execute()) {
        echo "<script>alert('Dados atualizados com sucesso!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Erro ao atualizar dados!'); window.location.href='index.php';</script>";
    }
}
?>