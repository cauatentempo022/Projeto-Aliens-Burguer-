<!DOCTYPE HTML>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0 "/>
    <title>Página da Lista de Usuários</title>
    <link rel="stylesheet" href="./CSS/lista.css"/>
    <link rel="shortcut icon" href="IMG/icon-aliens.ico" type="image/x-icon">
</head>
<body>

    <?php
// Conexão com o banco de dados (MySQL)
$servername = "localhost";  // Servidor do banco de dados
$username = "root";         // Usuário do banco
$password = "";             // Senha do banco
$dbname = "projeto";        // Nome do banco de dados


// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se houve erro na conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
    $sql = "SELECT * FROM usuarios ORDER BY id";

    $result = $conn ->query($sql);
?>

    <div>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Nome</th>
      <th scope="col">CPF</th>
      <th scope="col">Telefone Fixo</th>
      <th scope="col">Telefone Celular</th>
      <th scope="col">E-mail</th>
      <th scope="col">Nome Materno</th>
      <th scope="col">Genêro</th>
      <th scope="col">CEP</th>
      <th scope="col">Estado</th>
      <th scope="col">Cidade</th>
      <th scope="col">Bairro</th>
      <th scope="col">Rua</th>
      <th scope="col">...</th>
    </tr>
  </thead>
  <tbody>
    <?php
      while($user_data = mysqli_fetch_assoc($result)){
        echo "<tr>";
        echo "<td>".$user_data['id']."</td>";
        echo "<td>".$user_data['nome']."</td>";
        echo "<td>".$user_data['cpf']."</td>";
        echo "<td>".$user_data['telefoneF']."</td>";
        echo "<td>".$user_data['telefoneC']."</td>";
        echo "<td>".$user_data['email']."</td>";
        echo "<td>".$user_data['nomeMaterno']."</td>";
        echo "<td>".$user_data['genero']."</td>";
        echo "<td>".$user_data['cep']."</td>";
        echo "<td>".$user_data['estado']."</td>";
        echo "<td>".$user_data['cidade']."</td>";
        echo "<td>".$user_data['bairro']."</td>";
        echo "<td>".$user_data['rua']."</td>";
        echo "<td>
          <a class='btn' href='tedit.php?id=$user_data[id]'>Editar</a>
        </td>";
        echo "</tr>";
      }
    ?>
  </tbody>
</table>
    </div>
</body>    
</html>
