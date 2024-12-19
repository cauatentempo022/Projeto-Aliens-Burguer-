<?php
session_start();

if (!isset($_SESSION['id']) || !isset($_SESSION['classe'])) {
    header("Location: tlogin2.php");
    exit();
}

// Pega a classe do usuário logado
$classeUsuario = $_SESSION['classe'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Menu</title>
    <link rel="stylesheet" href="./CSS/style.css" />
    <link rel="shortcut icon" href="IMG/icon-aliens.ico" type="image/x-icon">
</head>
<body>
    <header>
        <nav class="navegation">
            <a href="#" class="logo"><img class="img-logo" src="./IMG/logo1-Photoroom.png-Photoroom.png"></a>
            <ul class="nav-menu">
                <li><a href="tcarinho.php" target="_self" class="nav-item">Cardápio</a></li>
                <li><a href="tcad.php" target="_self" class="nav-item">Cadastro</a></li>
                <!-- Mostra opções extras se for 'master' ou 'adm' -->
                <?php if ($classeUsuario === 'master' || $classeUsuario === 'adm'): ?>
                    <li><a href="lista.php" target="_self" class="nav-item">Lista de Usuários</a></li>
                    <li><a href="log.php" target="_self" class="nav-item">Log de Ações</a></li>
                <?php endif; ?>
                <li><a href="tlogin2.php" target="_self" class="nav-item">Sair</a></li>
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
                <h1 class="text-h1">Aliens Burguer</h1>
                <p>Venham conhecer nossos Hamburguer's mais variados e divertidos de todo Planeta, garanto que será uma experiência de outro mundo.</p>
                <a href="terro.php" class="home-btn">Link</a>
            </div>
            <div class="home-img">
                <img src="./IMG/menu-ham.png" alt="Hamburguer">
            </div>
        </section>
    </main>
    <script src="./JS/script.js"></script>
</body>
</html>