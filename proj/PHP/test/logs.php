<?php
// Incluindo a conexão com o banco de dados
include 'db.php';

// Recuperando o log de ações
$sql = "SELECT * FROM logs ORDER BY action_time DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Relatório de Ações</title>
</head>
<body>

<h2>Relatório de Ações no Sistema</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Ação</th>
        <th>Data e Hora</th>
    </tr>
    <!-- Exibindo o log de ações -->
    <?php while($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['action']; ?></td>
        <td><?php echo $row['action_time']; ?></td>
    </tr>
    <?php } ?>
</table>

<br>
<a href="index.php"><button>Voltar</button></a>

</body>
</html>
