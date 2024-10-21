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

// Verifica se foi fornecido um ID de usuário para edição
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtém as informações do usuário a ser editado
    $sql = "SELECT * FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
}

// Verifica se o formulário foi submetido para atualizar as informações do usuário
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $login = $_POST['login'];
    $perfil = $_POST['perfil'];

    // Atualiza os dados do usuário no banco de dados
    $sql = "UPDATE usuarios SET nome = ?, login = ?, perfil = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $nome, $login, $perfil, $id);

    if ($stmt->execute()) {
        echo "Usuário atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar o usuário: " . $conn->error;
    }
}
?>

<!-- Formulário de edição de usuário -->
<form method="POST" action="editar.php?id=<?php echo $id; ?>">
    Nome: <input type="text" name="nome" value="<?php echo $user['nome']; ?>" required><br>
    Login: <input type="text" name="login" value="<?php echo $user['login']; ?>" required><br>
    Perfil:
    <select name="perfil" required>
        <option value="master" <?php if ($user['perfil'] == 'master') echo 'selected'; ?>>Master</option>
        <option value="usuario" <?php if ($user['perfil'] == 'usuario') echo 'selected'; ?>>Usuário</option>
    </select><br>
    <button type="submit">Atualizar</button>
</form>

<!-- Link para voltar à tela de listagem -->
<a href="listar.php">Voltar</a>
