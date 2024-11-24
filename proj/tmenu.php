<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Menu</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./CSS/style.css" />
    <link rel="shortcut icon" href="IMG/icon-aliens.ico" type="image/x-icon">
</head>
<body>
    
    <?php
// Inicia a sessão
session_start();

// Verifica se o usuário está logado, senão redireciona para a página de login
if (!isset($_SESSION['login'])) {
    header("Location: tlogin2.php");
    exit();
}

// Pega o login do usuário da sessão
$logged_in_user = $_SESSION['login'];

// Conexão com o banco de dados (opcional, se necessário para mais funcionalidades)
// Conexão com o banco de dados (MySQL)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projeto";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>
    
    <header>
        <nav class="navegation">
            <a href="#" class="logo"><img class="img-logo" src="./IMG/logo1-Photoroom.png-Photoroom.png"></a>
            <ul class="nav-menu">
                <li><a href="tcarinho.html" target="_self" class="nav-item">Carrinho</a></li>
                <li><a href="tlogin2.php" target="_self" class="nav-item">Login</a></li>
                <li><a href="tcad.php" target="_self" class="nav-item">Cadastro</a></li>

                <!-- Exibe o login do usuário no menu se estiver logado -->
                <li><a href="#" class="nav-item"><?php echo htmlspecialchars($logged_in_user); ?></a></li>
            </ul>
            <div class="menu">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </nav>
    </header>

    <main>
        <section class="home">
            <div class="home-text">
                <h4 class="text-h4">BEM-VINDO AO</h4>      
                <h1 class="text-h1">Aliens Burguer </h1>
                <p>Venham conhecer nossos Hamburguer's mais variados e divertidos de todo Planeta, garanto que será uma experiência de outro mundo.</p>
                <a href="terro.html" class="home-btn">Link</a>        
            </div>
            <div class="home-img">
                <img src="./IMG/menu-ham.png" alt="Hamburguer">
            </div>
        </section>
    </main>

    <script src="./JS/script.js"></script>
</body>
</html>
