<?php
// Inicia a sessão
session_start();
// Inclui o arquivo de conexão com o banco de dados
include 'conexao.php';

// Verifica se o método da requisição é POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtém o login e a senha fornecidos no formulário
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    // Prepara a consulta SQL para verificar o usuário no banco de dados
    $sql = "SELECT * FROM usuarios WHERE login = ? AND senha = ?";
    $stmt = $conn->prepare($sql);
    // Substitui os parâmetros da consulta com os valores fornecidos pelo usuário
    $stmt->bind_param("ss", $login, $senha);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica se as credenciais estão corretas
    if ($result->num_rows > 0) {
        // Se o usuário for encontrado, armazena as informações na sessão
        $user = $result->fetch_assoc();
        $_SESSION['nome'] = $user['nome'];
        $_SESSION['login'] = $user['login'];
        $_SESSION['perfil'] = $user['perfil'];

        // Redireciona para a página adequada de acordo com o perfil do usuário
        if ($user['perfil'] == 'master') {
            header('Location: master.php');
        } else {
            header('Location: usuario.php');
        }
        exit();
    } else {
        // Se as credenciais estiverem incorretas, exibe uma mensagem de erro
        echo "Login ou senha inválidos.";
    }
}
?>

<!-- Formulário de login -->
<form method="POST" action="login.php">
    Login: <input type="text" name="login" required><br>
    Senha: <input type="password" name="senha" required><br>
    <button type="submit">Entrar</button>
</form>
