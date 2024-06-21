<?php
require 'conexao.php';

$nome = $_POST['nome'];
$data_nascimento = $_POST['data_nascimento'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$senha = password_hash($_POST['senha'], PASSWORD_BCRYPT);
$tipo_usuario = $_POST['tipo_usuario'];
$endereco = $_POST['endereco'];
$cidade = $_POST['cidade'];

// Inserir usuário na tabela usuarios
$sql_usuario = "INSERT INTO usuarios (nome_usuario, data_nascimento, telefone, senha, email)
                VALUES ('$nome', '$data_nascimento', '$telefone', '$senha', '$email')";

if ($conn->query($sql_usuario) === TRUE) {
    $id_usuario = $conn->insert_id;

    if ($tipo_usuario == 'aluno') {
        // Inserir aluno na tabela alunos
        $sql_aluno = "INSERT INTO alunos (nome, endereco, cidade, id_usuario)
                      VALUES ('$nome', '$endereco', '$cidade', '$id_usuario')";

        if ($conn->query($sql_aluno) === TRUE) {
            echo "Aluno cadastrado com sucesso!";
        } else {
            echo "Erro ao cadastrar aluno: " . $conn->error;
        }

    } elseif ($tipo_usuario == 'instrutor') {
        // Definir permissão para instrutor
        $descricao_permissao = "instrutor";
        
        // Inserir permissão na tabela permissao
        $sql_permissao = "INSERT INTO permissao (descricao)
                          VALUES ('$descricao_permissao')";

        if ($conn->query($sql_permissao) === TRUE) {
            $id_permissao = $conn->insert_id;
            
            // Inserir instrutor na tabela funcionarios
            $sql_instrutor = "INSERT INTO funcionarios (nome, data_de_nascimento, email_corporativo, id_usuario, id_permissao)
                              VALUES ('$nome', '$data_nascimento', '$email', '$id_usuario', '$id_permissao')";

            if ($conn->query($sql_instrutor) === TRUE) {
                echo "Instrutor cadastrado com sucesso!";
            } else {
                echo "Erro ao cadastrar instrutor: " . $conn->error;
            }

        } else {
            echo "Erro ao cadastrar permissão: " . $conn->error;
        }
    }

} else {
    echo "Erro ao cadastrar usuário: " . $conn->error;
}

$conn->close();
?>
