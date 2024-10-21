<?php
// Configurações de conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crud_db";

// Criando a conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificando se houve erros na conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Função para registrar as ações no banco de dados
function logAction($action, $conn) {
    $sql = "INSERT INTO logs (action) VALUES ('$action')";
    $conn->query($sql);
}
?>
