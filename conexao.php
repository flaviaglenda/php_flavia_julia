<!-- Flávia Glenda e Júlia Conconi -->
<?php

$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'db_academia';

$conexao = new mysqli($hostname, $username,  $password, $database);

if ($conexao->connect_error) {
    die("Conexão falhou:  ". $conexao->connect_error);
}

echo "Conexão bem-sucedida!" . "</br></br>";

if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        echo $linha['nome'] . "<br>";
    }
} else {
    echo "Nenhum resultado encontrado.";
}

$conexao->close();
?>