<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Início</title>
</head>
<body class="pagina-inicio">
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
    <div class="banner"></div>

    <main class="conteudo">
        <h1>O que deseja fazer?</h1>
        <div class="opcoes">
            <a href="aulas.php" class="caixa">
            <img src="img/relogio.png" alt="Horários" class="icon">
                <span>Consultar horários</span>
            </a>
            <a href="aluno.php" class="caixa">
            <img src="img/alunos.png" alt="Alunos" class="icon">
                <span>Área dos alunos</span>
            </a>
            <a href="instrutor.php" class="caixa">
            <img src="img/treinador-pessoal.png" alt="Instrutores" class="icon">
                <span>Consultar instrutores</span>
            </a>
        </div>
    </main>

    <div class="cards-container">
        <div class="card">
            <div class="topo-card">
                <h2 class="titulo-categoria">Aula de Yoga</h2>
            </div>
            <p class="titulo-card">Treine sua mente e corpo</p>
            <p class="descricao-card">
                Explore os benefícios do Yoga, melhorando flexibilidade, equilíbrio e bem-estar mental.
            </p>
        </div>

        <div class="card">
            <div class="topo-card">
                <h2 class="titulo-categoria">Treino Funcional</h2>
            </div>
            <p class="titulo-card">Aumente sua resistência</p>
            <p class="descricao-card">
                Um treino dinâmico para fortalecer seu corpo com exercícios variados e eficientes.
            </p>
        </div>

        <div class="card">
            <div class="topo-card">
                <h2 class="titulo-categoria">Musculação</h2>
            </div>
            <p class="titulo-card">Força e definição</p>
            <p class="descricao-card">
                Ganhe massa muscular e melhore sua força com treinos específicos de musculação.
            </p>
        </div>

        <div class="card">
            <div class="topo-card">
                <h2 class="titulo-categoria">Corrida ao Ar Livre</h2>
            </div>
            <p class="titulo-card">Aumente sua resistência</p>
            <p class="descricao-card">
                Corra ao ar livre, melhore seu condicionamento e libere endorfinas!
            </p>
        </div>
    </div>
</body>
</html>
