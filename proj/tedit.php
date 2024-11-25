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

// Variáveis para armazenar os dados do usuário
$nome = $email = $telefoneC = $telefoneF = $nomeMaterno = $cpf = $cidade = $genero = $cep = $rua = $bairro = $estado = $data = "";
$id = "";

// Recupera os dados do usuário, caso o ID seja fornecido
if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $sqlSelect = "SELECT * FROM usuarios WHERE id = $id";
    $result = $conn->query($sqlSelect);
    if ($result->num_rows > 0) {
        $user_data = mysqli_fetch_assoc($result);
        $nome = $user_data['nome'];
        $email = $user_data['email'];
        $telefoneC = $user_data['telefoneC'];
        $telefoneF = $user_data['telefoneF'];
        $nomeMaterno = $user_data['nomeMaterno'];
        $cpf = $user_data['cpf'];
        $cidade = $user_data['cidade'];
        $genero = $user_data['genero'];
        $cep = $user_data['cep'];
        $rua = $user_data['rua'];
        $bairro = $user_data['bairro'];
        $estado = $user_data['estado'];
        $data = $user_data['dataNascimento'];
    } else {
        header('Location: lista.php');
        exit();
    }
}

// Processa a atualização dos dados do formulário
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nome = mysqli_real_escape_string($conn, $_POST['idNome']);
    $email = mysqli_real_escape_string($conn, $_POST['idEmail']);
    $telefoneC = mysqli_real_escape_string($conn, $_POST['idTelefone']);
    $telefoneF = mysqli_real_escape_string($conn, $_POST['idTelefoneF']);
    $nomeMaterno = mysqli_real_escape_string($conn, $_POST['idNomeM']);
    $cpf = mysqli_real_escape_string($conn, $_POST['idCpf']);
    $cidade = mysqli_real_escape_string($conn, $_POST['idCidade']);
    $genero = mysqli_real_escape_string($conn, $_POST['genero']);
    $cep = mysqli_real_escape_string($conn, $_POST['idCep']);
    $rua = mysqli_real_escape_string($conn, $_POST['idRua']);
    $bairro = mysqli_real_escape_string($conn, $_POST['idBairro']);
    $estado = mysqli_real_escape_string($conn, $_POST['idEstado']);
    $data = mysqli_real_escape_string($conn, $_POST['iddata']);

    $sqlUpdate = "UPDATE usuarios SET 
        nome='$nome', 
        email='$email', 
        telefoneC='$telefoneC', 
        telefoneF='$telefoneF', 
        nomeMaterno='$nomeMaterno', 
        cpf='$cpf', 
        cep='$cep', 
        rua='$rua', 
        bairro='$bairro', 
        cidade='$cidade', 
        estado='$estado', 
        genero='$genero', 
        dataNascimento='$data' 
        WHERE id='$id'";

    if ($conn->query($sqlUpdate) === TRUE) {
        echo "<script>alert('Atualização realizada com sucesso!');</script>";
        header('Location: lista.php');
        exit();
    } else {
        echo "Erro ao atualizar: " . $conn->error;
    }
}
?>

<!DOCTYPE HTML>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/tcad.css"/>
    <title>Página de Edição</title>
    <link rel="shortcut icon" href="IMG/icon-aliens.ico" type="image/x-icon">
</head>
<body>
    <header></header>
    <main>
        <div class="box">
            <form method="POST" action="">
                <fieldset>
                    <legend class="legend"><b>Formulário de Edição</b></legend>
                    <br>
                    <div class="inputBox">
                        <input type="text" required id="idNome" class="inputUser" name="idNome" value="<?php echo $nome; ?>">
                        <label for="idNome" class="labelInput">Nome</label>
                    </div>
                    <br>
                    <div class="inputBox">
                        <input type="text" required id="idCpf" class="inputUser" name="idCpf" value="<?php echo $cpf; ?>">
                        <label for="idCpf" class="labelInput">CPF</label>
                    </div>
                    <br>
                    <div class="inputBox">
                        <input type="email" required id="idEmail" class="inputUser" name="idEmail" value="<?php echo $email; ?>">
                        <label for="idEmail" class="labelInput">E-mail</label>
                    </div>
                    <br>
                    <div class="inputBox">
                        <input type="date" required id="iddate" class="inputUser" name="iddata" value="<?php echo $data; ?>">
                        <label for="iddate" class="labelInput">Data de Nascimento</label>
                    </div>
                    <br>
                    <div class="inputBox">
                        <input type="tel" required id="idTelefone" class="inputUser" name="idTelefone" value="<?php echo $telefoneC; ?>">
                        <label for="idTelefone" class="labelInput">Telefone Celular</label>
                    </div>
                    <br>
                    <div class="inputBox">
                        <input type="tel" required id="idTelefoneF" class="inputUser" name="idTelefoneF" value="<?php echo $telefoneF; ?>">
                        <label for="idTelefoneF" class="labelInput">Telefone Fixo</label>
                    </div>
                    <br>
                    <div class="inputBox">
                        <input type="text" required id="idNomeM" class="inputUser" name="idNomeM" value="<?php echo $nomeMaterno; ?>">
                        <label for="idNomeM" class="labelInput">Nome Materno</label>
                    </div>
                    <br>
                    <p>Sexo</p>
                    <div class="inputradio">
                        <input type="radio" name="genero" value="feminino" required <?php echo ($genero == 'feminino') ? 'checked' : ''; ?>>
                        <label for="feminino">Feminino</label>
                        <br>
                        <input type="radio" name="genero" value="masculino" required <?php echo ($genero == 'masculino') ? 'checked' : ''; ?>>
                        <label for="masculino">Masculino</label>
                        <br>
                        <input type="radio" name="genero" value="outros" required <?php echo ($genero == 'outros') ? 'checked' : ''; ?>>
                        <label for="outros">Outros</label>
                    </div>
                    <br>
                    <div class="inputBox">
                        <input type="text" required id="idCep" class="inputUser" name="idCep" maxlength="8" value="<?php echo $cep; ?>">
                        <label for="idCep" class="labelInput">CEP</label>
                    </div>
                    <br>    
                    <div class="inputBox">
                        <input type="text" required id="idRua" class="inputUser" name="idRua" value="<?php echo $rua; ?>">
                        <label for="idRua" class="labelInput">Rua</label>
                    </div>
                    <br>
                    <div class="inputBox">
                        <input type="text" required id="idCidade" class="inputUser" name="idCidade" value="<?php echo $cidade; ?>">
                        <label for="idCidade" class="labelInput">Cidade</label>
                    </div>
                    <br>
                    <div class="inputBox">
                        <input type="text" required id="idBairro" class="inputUser" name="idBairro" value="<?php echo $bairro; ?>">
                        <label for="idBairro" class="labelInput">Bairro</label>
                    </div>
                    <br>
                    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">   
                    <input type="submit" name="update" value="UPDATE" class="save">
                    <a href="lista.php" target="_self" class="voltar">VOLTAR</a>
                </fieldset>
            </form>
        </div>
    </main>
    <script src="./JS/tcad.js"></script>
</body>
</html>
