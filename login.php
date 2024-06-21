<?php
session_start();
require 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $tipo_usuario = $_POST['tipo_usuario'];

    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($senha, $user['senha'])) {
            if ($tipo_usuario == 'aluno') {
                $sql_aluno = "SELECT * FROM alunos WHERE id_usuario = " . $user['id_usuario'];
                $result_aluno = $conn->query($sql_aluno);

                if ($result_aluno->num_rows > 0) {
                    $_SESSION['usuario_id'] = $user['id_usuario'];
                    $_SESSION['tipo_usuario'] = 'aluno';
                    header("Location: dashboard_aluno.php");
                    exit();
                } else {
                    $erro = "Você não tem permissão para acessar esta área.";
                }
            } elseif ($tipo_usuario == 'instrutor') {
                $sql_instrutor = "SELECT * FROM funcionarios WHERE id_usuario = " . $user['id_usuario'];
                $result_instrutor = $conn->query($sql_instrutor);

                if ($result_instrutor->num_rows > 0) {
                    $_SESSION['usuario_id'] = $user['id_usuario'];
                    $_SESSION['tipo_usuario'] = 'instrutor';
                    header("Location: dashboard_instrutor.php");
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

    $_SESSION['erro'] = $erro;
    header("Location: login2.php");
    exit();
}

// Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login2.php");
    exit();
}
?>
