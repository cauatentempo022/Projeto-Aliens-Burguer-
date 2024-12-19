<?php
session_start();

// Conectar ao banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projeto";

$conn = new mysqli($servername, $username, $password, $dbname);

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $senha = $_POST['password'];

    // Verificar se o login existe no banco de dados
    $sql = "SELECT * FROM usuarios WHERE login = '$login'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verificar senha
        if (password_verify($senha, $row['senha'])) {
            // Salvar informações do usuário na sessão
            $_SESSION['id'] = $row['id'];
            $_SESSION['classe'] = $row['classe'];

            // Redirecionar para o 2FA
            header('Location: 2fa.php');
            exit();
        } else {
            $message = "Senha incorreta!";
        }
    } else {
        $message = "Login não encontrado!";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login</title>
    <link rel="shortcut icon" href="IMG/icon-aliens.ico" type="image/x-icon">
    <link rel="stylesheet" href="./CSS/tlogin.css">
</head>
<body>
    <div class="form">
        <h1>Login</h1>
        <form method="POST">
            <label for="login">Usuário:</label>
            <input type="text" id="login" name="login" required>
            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" required>
            <button class="enter">Entrar</button>
            <a href="tcad.php" target="_self">Esqueceu a Senha / Primeiro Acesso</a>
            <?php if (!empty($message)): ?>
                <p style="color: red;"><?php echo $message; ?></p>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>
