<?php
session_start();
$erro = isset($_SESSION['erro']) ? $_SESSION['erro'] : '';
unset($_SESSION['erro']);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Provinha - Portal do Aluno</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
<header>
    <div id="title">
        <h1>Portal</h1>
        <h1>Do</h1>
        <h1>Aluno</h1>
    </div>
    <ul>
        <li><a href="#">Início</a></li>
        <li><a href="turmas.html">Suas Turmas</a></li>
        <li><a href="professor.html">Corpo Docente</a></li>
        <li><a href="#" id="inscreva-se-btn">Já tem uma conta?</a></li>
    </ul>
</header>
<main>
    <aside>
        <h2><span>Logue</span></h2>
        <h2>Sua Conta</h2>
        <p>Na página do portal do aluno, encontram-se informações cruciais 
            como notas de avaliações, horários de aulas e comunicados 
            importantes da instituição.</p>
        <?php if ($erro) { echo "<p style='color:red;'>$erro</p>"; } ?>
        <h2>Login</h2>
        <form action="login.php" method="post">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required><br><br>

            <label for="tipo_usuario">Tipo de Usuário:</label>
            <select id="tipo_usuario" name="tipo_usuario" required>
                <option value="aluno">Aluno</option>
                <option value="instrutor">Instrutor</option>
            </select><br><br>

            <button type="submit" class="cadastrar">Login</button>
        </form>
    </aside>
</main>
</body>
</html>
