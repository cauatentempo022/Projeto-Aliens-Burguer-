<!DOCTYPE HTML>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0 "/>
    <title>Página do Segundo Fator de Autenticação</title>
    <link rel="stylesheet" href="/CSS/teste.css"/>
    <link rel="shortcut icon" href="IMG/icon-aliens.ico" type="image/x-icon">
</head>
<body>

    <?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'login_db');

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

$login = $_SESSION['login'];

// Busca os dados do usuário
$sql = "SELECT nome_mae, data_nascimento FROM usuarios WHERE login = '$login'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

// Sorteia o tipo de 2FA na primeira vez ou quando a autenticação falhar
if (!isset($_SESSION['2fa_type']) || isset($_POST['input_2fa'])) {
    $_SESSION['2fa_type'] = rand(0, 1) == 0 ? 'nome_mae' : 'data_nascimento';
}

// Variável para armazenar o status de autenticação
$authenticated = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input_2fa = $_POST['input_2fa'];

    // Verifica a resposta do 2FA
    if ($_SESSION['2fa_type'] == 'nome_mae' && strtolower($input_2fa) == strtolower($user['nome_mae'])) {
        $authenticated = true;
    } elseif ($_SESSION['2fa_type'] == 'data_nascimento' && $input_2fa == $user['data_nascimento']) {
        $authenticated = true;
    } else {
        // Caso a autenticação falhe, escolhe a outra pergunta
        $_SESSION['2fa_type'] = $_SESSION['2fa_type'] == 'nome_mae' ? 'data_nascimento' : 'nome_mae';
        echo "Autenticação falhou! Tente novamente com uma nova pergunta.<br>";
    }
}

// Se a autenticação for bem-sucedida, exibe a mensagem de boas-vindas e o botão de encerrar sessão
if ($authenticated) {
    echo "Autenticação bem-sucedida! Bem-vindo, " . $login . "<br>";
    echo '<a href="logout.php">Encerrar Sessão</a>';
} else {
    // Exibe o campo de 2FA com base no tipo sorteado, se a autenticação não foi realizada
    if ($_SESSION['2fa_type'] == 'nome_mae') {
        echo '<form method="post" action="2fa.php">
                <label for="input_2fa">Nome da Mãe:</label>
                <input type="text" name="input_2fa" required><br>
                <button type="submit">Verificar</button>
              </form>';
    } else {
        echo '<form method="post" action="2fa.php">
                <label for="input_2fa">Data de Nascimento (YYYY-MM-DD):</label>
                <input type="text" name="input_2fa" required><br>
                <button type="submit">Verificar</button>
              </form>';
    }
}
?>

</body>    
</html>