<!DOCTYPE HTML>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0 "/>
    <title>Página de ERRO</title>
    <link rel="stylesheet" href="./CSS/terro.css"/>
    <link rel="shortcut icon" href="IMG/icon-aliens.ico" type="image/x-icon">
</head>
<body>
    <header>
        <nav class="navegation">
            <a href="#" class="logo"><img class="img-logo" src="./IMG/logo1-Photoroom.png-Photoroom.png"></a>
            <ul class="nav-menu">
                <li><a href="tcarinho.html" target="_self" class="nav-item">Carrinho</a></li>
                <li><a href="tlogin2.php" target="_self" class="nav-item">Login</a></li>
                <li><a href="tcad.php" target="_self" class="nav-item">Cadastro</a></li>

                <!-- Exibe o login do usuário no menu se estiver logado -->
                <!--<li><a href="#" class="nav-item"><?php echo htmlspecialchars($logged_in_user); ?></a></li>-->
            </ul>
            <div class="menu">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </nav>
    </header>
    <main class="main">
        <section class="section">
            <div class="left">
                <p>Erro 404</p>
                <h4>Parece que a nave saiu de rota!<br>A página que você queria pode estar orbitando outro sistema solar</h4>
                <a href="tmenu.php" class="btn">Voltar</a>
            </div>
            <div class="right">
                <img src="./IMG/Erro.png" alt="imagem de erro 404">
                <div class="shadow"></div>
            </div>
        </section>
    </main>
</body>    
</html>
