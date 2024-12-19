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
document.addEventListener('DOMContentLoaded', () => {
            const cpfInput = document.getElementById('idCpf');
            const telefoneInput = document.getElementById('idTelefone');
            const cpfError = document.getElementById('cpfError');
            const telefoneError = document.getElementById('telefoneError');

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

            function validarTelefone(telefone) {
                const telefoneAjustado = telefone.replace(/\D/g, '');
                return telefoneAjustado.length === 10 || telefoneAjustado.length === 11;
            }

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
        });
const enviar = document.getElementById('enviar');
            
            enviar.addEventListener('click', () => {
                alert('Cadastro realizado com sucesso!');
            });


