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