<!-- Flávia Glenda e Julia Conconi -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Página de Login</title>
</head>
<body class="login_fundo">
<div class="formcaixa">
<form class="form">
    <span class="titulo">FitZone</span>
    <span class="subtitulo">Faça seu login!</span>
    <div class="form-container">
      <input type="text" class="input" placeholder="Nome">
			<input type="password" class="input" placeholder="Senha">
    </div>
    <span class="escolha">Como deseja logar?</span>
    <select class="dropdown">
        <option value="aluno">Aluno</option>
        <option value="instrutor">Instrutor</option>
        <option value="admin">Administrador</option>
    </select>
    <a href="home.php" class="botao">Entrar</a>
</form>
