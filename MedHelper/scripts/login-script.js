document.getElementById('loginForm').addEventListener('submit', function (event) {
    event.preventDefault();

    const formData = new FormData();
    formData.append('codSiape', document.getElementById('codSiape').value.trim());
    formData.append('password', document.getElementById('password').value.trim());

    const form = document.getElementById('loginForm');

    fetch('login.php', {
        method: 'POST',
        body: formData,
    }).then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                form.reset();
                if (data.tipo === 'Servidor') {
                    setTimeout(() => {
                        window.location.href = "home-server.html";
                    }, 1000);
                } else {
                    setTimeout(() => {
                        window.location.href = "index.html";
                    }, 1000);
                }
            } else {
                alert(data.message);
                form.reset();
            }

        }).catch(error => {
            console.error('Erro na requisição:', error);
            alert('Ocorreu um erro ao processar sua solicitação. Tente novamente mais tarde.');
            form.reset();
        });

});

document.getElementById('togglePassword').addEventListener('click', function () {
    var passwordInput = document.getElementById('password');
    var icon = this.querySelector('i');
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
    } else {
        passwordInput.type = 'password';
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
    }
});
