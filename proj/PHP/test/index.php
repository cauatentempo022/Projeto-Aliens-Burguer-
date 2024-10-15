<?php
// Incluindo a conexão com o banco de dados
include 'db.php';

// Adicionando um novo usuário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];

    // Inserindo o novo usuário no banco
    $sql = "INSERT INTO users (name, email) VALUES ('$name', '$email')";
    if ($conn->query($sql) === TRUE) {
        logAction("Adicionou usuário: $name", $conn); // Registrando a ação
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}

// Excluindo um usuário
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM users WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        logAction("Excluiu usuário ID: $id", $conn); // Registrando a ação
    } else {
        echo "Erro ao excluir: " . $conn->error;
    }
}

// Recuperando os dados dos usuários
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD PHP</title>
</head>
<body>

<h2>CRUD de Usuários</h2>

<!-- Formulário para adicionar novo usuário -->
<form method="post" action="">
    Nome: <input type="text" name="name" required>
    Email: <input type="email" name="email" required>
    <input type="submit" value="Adicionar Usuário">
</form>

<h3>Lista de Usuários</h3>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Ações</th>
    </tr>
    <!-- Exibindo os usuários cadastrados -->
    <?php while($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['email']; ?></td>
        <td>
            <a href="edit.php?id=<?php echo $row['id']; ?>">Editar</a>
            <a href="index.php?delete=<?php echo $row['id']; ?>">Excluir</a>
        </td>
    </tr>
    <?php } ?>
</table>

<br>
<!-- Botão para acessar o relatório de ações -->
<a href="logs.php"><button>Ver Relatório de Ações</button></a>

</body>
</html>
