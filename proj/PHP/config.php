<?php
$host = 'localhost';
$db = 'projeto';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>