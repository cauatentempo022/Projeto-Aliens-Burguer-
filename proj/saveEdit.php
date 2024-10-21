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

    if(isset($_POST['update'])){
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefoneC = $_POST['telefoneC'];  // Telefone celular
    $telefoneF = $_POST['telefoneF']; // Telefone fixo  $nomeMaterno = $user_data['nomeMaterno'];
    $cpf = $_POST['cpf'];
    $cidade = $_POST['cidade'];
    $genero = $_POST['genero'];
    $cep = $_POST['cep'];
    $rua = $_POST['rua'];
    $bairro = $_POST['bairro'];
    $estado = $_POST['estado'];
    $data = $_POST['dataNascimento'];

        $sqlUpdate = "UPDATE usuarios SET nome=$nome, email=$email, telefoneC=$telefoneC, telefoneF=$telefoneF, nomeMaterno=$nomeMaterno, cpf= $cpf, cep=$cep, rua=$rua, bairro=$bairro, cidade=$cidade, estado=$estado, genero=$genero, dataNascimento= $data 
        WHARE id= '$id'";

        $result = $conn->query($sqlUpdate);
    }else{
        header('Location: lista.php');
    }
    header('Location: lista.php')
?>