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

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coleta os dados do formulário
    $nome = $_POST['idNome'];
    $email = $_POST['idEmail'];
    $telefoneC = $_POST['idTelefone'];  // Telefone celular
    $telefoneF = $_POST['idTelefoneF']; // Telefone fixo
    $nomeMaterno = $_POST['idNomeM'];
    $cpf = $_POST['idCpf'];
    $cep = $_POST['idCep'];
    $rua = $_POST['idRua'];
    $bairro = $_POST['idBairro'];
    $estado = $_POST['idEstado'];
    $cidade = $_POST['idCidade'];
    $login = $_POST['idLogin'];
    $senha = $_POST['idSenha'];  // Senha
    $csenha = $_POST['idCSenha']; // Confirmação de senha
    $genero = $_POST['genero'];
    $dataNascimento = $_POST['iddate'];

    // Verifica se as senhas correspondem
    if ($senha !== $csenha) {
        echo "<script>alert('As senhas não coincidem!');</script>";
    } else {
        // Criptografa a senha
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        // Verifica se o login já existe no banco de dados
        $sql = "SELECT * FROM usuarios WHERE login = '$login'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Se o login já existir, exibe mensagem de erro
            echo "<script>alert('ESSE CADASTRO JÁ EXISTE');</script>";
        } else {
            // Insere os dados no banco de dados
                        // Insere os dados no banco de dados
                        $sql = "INSERT INTO usuarios (nome, email, telefoneF, telefoneC, nomeMaterno, cpf, cep, rua, bairro, estado, cidade, login, senha, csenha, genero, dataNascimento, classe)
                        VALUES ('$nome', '$email', '$telefoneF', '$telefoneC', '$nomeMaterno', '$cpf', '$cep', '$rua', '$bairro', '$estado', '$cidade', '$login', '$senhaHash', '$senhaHash', '$genero', '$data', 'cliente')";
    
                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('Cadastro realizado com sucesso!');</script>";
                    header('Location: tmenu.php');
                    exit();
                } else {
                    echo "Erro: " . $sql . "<br>" . $conn->error;
                }
    
        }
    }

    // Fecha a conexão
    $conn->close();
}
?>

<!DOCTYPE HTML>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/tcad.css"/>
    <title>Página de Cadastro</title>
    <link rel="shortcut icon" href="IMG/icon-aliens.ico" type="image/x-icon">
</head>
<body>
    <header>
    </header>
    <main>
        <div class="box">
            <form method="POST">
                <fieldset>
                    <legend class="legend"><b>Formulário de Cadastro</b></legend>
                    <br>
                    
                        <div class="inputBox">
                            <input type="text" required id="idNome" class="inputUser" name="idNome">
                            <label for="idNome" class="labelInput">Nome</label>
                        </div>
                    <br>
                        <div class="inputBox">
                            <input type="text" required id="idCpf" class="inputUser" name="idCpf">
                            <label for="idCpf" class="labelInput">CPF</label>
                        </div>
                    <br>
                        <div class="inputBox">
                            <input type="email" required id="idEmail" class="inputUser" name="idEmail">
                            <label for="idEmail" class="labelInput">E-mail</label>
                        </div>
                    <br>
                        <div class="inputBox">
                            <input type="date" required id="iddate" class="inputUser" name="iddate">
                            <label for="iddate" class="labelInput">Data de Nascimento</label>
                        </div>
                    <br>
                        <div class="inputBox">
                            <input type="tel" required id="idTelefone" class="inputUser" name="idTelefone">
                            <label for="idTelefone" class="labelInput">Telefone Celular</label>
                        </div>
                    <br>
                        <div class="inputBox">
                            <input type="tel" required id="idTelefoneF" class="inputUser" name="idTelefoneF">
                            <label for="idTelefoneF" class="labelInput">Telefone Fixo</label>
                        </div>
                    <br>
                        <div class="inputBox">
                            <input type="text" required id="idNomeM" class="inputUser" name="idNomeM">
                            <label for="idNomeM" class="labelInput">Nome Materno</label>
                        </div>
                    <br>
                        <p>Sexo</p>
                        <div class="inputradio">
                            <input type="radio" name="genero" value="feminino" required>
                            <label for="feminino">Feminino</label>
                    <br>
                            <input type="radio" name="genero" value="masculino" required>
                            <label for="masculino">Masculino</label>
                    <br>
                            <input type="radio" name="genero" value="outros" required>
                            <label for="outros">Outros</label>
                        </div>
                    <br>
                        <div class="inputBox">
                            <input type="text" required id="idCep" class="inputUser" name="idCep" maxlength="8">
                            <label for="idCep" class="labelInput">CEP</label>
                        </div>
                    <br>    
                        <div class="inputBox">
                            <input type="text" required id="idRua" class="inputUser" name="idRua">
                            <label for="idRua" class="labelInput">Rua</label>
                        </div>
                    <br>
                        <div class="inputBox">
                            <input type="text" required id="idCidade" class="inputUser" name="idCidade">
                            <label for="idCidade" class="labelInput">Cidade</label>
                        </div>
                    <br>
                        <div class="inputBox">
                            <input type="text" required id="idBairro" class="inputUser" name="idBairro">
                            <label for="idBairro" class="labelInput">Bairro</label>
                        </div>
                    <br>
                        <div class="inputBox">
                            <input type="text" required id="idEstado" class="inputUser" name="idEstado">
                            <label for="IdEstado" class="labelInput">Estado</label>
                        </div>
                    <br>
                        <div class="inputBox">
                            <input type="text" required id="idLogin" class="inputUser" name="idLogin">
                            <label for="idLogin" class="labelInput">Login</label>
                        </div>
                    <br>
                        <div class="inputBox">
                            <input type="password" required id="idSenha" class="inputUser" name="idSenha">
                            <label for="idSenha" class="labelInput">Senha</label>
                        </div>
                    <br>
                        <div class="inputBox">
                            <input type="password" id="idCSenha" class="inputUser" name="idCSenha" required>
                            <label for="idCSenha" class="labelInput">Confirma senha</label>
                        </div>
                    <br>
                
                        <input type="reset" name="LIMPAR" value="LIMPAR" class="limpar">
                        <input type="submit" value="SALVAR" class="save">
                        <a href="tmenu.php" target="_self" class="enviar" id="enviar" >ENVIAR</a>
            </form>
        </div>
    </main>
    <script src="./JS/tcad.js"></script>
</body>
</html>
