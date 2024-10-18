<?php
// Inicia a sessão
session_start();
// Verifica se o usuário tem perfil 'master', se não, redireciona para a página de login
if ($_SESSION['perfil'] != 'master') {
    header('Location: login.php');
    exit();
}

// Inclui o arquivo de conexão com o banco de dados
include 'conexao.php';

// Consulta para obter todos os usuários
$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);

// Verifica se há usuários no banco de dados
if ($result->num_rows > 0) {
    // Exibe uma lista de usuários com opções de edição e exclusão
    while ($row = $result->fetch_assoc()) {
        echo "ID: " . $row['id'] . " - Nome: " . $row['nome'] . " - Login: " . $row['login'] . " - Perfil: " . $row['perfil'];
        echo " <a href='editar.php?id=" . $row['id'] . "'>Editar</a>";
        echo " <a href='excluir.php?id=" . $row['id'] . "'>Excluir</a><br>";
    }
} else {
    echo "Nenhum usuário encontrado.";
}
?>

<!-- Link para voltar à tela de boas-vindas -->
<a href="master.php">Voltar</a>
