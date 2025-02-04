<?php
include 'conexao.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
    $cod = $_POST['delete_id'];

    $sql = "DELETE FROM aluno WHERE aluno_cod = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $cod);

    if ($stmt->execute()) {
        echo "<script>alert('Aluno excluído com sucesso!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Erro ao excluir aluno!'); window.location.href='index.php';</script>";
    }
}
?>