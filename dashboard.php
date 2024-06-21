<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$tipo_usuario = $_SESSION['tipo_usuario'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="dashboard.css" rel="stylesheet">
    <link href="login.css" rel="stylesheet">
    <link href="fonts.css" rel="stylesheet">
    <link href="media.css" rel="stylesheet">
    <title>Área Restrita</title>
</head>
<body>
<header>
    <div id="title">
        <h1>Portal</h1>
        <h1>Do</h1>
        <h1>Aluno</h1>
    </div>
    <ul>
        <a href="#"><li>Início</li></a>
        <?php if ($tipo_usuario == 'instrutor'): ?>
            <a href="#"><li>notas do alunos</li></a>
        <?php endif; ?>
        <a href="turmas.html"><li>Suas Turmas</li></a>
        <a href="professor.html"><li>Corpo Docente</li></a>
        <a href="login_process.php?logout=true"><li>Sair</li></a>
    </ul>
</header>
<main>
    <aside>
        <?php if ($tipo_usuario == 'aluno'): ?>
            <h2>Bem-vindo, Aluno!</h2>
            <p>Esta é a área exclusiva para alunos.</p>
        <?php elseif ($tipo_usuario == 'instrutor'): ?>
            <h2>Bem-vindo, Instrutor!</h2>
            <p>Esta é a área exclusiva para instrutores.</p>
        <?php endif; ?>
    </aside>
</main>
</body>
</html>
