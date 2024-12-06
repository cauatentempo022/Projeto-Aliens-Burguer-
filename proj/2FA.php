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

// Redireciona para login se não estiver autenticado
if (!isset($_SESSION['user_login'])) {
    header('Location: tlogin2.php');
    exit;
}

$userLogin = $_SESSION['user_login'];

// Busca dados de segurança do usuário
$sql = "SELECT nomeMaterno, cep, dataNascimento FROM usuarios WHERE login = '$userLogin'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $userData = $result->fetch_assoc();

    // Perguntas e Respostas
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

    // Gerenciar a tentativa atual e pergunta
    if (!isset($_SESSION['attempts'])) {
        $_SESSION['attempts'] = 0;
        $_SESSION['current_question'] = array_rand($questions);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $userAnswer = strtolower(trim($_POST['answer']));
        $currentQuestion = $_SESSION['current_question'];

        // Verifica a resposta
        if ($userAnswer == strtolower($answers[$currentQuestion])) {
            // Registra no log que o acesso foi concluído
            $stmt = $conn->prepare("INSERT INTO log_acoes (usuario_id, acao, horario) VALUES (?, ?, ?)");
            $stmt->bind_param("iss", $_SESSION['user_id'], $action, $timestamp);

            $action = "2FA concluído com sucesso";
            $timestamp = date('Y-m-d H:i:s');
            $stmt->execute();

            unset($_SESSION['attempts'], $_SESSION['current_question']);
            header('Location: tmenu.php'); // Redireciona para a tela principal
            exit;
        } else {
            // Incrementa as tentativas
            $_SESSION['attempts']++;

            // Registra tentativa no log
            $stmt = $conn->prepare("INSERT INTO log_acoes (usuario_id, acao, horario) VALUES (?, ?, ?)");
            $stmt->bind_param("iss", $_SESSION['user_id'], $action, $timestamp);

            $action = "2FA tentativa incorreta (Pergunta: $currentQuestion)";
            $timestamp = date('Y-m-d H:i:s');
            $stmt->execute();

            // Troca de pergunta após 3 tentativas
            if ($_SESSION['attempts'] >= 3) {
                $_SESSION['attempts'] = 0;
                $_SESSION['current_question'] = array_rand($questions); // Troca de pergunta
            }

            $message = "Resposta incorreta. Tente novamente.";
        }
    }

    $currentQuestion = $_SESSION['current_question'];
    $questionText = $questions[$currentQuestion];
} else {
    die("Erro ao recuperar dados do usuário.");
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificação 2FA</title>
    <link rel="stylesheet" href="./CSS/2fa.css">
</head>
<body>
    <div class="form">
        <h1>Verificação de Segurança</h1>
        <p>Responda à pergunta de segurança para continuar.</p>
        <?php if (!empty($message)): ?>
            <p style="color: red;"><?php echo $message; ?></p>
        <?php endif; ?>

        <form method="POST">
            <label for="answer"><?php echo $questionText; ?></label>
            <input type="text" id="answer" name="answer" required>
            <button type="submit">Enviar</button>
        </form>
    </div>
</body>
</html>
