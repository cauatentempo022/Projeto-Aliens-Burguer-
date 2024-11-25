<?php
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

// Função para registrar no log
function registrarLog($conn, $usuario_id, $acao) {
    $horario = date("Y-m-d H:i:s");
    $sqlLog = "INSERT INTO log_acoes (usuario_id, acao, horario) VALUES ('$usuario_id', '$acao', '$horario')";
    $conn->query($sqlLog);
}

// Processar exclusão
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sqlDelete = "DELETE FROM usuarios WHERE id = $delete_id";
    if ($conn->query($sqlDelete) === TRUE) {
        registrarLog($conn, $delete_id, 'Excluir');
        echo "<script>alert('Usuário excluído com sucesso!'); window.location.href='lista.php';</script>";
    } else {
        echo "Erro ao excluir: " . $conn->error;
    }
}

// Buscar todos os usuários
$sql = "SELECT * FROM usuarios ORDER BY id";
$result = $conn->query($sql);
?>

<!DOCTYPE HTML>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Página da Lista de Usuários</title>
    <link rel="stylesheet" href="./CSS/lista.css"/>
    <link rel="shortcut icon" href="IMG/icon-aliens.ico" type="image/x-icon">
</head>
<body>
    <div>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>Telefone Fixo</th>
                <th>Telefone Celular</th>
                <th>E-mail</th>
                <th>Nome Materno</th>
                <th>Gênero</th>
                <th>CEP</th>
                <th>Estado</th>
                <th>Cidade</th>
                <th>Bairro</th>
                <th>Rua</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($user_data = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $user_data['id'] . "</td>";
                echo "<td>" . $user_data['nome'] . "</td>";
                echo "<td>" . $user_data['cpf'] . "</td>";
                echo "<td>" . $user_data['telefoneF'] . "</td>";
                echo "<td>" . $user_data['telefoneC'] . "</td>";
                echo "<td>" . $user_data['email'] . "</td>";
                echo "<td>" . $user_data['nomeMaterno'] . "</td>";
                echo "<td>" . $user_data['genero'] . "</td>";
                echo "<td>" . $user_data['cep'] . "</td>";
                echo "<td>" . $user_data['estado'] . "</td>";
                echo "<td>" . $user_data['cidade'] . "</td>";
                echo "<td>" . $user_data['bairro'] . "</td>";
                echo "<td>" . $user_data['rua'] . "</td>";
                echo "<td>
                    <a class='btn' href='tedit.php?id={$user_data['id']}'>Editar</a>
                    <a class='btn' href='lista.php?delete_id={$user_data['id']}' onclick=\"return confirm('Tem certeza que deseja excluir este usuário?');\">Excluir</a>
                </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    </div>
</body>
</html>
