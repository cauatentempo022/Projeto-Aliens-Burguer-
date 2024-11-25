<?php
session_start(); // Inicia a sessão

// Conexão com o banco de dados (MySQL)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projeto";

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se houve erro na conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Variável para armazenar a mensagem de erro ou sucesso
$message = "";

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $senha = $_POST['password'];

    // Verifica se o login existe no banco de dados
    $sql = "SELECT * FROM usuarios WHERE login = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Se o login existir, obtém os dados do usuário
        $row = $result->fetch_assoc();

        // Verifica se a senha inserida corresponde à senha criptografada no banco
        if (password_verify($senha, $row['senha'])) {
            // Login bem-sucedido
            $_SESSION['id'] = $row['id']; // Salva o ID na sessão
            $_SESSION['login'] = $row['login']; // Salva o login na sessão
            $_SESSION['classe'] = $row['classe']; // Salva a classe na sessão

            header('Location: tmenu.php'); // Redireciona para o menu principal
            exit();
        } else {
            $message = "Senha ou Login incorreto!";
        }
    } else {
        $message = "Senha ou Login incorreto!";
    }

    $stmt->close();
}

// Fecha a conexão
$conn->close();
?>

<!DOCTYPE HTML>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Página de Login</title>
    <link rel="stylesheet" href="./CSS/tlogin.css"/>
    <link rel="shortcut icon" href="IMG/icon-aliens.ico" type="image/x-icon">
</head>
<body>
    <header></header>
    <main>
        <div class="form">
            <h1>Faça Seu Login</h1><br>
            <!-- Exibe a mensagem de erro ou sucesso -->
            <?php if (!empty($message)): ?>
                <p style="color:red;"><?php echo $message; ?></p>
            <?php endif; ?>

            <form method="POST">
                <label for="login">Login<input type="text" id="login" name="login" required/></label>
                <label for="password">Senha<input type="password" id="password" name="password" required/></label>
                <input type="submit" value="ENTRAR" class="enter">
                <a href="tcad.php" target="_self">Esqueceu a Senha / Primeiro Acesso</a>
                <a href="tmenu.php" target="_self">Voltar</a>
            </form>           
        </div>   
    </main>    
</body>    
</html>
