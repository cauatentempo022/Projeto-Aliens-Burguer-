<?php
session_start();

// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projeto";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $senha = $_POST['password'];

    // Verifica se o login existe no banco de dados
    $sql = "SELECT * FROM usuarios WHERE login = '$login'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verifica a senha
        if (password_verify($senha, $row['senha'])) {
            // Salva informações do usuário na sessão
            $_SESSION['user_login'] = $row['login'];
            $_SESSION['user_id'] = $row['id'];

            // Redireciona para o 2FA
            header('Location: 2fa.php');
            exit;
        } else {
            $message = "Senha ou Login incorretos!";
        }
    } else {
        $message = "Senha ou Login incorretos!";
    }
}

$conn->close();
?>

<!DOCTYPE HTML>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Página de Login</title>
    <link rel="stylesheet" href="./CSS/tlogin.css"/>
</head>
<body>
    <header></header>
    <main>
        <div class="form">
            <h1>Faça Seu Login</h1><br>
            <?php if (!empty($message)): ?>
                <p style="color:red;"><?php echo $message; ?></p>
            <?php endif; ?>
            <form method="POST">
                <label for="login">Login<input type="text" id="login" name="login" required/></label>
                <label for="password">Senha<input type="password" id="password" name="password" required/></label>
                <input type="submit" value="ENTRAR" class="enter">
                <a href="tcad.php" target="_self">Esqueceu a Senha / Primeiro Acesso</a>
            </form>           
        </div>   
    </main>    
</body>    
</html>
