<?php
session_start();
include('conexao.php');

if (!isset($_SESSION['usuario_id']) || $_SESSION['tipo_usuario'] !== 'aluno') {
    header("Location: login.php");
    exit();
}

// Verificar se a tabela turmas existe antes de executar a consulta
$query = "SELECT * FROM turmas WHERE id_aluno = " . $_SESSION['usuario_id'];
$result = mysqli_query($conn, $query);

// Verificar se houve erro na consulta
if (!$result) {
    die("Erro na consulta ao banco de dados: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Aluno</title>
</head>
<body>
    <h2>Minhas Turmas</h2>
    <ul>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <li><?php echo $row['nome_turma']; ?></li>
        <?php } ?>
    </ul>
</body>
</html>
