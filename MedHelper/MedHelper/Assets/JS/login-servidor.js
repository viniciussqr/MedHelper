document.getElementById("formLoginServidor").addEventListener('submit', function (event) {
    event.preventDefault(); // Impede o envio padrão do formulário

    const siape = document.getElementById('siape').value.trim();
    const senha = document.getElementById('senha').value;
    const mensagem = document.getElementById('mensagem'); // Adicione um elemento para exibir mensagens

    if (!siape || !senha) {
        mensagem.textContent = 'Por favor, preencha todos os campos.';
        mensagem.className = 'mensagem-erro';
        return;
    }

    const formData = new FormData();
    formData.append('siape', siape);
    formData.append('senha', senha);

    fetch('login-servidor.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'sucesso') {
                mensagem.textContent = data.mensagem;
                mensagem.className = 'mensagem-sucesso';
                setTimeout(() => {
                    window.location.href = "home.html"; // Redireciona para a página home.html
                }, 1000);
            } else {
                mensagem.textContent = data.mensagem;
                mensagem.className = 'mensagem-erro';
            }
        })
        .catch(error => {
            mensagem.textContent = 'Erro ao processar o login. Tente novamente.';
            mensagem.className = 'mensagem-erro';
        });
});
