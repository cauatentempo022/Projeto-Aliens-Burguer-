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

// Função para validar CPF
function validarCPF($cpf) {
    $cpf = preg_replace('/\D/', '', $cpf);
    if (strlen($cpf) != 11 || preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }
    }
    return true;
}

// Função para validar telefone
function validarTelefone($telefone) {
    $telefone = preg_replace('/\D/', '', $telefone);
    return strlen($telefone) == 10 || strlen($telefone) == 11;
}

// Inicializa variáveis para armazenar valores preenchidos
$nome = $nomeMaterno = $cpf = $telefoneC = $email = $login = $cep = $rua = $bairro = $cidade = $estado = $genero = $dataNascimento = "";
$erros = [];

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coleta os dados do formulário
    $nome = $_POST['idNome'];
    $nomeMaterno = $_POST['idNomeM'];
    $cpf = $_POST['idCpf'];
    $telefoneC = $_POST['idTelefone'];
    $email = $_POST['idEmail'];
    $login = $_POST['idLogin'];
    $senha = $_POST['idSenha'];
    $csenha = $_POST['idCSenha'];
    $genero = $_POST['genero'] ?? '';
    $dataNascimento = $_POST['iddate'];
    $cep = $_POST['idCep'];
    $rua = $_POST['idRua'];
    $bairro = $_POST['idBairro'];
    $cidade = $_POST['idCidade'];
    $estado = $_POST['idEstado'];

    // Validações
    if (strlen(trim($nome)) < 15) {
        $erros['nome'] = "O nome deve conter pelo menos 15 caracteres.";
    }
    if (strlen(trim($nomeMaterno)) < 15) {
        $erros['nomeMaterno'] = "O nome materno deve conter pelo menos 15 caracteres.";
    }
    if (!validarCPF($cpf)) {
        $erros['cpf'] = "CPF inválido.";
    }
    if (!validarTelefone($telefoneC)) {
        $erros['telefoneC'] = "Telefone celular inválido.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erros['email'] = "E-mail inválido.";
    }
    if ($senha !== $csenha) {
        $erros['senha'] = "As senhas não coincidem.";
    }

    // Se não houver erros, insere os dados no banco
    if (empty($erros)) {
        // Verifica se o login já existe no banco de dados
        $sql = "SELECT * FROM usuarios WHERE login = '$login'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $erros['login'] = "Este login já existe.";
        } else {
            // Criptografa a senha
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

            // Insere os dados no banco de dados
            $sql = "INSERT INTO usuarios (nome, nomeMaterno, cpf, telefoneC, email, login, senha, genero, dataNascimento, cep, rua, bairro, cidade, estado)
                    VALUES ('$nome', '$nomeMaterno', '$cpf', '$telefoneC', '$email', '$login', '$senhaHash', '$genero', '$dataNascimento', '$cep', '$rua', '$bairro', '$cidade', '$estado')";

            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Cadastro realizado com sucesso!');</script>";
                header('Location: tmenu.php');
                exit();
            } else {
                echo "Erro ao salvar os dados: " . $conn->error;
            }
        }
    }
}

// Fecha a conexão
$conn->close();
?>

<!DOCTYPE HTML>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/tcad.css"/>
    <title>Página de Cadastro</title>
    <link rel="shortcut icon" href="IMG/icon-aliens.ico" type="image/x-icon">
    <style>
        .error {
            color: red;
            font-size: 0.9em;
            margin-top: 5px;
            display: block;
        }
    </style>
