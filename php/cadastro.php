<?php
require_once "conexao.php";

if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['telefone']) && isset($_POST['veiculo']) && isset($_POST['senha'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $veiculo = $_POST['veiculo'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, telefone, veiculo, senha) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nome, $email, $telefone, $veiculo, $senha);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header("Location: index.html");
        exit();
    } else {
        echo "Erro ao cadastrar usuário: " . $stmt->error;
    }
}
?>