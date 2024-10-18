<?php
// Inicia a sessão
session_start();
// Verifica se o usuário tem perfil 'usuario', se não, redireciona para a página de login
if ($_SESSION['perfil'] != 'usuario') {
    header('Location: login.php');
    exit();
}

// Exibe uma mensagem de boas-vindas e as informações do usuário logado
echo "<h1>Bem-vindo, " . $_SESSION['nome'] . "!</h1>";
?>

<!-- Exibe as informações do usuário logado -->
<p>Nome: <?php echo $_SESSION['nome']; ?></p>
<p>Login: <?php echo isset($_SESSION['login']) ? $_SESSION['login'] : 'Login não disponível'; ?></p>

<!-- Link para encerrar a sessão -->
<a href="logout.php">Encerrar Sessão</a>
