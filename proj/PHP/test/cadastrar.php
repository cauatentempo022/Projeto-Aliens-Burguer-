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

// Verifica se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtém os dados do formulário
    $nome = $_POST['nome'];
    $login = $_POST['login'];
    $senha = $_POST['senha'];
    $perfil = $_POST['perfil'];

    // Prepara e executa a consulta para inserir o novo usuário no banco de dados
    $sql = "INSERT INTO usuarios (nome, login, senha, perfil) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nome, $login, $senha, $perfil);

    // Executa a inserção e verifica se deu certo
    if ($stmt->execute()) {
        echo "Usuário cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar o usuário: " . $conn->error;
    }
}
?>

<!-- Formulário de cadastro de usuário -->
<form method="POST" action="cadastrar.php">
    Nome: <input type="text" name="nome" required><br>
    Login: <input type="text" name="login" required><br>
    Senha: <input type="password" name="senha" required><br>
    Perfil:
    <select name="perfil" required>
        <option value="master">Master</option>
        <option value="usuario">Usuário</option>
    </select><br>
    <button type="submit">Cadastrar</button>
</form>

<!-- Botão para voltar à tela de boas-vindas -->
<a href="master.php">Voltar</a>
