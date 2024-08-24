<?php

require_once "conecta.php";


$mensagem = '';


$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$veiculo = filter_var($_POST['veiculo'], FILTER_SANITIZE_STRING);
$senha = $_POST['senha']; 


$stmt = $conn->prepare("SELECT id, nome, email, telefone, veiculo, senha FROM usuarios WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows == 1) {
    
    $stmt->bind_result($id, $nome, $email, $telefone, $veiculo, $hashed_senha);
    $stmt->fetch();

    if (password_verify($senha, $hashed_senha)) {
        
        session_start();

      
        $_SESSION['id'] = $id;
        $_SESSION['nome'] = $nome;
        $_SESSION['email'] = $email;
        $_SESSION['telefone'] = $telefone;
        $_SESSION['veiculo'] = $veiculo;

        $mensagem = "Login bem-sucedido!";
        
        header("Location: test.html");//redirecionando a pagina inicial do app
        exit();
    } else {
        $mensagem = "Senha incorreta!";
    }
} else {
    $mensagem = "Usuário não encontrado!";
}

$stmt->close();
$conn->close();


header("Location: index.html?mensagem=" . urlencode($mensagem));
exit();
?>
