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
/*Validação do site*/
function validateForm() {
    var nome = document.getElementById("nome").value;
    var login = document.getElementById("login").value;
    var senha = document.getElementById("senha").value;
    var repete_senha = document.getElementById("idCSenha").value;
    var errorMessage = document.getElementById("error-message");

    if (nome.length < 10) {
        errorMessage.textContent = "Nome deve ter ao menos 10 caracteres.";
        return false;
    }
    if (login.length < 4) {
        errorMessage.textContent = "Login deve ter ao menos 4 caracteres.";
        return false;
    }
    if (senha.length < 8) {
        errorMessage.textContent = "Senha deve ter ao menos 8 caracteres.";
        return false;
    }
    if (senha !== repete_senha) {
        errorMessage.textContent = "As Senhas devem ser iguais.";
        return false;
    }
    return true;
}

const enviar = document.getElementById('enviar');
            
            enviar.addEventListener('click', () => {
                alert('Cadastro realizado com sucesso!');
            });

/*Validação do CPF*/
const validaCPF = (cpf) => {
    cpf = cpf.replace(/\D/g, '')

    if(cpf.length !== 11){
        console.error('CPF inválido. Faltam números')
        return
    }

    const proximoDigitoVerificador = (cpfIncompleto) => {
        let somatoria = 0

        for (let i = 0; i< cpfIncompleto.length; i++) {
          let digitoAtual = cpfIncompleto.charAt[i];
          console.log(digitoAtual)
          let constante = (cpfIncompleto.length + i - i)

          somatoria += Number(digitoAtual) + constante

          console.log(constante)
           
        }
        const resto = somatoria % 11

        return resto < 2 ? "0" : (11 - resto).toString
    }
    let primeiroDigitoVerificador = proximoDigitoVerificador(cpf.substring(0,9))
    let segundoDigitoVerificador = proximoDigitoVerificador(cpf.substring(0,9) + primeiroDigitoVerificador)
    
    let cpfcorreto = cpf.substring(0,9) + primeiroDigitoVerificador + segundoDigitoVerificador

    if(cpf !== cpfcorreto) {
        console.error('CPF Invalido. Faltam números')
        return
    }

    console.log("CPF Valido!")
    return true
}