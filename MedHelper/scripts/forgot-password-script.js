document.getElementById('forgot-password-form').addEventListener('submit', function (e) {
    e.preventDefault();

    var email = document.getElementById('email').value;
    var messageContent = `
        <p>Olá,</p>
        <p>Recebemos uma solicitação para redefinir sua senha no MedHelper. Se foi você que fez essa solicitação, clique no link abaixo para criar uma nova senha:</p>
        <a href="https://medhelper.com/reset-password?email=${encodeURIComponent(email)}">Clique aqui para redefinir sua senha</a>
        <p>Se você não fez essa solicitação, não precisa se preocupar. Sua senha continuará segura e você pode ignorar esta mensagem.</p>
        <p>Atenciosamente,<br>Equipe MedHelper</p>
    `;

    fetch('http://localhost:3000/send-email', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            to: email,
            subject: 'Redefinir Senha - MedHelper',
            body: messageContent
        }),
    })
        .then(response => response.text())
        .then(data => {
            alert(data);
        })
        .catch(error => {
            console.error('Erro:', error);
            alert('Houve um problema ao enviar o e-mail.');
        });
});
