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
    if(!empty($_GET['id'])){
        $sqlSelect = "SELECT * FROM usuarios WHERE id=$id";
        $result = $conn->query($sqlSelect);
        print_r = $result;
    
    // Coleta os dados do formulário
    $nome = $_POST['idNome'];
    $email = $_POST['idEmail'];
    $telefoneC = $_POST['idTelefone'];  // Telefone celular
    $telefoneF = $_POST['idTelefoneF']; // Telefone fixo
    $nomeMaterno = $_POST['idNomeM'];
    $cpf = $_POST['idCpf'];
    $cidade = $_POST['idCidade'];
    $login = $_POST['idLogin'];
    $senha = $_POST['idSenha'];  // Senha
    $csenha = $_POST['idCSenha']; // Confirmação de senha
    $genero = $_POST['genero'];
    $cep = $_POST['idCep'];
    $rua = $_POST['idRua'];
    $bairro = $_POST['idBairro'];
    $estado = $_POST['idEstado'];
            
}
?>

<!DOCTYPE HTML>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/tcad.css"/>
    <title>Página de Ediçao</title>
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
                        <div class="inputBox">
                            <input type="email" required id="idEmail" class="inputUser" name="idEmail">
                            <label for="idEmail" class="labelInput">E-mail</label>
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
                
                        <input type="submit" value="salvar" class="save">
                        <a href="lista.php" target="_self" class="voltar" id="voltar" >VOLTAR</a>
            </form>
        </div>
    </main>
    <script src="./JS/tcad.js"></script>
</body>
</html>
