<?php include 'db_connect.php'; ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Pessoa - Index4</title>
</head>
<body>
    <h1>Buscar, Salvar e Editar Pessoa</h1>

    <?php
    // Inicializa as variáveis
    $idPessoa = 0;
    $nomeAtual = '';
    $idadeAtual = '';
    $resultadoBusca = '';

    // Ação para salvar ou atualizar
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Salvando ou atualizando registro
        if (isset($_POST['salvar'])) {
            $idPessoa = $_POST['id'];
            $nome = $_POST['nome'];
            $idade = $_POST['idade'];

            if ($idPessoa == 0) {
                // Inserir novo registro
                $sql = "INSERT INTO pessoas (nome, idade) VALUES ('$nome', $idade)";
                if ($conn->query($sql) === TRUE) {
                    echo "Novo registro salvo com sucesso!";
                } else {
                    echo "Erro ao salvar: " . $conn->error;
                }
            } else {
                // Atualizar registro existente
                $sqlUpdate = "UPDATE pessoas SET nome = '$nome', idade = $idade WHERE id = $idPessoa";
                if ($conn->query($sqlUpdate) === TRUE) {
                    echo "Registro atualizado com sucesso!";
                } else {
                    echo "Erro ao atualizar: " . $conn->error;
                }
            }
        }

        // Carregar registro para edição
        if (isset($_POST['editar'])) {
            $idPessoa = $_POST['idPessoa'];
            $sqlBuscaPorID = "SELECT * FROM pessoas WHERE id = $idPessoa";
            $resultado = $conn->query($sqlBuscaPorID);

            if ($resultado->num_rows > 0) {
                $row = $resultado->fetch_assoc();
                $idPessoa = $row['id'];
                $nomeAtual = $row['nome'];
                $idadeAtual = $row['idade'];
            }
        }

        // Localizar registro
        if (isset($_POST['buscar'])) {
            $nomeBusca = $_POST['nomeBusca'];

            // Prepara a SQL de busca parcial usando LIKE
            $sqlBusca = "SELECT * FROM pessoas WHERE nome LIKE '%$nomeBusca%'";
            $resultado = $conn->query($sqlBusca);

            if ($resultado->num_rows > 0) {
                // Exibe os resultados encontrados e coloca botões de edição para cada um
                $resultadoBusca = "<h2>Resultados da busca por '$nomeBusca':</h2><ul>";
                while($row = $resultado->fetch_assoc()) {
                    $resultadoBusca .= "<li>ID: " . $row["id"] . " | Nome: " . $row["nome"] . " | Idade: " . $row["idade"];
                    $resultadoBusca .= "
                    <form style='display:inline;' method='post' action='index4.php'>
                        <input type='hidden' name='idPessoa' value='" . $row["id"] . "'>
                        <input type='submit' name='editar' value='Editar'>
                    </form>
                    </li>";
                }
                $resultadoBusca .= "</ul>";
            } else {
                $resultadoBusca = "Nenhuma pessoa encontrada com o nome que contenha '$nomeBusca'.";
            }
        }
    }
    ?>

    <!-- Formulário único para salvar ou editar pessoa -->
    <form action="index4.php" method="post">
        <!-- Se ID for 0, é um novo registro; caso contrário, será editado -->
        <input type="hidden" name="id" value="<?php echo $idPessoa; ?>">

        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo $nomeAtual; ?>" required><br><br>

        <label for="idade">Idade:</label>
        <input type="number" id="idade" name="idade" value="<?php echo $idadeAtual; ?>" required><br><br>

        <input type="submit" name="salvar" value="<?php echo ($idPessoa > 0) ? 'Atualizar' : 'Salvar'; ?>">
    </form>

    <h1>Localizar Pessoa</h1>

    <!-- Formulário para buscar pessoa pelo nome -->
    <form action="index4.php" method="post">
        <label for="nomeBusca">Nome para buscar (parcial ou completo):</label>
        <input type="text" id="nomeBusca" name="nomeBusca" required><br><br>
        
        <input type="submit" name="buscar" value="Buscar">
    </form>

    <!-- Exibe o resultado da busca com opção de editar -->
    <?php echo $resultadoBusca; ?>

</body>
</html>
