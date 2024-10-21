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

// Verifica se foi fornecido um ID de usuário para exclusão
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Exibe a confirmação de exclusão
    echo "<p>Tem certeza de que deseja excluir este usuário?</p>";
    echo "<a href='excluir.php?confirmar=sim&id=$id'>Sim</a> | ";
    echo "<a href='listar.php'>Não</a>";

    // Verifica se a exclusão foi confirmada
    if (isset($_GET['confirmar']) && $_GET['confirmar'] == 'sim') {
        // Exclui o usuário do banco de dados
        $sql = "DELETE FROM usuarios WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "Usuário excluído com sucesso!";
        } else {
            echo "Erro ao excluir o usuário: " . $conn->error;
        }

        // Redireciona para a listagem de usuários
        header('Location: listar.php');
        exit();
    }
}
?>
