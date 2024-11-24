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
    if(!empty($_GET['id']))
    {
        $id = $_GET['id'];
        $sqlSelect = "SELECT * FROM usuarios WHERE id = $id";
        $result = $conn->query($sqlSelect);
        if($result->num_rows > 0){
            while($user_data = mysqli_fetch_assoc($result)){
        // Coleta os dados do formulário
            $nome = $user_data['nome'];
            $email = $user_data['email'];
            $telefoneC = $user_data['telefoneC'];  // Telefone celular
            $telefoneF = $user_data['telefoneF']; // Telefone fixo
            $nomeMaterno = $user_data['nomeMaterno'];
            $cpf = $user_data['cpf'];
            $cidade = $user_data['cidade'];
            $genero = $user_data['genero'];
            $cep = $user_data['cep'];
            $rua = $user_data['rua'];
            $bairro = $user_data['bairro'];
            $estado = $user_data['estado'];
            $data = $user_data['dataNascimento'];
            };
        }else{
            header('Location: lista.php');
        }
    
    
            
}
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $nome = $_POST['idNome'];
    $email = $_POST['idEmail'];
    $telefoneC = $_POST['idTelefoneC'];  // Telefone celular
    $telefoneF = $_POST['idTelefoneF']; // Telefone fixo  
    $nomeMaterno = $_POST['idNomeM'];
    $cpf = $_POST['idCpf'];
    $cidade = $_POST['idCidade'];
    $genero = $_POST['genero'];
    $cep = $_POST['idCep'];
    $rua = $_POST['idRua'];
    $bairro = $_POST['idBairro'];
    $estado = $_POST['idEstado'];
    $data = $_POST['iddata'];

        $sqlUpdate = "UPDATE usuarios SET nome=$nome, email=$email, telefoneC=$telefoneC, telefoneF=$telefoneF, nomeMaterno=$nomeMaterno, cpf= $cpf, cep=$cep, rua=$rua, bairro=$bairro, cidade=$cidade, estado=$estado, genero=$genero, dataNascimento= $data 
        WHARE id= '$id'";

        $result = $conn->query($sqlUpdate);
    }
?>

    <header>
    </header>
    <main>
        <div class="box">
            <form method="POST" action="lista.php">
                <fieldset>
                    <legend class="legend"><b>Formulário de Cadastro</b></legend>
                    <br>
                    
                        <div class="inputBox">
                            <input type="text" required id="idNome" class="inputUser" name="idNome" value="<?php echo $nome?>">
                            <label for="idNome" class="labelInput">Nome</label>
                        </div>
                    <br>
                        <div class="inputBox">
                            <input type="text" required id="idCpf" class="inputUser" name="idCpf"value="<?php echo $cpf?>">
                            <label for="idCpf" class="labelInput">CPF</label>
                        </div>
                    <br>
                        <div class="inputBox">
                            <input type="email" required id="idEmail" class="inputUser" name="idEmail" value="<?php echo $email?>">
                            <label for="idEmail" class="labelInput">E-mail</label>
                        </div>
                    <br>
                        <div class="inputBox">
                            <input type="date" required id="iddate" class="inputUser" name="iddate"value="<?php echo $data?>">
                            <label for="iddate" class="labelInput">Data de Nascimento</label>
                        </div>
                    <br>
                        <div class="inputBox">
                            <input type="tel" required id="idTelefone" class="inputUser" name="idTelefone" value="<?php echo $telefoneC?>">
                            <label for="idTelefone" class="labelInput">Telefone Celular</label>
                        </div>
                    <br>
                        <div class="inputBox">
                            <input type="tel" required id="idTelefoneF" class="inputUser" name="idTelefoneF"value="<?php echo $telefoneF?>">
                            <label for="idTelefoneF" class="labelInput">Telefone Fixo</label>
                        </div>
                    <br>
                        <div class="inputBox">
                            <input type="text" required id="idNomeM" class="inputUser" name="idNomeM" value="<?php echo $nomeMaterno?>">
                            <label for="idNomeM" class="labelInput">Nome Materno</label>
                        </div>
                    <br>
                    <p>Sexo</p>
                        <div class="inputradio">
                            <input type="radio" name="genero" value="feminino" required <?php  echo ($genero == 'feminino') ? 'checked' : ''?>>
                            <label for="feminino">Feminino</label>
                    <br>
                            <input type="radio" name="genero" value="masculino" required <?php echo ($genero == 'masculino') ? 'checked' : ''?>>
                            <label for="masculino">Masculino</label>
                    <br>
                            <input type="radio" name="genero" value="outros" required <?php  echo ($genero == 'outros') ? 'checked' : ''?>>
                            <label for="outros">Outros</label>
                        </div>
                    <br>
                        <div class="inputBox">
                            <input type="text" required id="idCep" class="inputUser" name="idCep" maxlength="8" value="<?php echo $cep?>">
                            <label for="idCep" class="labelInput">CEP</label>
                        </div>
                    <br>    
                        <div class="inputBox">
                            <input type="text" required id="idRua" class="inputUser" name="idRua"value="<?php echo $rua?>">
                            <label for="idRua" class="labelInput">Rua</label>
                        </div>
                    <br>
                        <div class="inputBox">
                            <input type="text" required id="idCidade" class="inputUser" name="idCidade" value="<?php echo $cidade?>">
                            <label for="idCidade" class="labelInput">Cidade</label>
                        </div>
                    <br>
                        <div class="inputBox">
                            <input type="text" required id="idBairro" class="inputUser" name="idBairro" value="<?php echo $bairro?>">
                            <label for="idBairro" class="labelInput">Bairro</label>
                        </div>
                    <br>
                        <input type="hidden" name="id" id="id" value="<?php echo $id?>">   
                        <input type="submit" value="UPDATE" class="save" id="update">
                        <a href="lista.php" target="_self" class="voltar" id="voltar" >VOLTAR</a>
            </form>
        </div>
    </main>
    <script src="./JS/tcad.js"></script>
</body>
</html>
