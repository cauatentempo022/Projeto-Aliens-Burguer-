<?php
session_start();

// Conectar ao banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projeto";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar se usuário está logado
if (!isset($_SESSION['id'])) {
    header('Location: tlogin2.php');
    exit();
}

$userLogin = $_SESSION['login'];

// Buscar dados de segurança do usuário
$sql = "SELECT nomeMaterno, cep, dataNascimento FROM usuarios WHERE id = '".$_SESSION['id']."'";
$result = $conn->query($sql);
$userData = $result->fetch_assoc();

// Perguntas e respostas
$questions = [
    'nomeMaterno' => 'Qual é o nome da sua mãe?',
    'cep' => 'Qual é o seu CEP?',
    'dataNascimento' => 'Qual é a sua data de nascimento? (formato: YYYY-MM-DD)'
];

$answers = [
    'nomeMaterno' => strtolower($userData['nomeMaterno']),
    'cep' => $userData['cep'],
    'dataNascimento' => $userData['dataNascimento']
];

// Gerenciar tentativa atual e pergunta
if (!isset($_SESSION['attempts'])) {
    $_SESSION['attempts'] = 0;
    $_SESSION['current_question'] = array_rand($questions);
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $userAnswer = strtolower(trim($_POST['answer']));
    $currentQuestion = $_SESSION['current_question'];

    // Verificar resposta
    if ($userAnswer == strtolower($answers[$currentQuestion])) {
        // Redirecionar para a tela de menu
        header('Location: tmenu.php');
        exit();
    } else {
        // Incrementa as tentativas
        $_SESSION['attempts']++;

        // Registra tentativa no log
        $stmt = $conn->prepare("INSERT INTO log_acoes (usuario_id, acao, horario) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $_SESSION['id'], $action, $timestamp);
        $action = "2FA tentativa incorreta (Pergunta: $currentQuestion)";
        $timestamp = date('Y-m-d H:i:s');
        $stmt->execute();

        // Troca de pergunta após 3 tentativas
        if ($_SESSION['attempts'] >= 3) {
            $_SESSION['attempts'] = 0;
            $_SESSION['current_question'] = array_rand($questions);
        }

        $message = "Resposta incorreta. Tente novamente.";
    }
}

$currentQuestion = $_SESSION['current_question'];
$questionText = $questions[$currentQuestion];

$conn->close();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela do Segundo Fator de Altentificação</title>
    <link rel="stylesheet" href="./CSS/2fa.css">
    <link rel="shortcut icon" href="IMG/icon-aliens.ico" type="image/x-icon">
</head>
<body>
    <div class="form">
        <h1>Verificação de Segurança</h1>
        <p>Responda à pergunta de segurança para continuar.</p>
        <form method="POST">
            <label for="answer"><?php echo $questionText; ?></label>
            <input type="text" id="answer" name="answer" required>
            <button>Enviar</button>
            <?php if (!empty($message)): ?>
                <p style="color: red;"><?php echo $message; ?></p>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>

