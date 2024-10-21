<?php
// Inicia a sessão
session_start();
// Verifica se o usuário tem perfil 'master', se não, redireciona para a página de login
if ($_SESSION['perfil'] != 'master') {
    header('Location: login.php');
    exit();
}

// Exibe uma mensagem de boas-vindas para o administrador
echo "<h1>Bem-vindo, " . $_SESSION['nome'] . "!</h1>";
?>

<!-- Link para cadastrar novos usuários -->
<a href="cadastrar.php">Cadastrar Usuário</a><br>
<!-- Link para listar os usuários cadastrados -->
<a href="listar.php">Listar Usuários</a><br>
<!-- Link para encerrar a sessão -->
<a href="logout.php">Encerrar Sessão</a>
