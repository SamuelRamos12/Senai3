<?php
session_start();
include('conexao.php');

if (!isset($_SESSION['usuario_id']) || $_SESSION['tipo_usuario'] !== 'instrutor') {
    header("Location: login.php");
    exit();
}

$query = "SELECT alunos.nome, notas.nota FROM notas 
          JOIN alunos ON notas.id_aluno = alunos.mat LIMIT 30";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Instrutor</title>
</head>
<body>
    <h2>Dashboard do Instrutor</h2>
    <table border="1">
        <tr>
            <th>Nome do Aluno</th>
            <th>Nota</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['nome']; ?></td>
            <td><?php echo $row['nota']; ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
