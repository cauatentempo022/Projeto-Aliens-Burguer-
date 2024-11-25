<?php
// Conexão com o banco de dados (MySQL)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projeto";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Buscar logs
$sqlLogs = "SELECT * FROM log_acoes ORDER BY horario DESC";
$resultLogs = $conn->query($sqlLogs);
?>

<!DOCTYPE HTML>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Log de Ações</title>
    <link rel="stylesheet" href="./CSS/log.css"/>
</head>
<body>
    <h1>Log de Ações dos Usuários</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>ID do Usuário</th>
                <th>Ação</th>
                <th>Horário</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($log = mysqli_fetch_assoc($resultLogs)) {
                echo "<tr>";
                echo "<td>" . $log['id'] . "</td>";
                echo "<td>" . $log['usuario_id'] . "</td>";
                echo "<td>" . $log['acao'] . "</td>";
                echo "<td>" . $log['horario'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
