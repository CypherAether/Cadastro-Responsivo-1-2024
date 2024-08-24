<?php
session_start();

if (isset($_SESSION['id'])) {
    // Mostrar página inicial com informações do usuário
    echo "Bem-vindo, " . $_SESSION['nome'] . "!";
} else {
    header("Location:index.html");
    exit();
}
?>