</head>
<body>
    <main>
        <div class="box">
            <form method="POST">
                <fieldset>
                    <legend class="legend"><b>Formulário de Cadastro</b></legend>
                    <br>
                        <div class="inputBox">
                            <input type="text" id="idNome" class="inputUser" name="idNome" value="<?= htmlspecialchars($nome); ?>" required>
                            <label for="idNome" class="labelInput">Nome</label>
                            <span class="error"><?= $erros['nome'] ?? ''; ?></span>
                        </div>
                    <br>
                        <div class="inputBox">
                            <input type="text" id="idCpf" class="inputUser" name="idCpf" value="<?= htmlspecialchars($cpf); ?>" required>
                            <label for="idCpf" class="labelInput">CPF</label>
                            <span class="error"><?= $erros['cpf'] ?? ''; ?></span>
                        </div>
                    <br>
                        <div class="inputBox">
                            <input type="email" id="idEmail" class="inputUser" name="idEmail" value="<?= htmlspecialchars($email); ?>" required>
                            <label for="idEmail" class="labelInput">E-mail</label>
                            <span class="error"><?= $erros['email'] ?? ''; ?></span>
                        </div>
                    <br>
                        <div class="inputBox">
                            <input type="date" id="iddate" class="inputUser" name="iddate" value="<?= htmlspecialchars($dataNascimento); ?>" required>
                            <label for="iddate" class="labelInput">Data de Nascimento</label>
                        </div>
                    <br>
                        <div class="inputBox">
                            <input type="tel" id="idTelefone" class="inputUser" name="idTelefone" value="<?= htmlspecialchars($telefoneC); ?>" required>
                            <label for="idTelefone" class="labelInput">Telefone Celular</label>
                            <span class="error"><?= $erros['telefoneC'] ?? ''; ?></span>
                        </div>
                    <br>
                        <div class="inputBox">
                            <input type="text" id="idNomeM" class="inputUser" name="idNomeM" value="<?= htmlspecialchars($nomeMaterno); ?>" required>
                            <label for="idNomeM" class="labelInput">Nome Materno</label>
                            <span class="error"><?= $erros['nomeMaterno'] ?? ''; ?></span>
                        </div>
                    <br>
                        <p>Sexo</p>
                        <div class="inputradio">
                            <input type="radio" name="genero" value="Masculino" <?= $genero == 'Masculino' ? 'checked' : ''; ?>> Masculino
                        <br>
                            <input type="radio" name="genero" value="Feminino" <?= $genero == 'Feminino' ? 'checked' : ''; ?>> Feminino
                        <br>
                            <input type="radio" name="genero" value="Outros" <?= $genero == 'Outros' ? 'checked' : ''; ?>> Outros
                        </div>
                    <br>
                        <div class="inputBox">
                            <input type="text" id="idCep" class="inputUser" name="idCep" value="<?= htmlspecialchars($cep); ?>" required>
                            <label for="idCep" class="labelInput">CEP</label>
                        </div>
                    <br>
                        <div class="inputBox">
                            <input type="text" id="idRua" class="inputUser" name="idRua" value="<?= htmlspecialchars($rua); ?>" required>
                            <label for="idRua" class="labelInput">Rua</label>
                        </div>
                    <br>
                        <div class="inputBox">
                            <input type="text" id="idBairro" class="inputUser" name="idBairro" value="<?= htmlspecialchars($bairro); ?>" required>
                            <label for="idBairro" class="labelInput">Bairro</label>
                        </div>
                    <br>
                        <div class="inputBox">
                            <input type="text" id="idCidade" class="inputUser" name="idCidade" value="<?= htmlspecialchars($cidade); ?>" required>
                            <label for="idCidade" class="labelInput">Cidade</label>
                        </div>
                    <br>
                        <div class="inputBox">
                            <input type="text" id="idEstado" class="inputUser" name="idEstado" value="<?= htmlspecialchars($estado); ?>" required>
                            <label for="idEstado" class="labelInput">Estado</label>
                        </div>
                    <br>
                        <div class="inputBox">
                            <input type="text" id="idLogin" class="inputUser" name="idLogin" value="<?= htmlspecialchars($login); ?>" required>
                            <label for="idLogin" class="labelInput">Login</label>
                            <span class="error"><?= $erros['login'] ?? ''; ?></span>
                        </div>
                    <br>
                        <div class="inputBox">
                            <input type="password" id="idSenha" class="inputUser" name="idSenha" required>
                            <label for="idSenha" class="labelInput">Senha</label>
                            <span class="error"><?= $erros['senha'] ?? ''; ?></span>
                        </div>
                    <br>
                        <div class="inputBox">
                            <input type="password" id="idCSenha" class="inputUser" name="idCSenha" required>
                            <label for="idCSenha" class="labelInput">Confirma senha</label>
                        </div>
                    <br>
                    <input type="reset" name="LIMPAR" value="LIMPAR" class="limpar">
                    <input type="submit" value="SALVAR" class="save">
                </fieldset>
            </form>
        </div>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const nomeInput = document.getElementById('idNome');
            const nomeMaternoInput = document.getElementById('idNomeM');
            const cpfInput = document.getElementById('idCpf');
            const telefoneInput = document.getElementById('idTelefone');
            const nomeError = document.getElementById('nomeError');
            const nomeMaternoError = document.getElementById('nomeMaternoError');
            const cpfError = document.getElementById('cpfError');
            const telefoneError = document.getElementById('telefoneError');
            const formCadastro = document.getElementById('formCadastro');

            // Função para validar CPF
            function validarCPF(cpf) {
                cpf = cpf.replace(/\D/g, '');
                if (cpf.length !== 11 || /^(\d)\1+$/.test(cpf)) return false;

                let soma = 0, resto;

                // Primeiro dígito verificador
                for (let i = 1; i <= 9; i++) {
                    soma += parseInt(cpf[i - 1]) * (11 - i);
                }
                resto = (soma * 10) % 11;
                if (resto === 10 || resto === 11) resto = 0;
                if (resto !== parseInt(cpf[9])) return false;

                // Segundo dígito verificador
                soma = 0;
                for (let i = 1; i <= 10; i++) {
                    soma += parseInt(cpf[i - 1]) * (12 - i);
                }
                resto = (soma * 10) % 11;
                if (resto === 10 || resto === 11) resto = 0;

                return resto === parseInt(cpf[10]);
            }

            // Função para validar telefone
            function validarTelefone(telefone) {
                const telefoneAjustado = telefone.replace(/\D/g, '');
                return telefoneAjustado.length === 10 || telefoneAjustado.length === 11;
            }

            // Validação de Nome e Nome Materno
            function validarTexto(texto) {
                return texto.length >= 15;
            }

            // Eventos para validação
            nomeInput.addEventListener('input', () => {
                const isValid = validarTexto(nomeInput.value);
                nomeError.textContent = isValid ? '' : 'O nome deve conter pelo menos 15 caracteres.';
            });

            nomeMaternoInput.addEventListener('input', () => {
                const isValid = validarTexto(nomeMaternoInput.value);
                nomeMaternoError.textContent = isValid ? '' : 'O nome materno deve conter pelo menos 15 caracteres.';
            });

            cpfInput.addEventListener('input', () => {
                const isValid = validarCPF(cpfInput.value);
                cpfError.textContent = isValid ? '' : 'CPF inválido.';
            });

            telefoneInput.addEventListener('input', () => {
                const isValid = validarTelefone(telefoneInput.value);
                telefoneError.textContent = isValid ? '' : 'Número de telefone inválido.';
            });

            // Máscaras
            cpfInput.addEventListener('input', (e) => {
                let value = e.target.value.replace(/\D/g, '');
                value = value.replace(/(\d{3})(\d)/, '$1.$2');
                value = value.replace(/(\d{3})(\d)/, '$1.$2');
                value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
                e.target.value = value;
            });

            telefoneInput.addEventListener('input', (e) => {
                let value = e.target.value.replace(/\D/g, '');
                value = value.replace(/(\d{2})(\d)/, '($1) $2');
                if (value.length > 10) {
                    value = value.replace(/(\d{5})(\d{4})$/, '$1-$2');
                } else {
                    value = value.replace(/(\d{4})(\d{4})$/, '$1-$2');
                }
                e.target.value = value;
            });

            // Verificação antes de enviar o formulário
            formCadastro.addEventListener('submit', (e) => {
                if (
                    !validarTexto(nomeInput.value) ||
                    !validarTexto(nomeMaternoInput.value) ||
                    !validarCPF(cpfInput.value) ||
                    !validarTelefone(telefoneInput.value)
                ) {
                    e.preventDefault();
                    alert('Por favor, corrija os erros antes de enviar o formulário.');
                }
            });
        });
            /*preenchimento automatico do endereço com o CEP*/
            let idCep = document.querySelector('#idCep');
            let idRua = document.querySelector('#idRua');
            let idCidade = document.querySelector('#idCidade');
            let idEstado = document.querySelector('#idEstado');
            let idBairro = document.querySelector('#idBairro');

            idCep.addEventListener('blur', function(e){
                let idCep = e.target.value;
                let script = document.createElement('script');
                script.src = 'https://viacep.com.br/ws/'+idCep+'/json/?callback=popularform';
                document.body.appendChild(script);
            });
            function popularform(resposta){
                if ("erro" in resposta){
                    alert('CEP não encontrado');
                    retorn;
                };

                console.log(resposta);
                idRua.value = resposta.logradouro;
                idCidade.value = resposta.localidade;
                idBairro.value = resposta.bairro;
                idEstado.value = resposta.uf;
                
            };
    </script>
</body>
</html>
