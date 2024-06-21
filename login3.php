<?php
session_start();
require 'conexao.php';

// Processamento do login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $tipo_usuario = $_POST['tipo_usuario'];

    // Verificar se o usuário existe
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verificar a senha
        if (password_verify($senha, $user['senha'])) {
            if ($tipo_usuario == 'aluno') {
                // Verificar se o usuário é um aluno
                $sql_aluno = "SELECT * FROM alunos WHERE id_usuario = " . $user['id_usuario'];
                $result_aluno = $conn->query($sql_aluno);

                if ($result_aluno->num_rows > 0) {
                    $_SESSION['usuario_id'] = $user['id_usuario'];
                    $_SESSION['tipo_usuario'] = 'aluno';
                    header("Location: login.php?area=aluno");
                    exit();
                } else {
                    $erro = "Você não tem permissão para acessar esta área.";
                }
            } elseif ($tipo_usuario == 'instrutor') {
                // Verificar se o usuário é um instrutor
                $sql_instrutor = "SELECT * FROM funcionarios WHERE id_usuario = " . $user['id_usuario'];
                $result_instrutor = $conn->query($sql_instrutor);

                if ($result_instrutor->num_rows > 0) {
                    $_SESSION['usuario_id'] = $user['id_usuario'];
                    $_SESSION['tipo_usuario'] = 'instrutor';
                    header("Location: login.php?area=instrutor");
                    exit();
                } else {
                    $erro = "Você não tem permissão para acessar esta área.";
                }
            }
        } else {
            $erro = "Senha incorreta.";
        }
    } else {
        $erro = "Usuário não encontrado.";
    }
}

// Processamento de logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="login.css" rel="stylesheet">
    <link href="fonts.css" rel="stylesheet">
    <link href="media.css" rel="stylesheet">
    <title>Provinha</title>
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
            <a href="turmas.html"><li>Suas Turmas</li></a>
            <a href="professor.html"><li>Corpo Docente</li></a>
            <a href="#" id="inscreva-se-btn"><li>Já tem uma conta?</li></a>
        </ul>
    </header>

    <main>
        <aside>
            <h2><span>Logue</span></h2>
            <h2> Sua Conta</h2>
            <p>Na página do portal do aluno, encontram-se informações cruciais 
                como notas de avaliações, horários de aulas e comunicados 
                importantes da instituição. É um recurso fundamental para 
                estudantes se manterem atualizados sobre seu desempenho 
                acadêmico e eventos acadêmicos. 
                A interface intuitiva facilita a navegação e o acesso rápido às 
                informações necessárias para o dia a dia universitário.</p>
    <?php if (isset($erro)) { echo "<p style='color:red;'>$erro</p>"; } ?>
    <?php if (isset($_SESSION['usuario_id'])): ?>
        <?php if ($_SESSION['tipo_usuario'] == 'aluno'): ?>
            <h2>Bem-vindo, Aluno!</h2>
            <p>Esta é a área exclusiva para alunos.</p>
            <a href="login.php?logout=true">Sair</a>
        <?php elseif ($_SESSION['tipo_usuario'] == 'instrutor'): ?>
            <h2>Bem-vindo, Instrutor!</h2>
            <p>Esta é a área exclusiva para instrutores.</p>
            <a href="login.php?logout=true">Sair</a>
        <?php endif; ?>
    <?php else: ?>
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
    <?php endif; ?>
</body>
</html>
