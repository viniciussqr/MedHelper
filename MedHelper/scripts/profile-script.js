const editButton = document.getElementById('edit-btn');
editButton.addEventListener('click', function () {
    const inputs = document.querySelectorAll('#profile-form input');
    inputs.forEach(input => input.disabled = false);
    const buttons = document.querySelectorAll('#profile-form button');
    buttons.forEach(button => button.disabled = false);

    document.getElementById('edit-btn').style.display = 'none';
    document.getElementById('save-btn').style.display = 'inline';
});

document.getElementById('btn-logout').addEventListener('click', () => {
    fetch("logout.php", {
        method: "POST", // Requisição do tipo POST
        headers: {
            "Content-Type": "application/json", // Define o formato de envio
        },
    })
        .then(response => response.json()) // Converte a resposta para JSON
        .then(data => {
            if (data.success) {
                alert(data.message); // Exibe a mensagem de sucesso
                setTimeout(() => {
                    window.location.href = "login.html";
                }, 1000); // Redireciona para a página de login
            } else {
                alert("Erro ao encerrar a sessão. Tente novamente.");
            }
        })
        .catch(error => {
            console.error("Erro ao sair da sessão:", error);
            alert("Ocorreu um erro inesperado.");
        });
});


document.getElementById('profile-form').addEventListener('submit', function (event) {
    event.preventDefault();

    const formData = new FormData();
    formData.append('name', document.getElementById('name').value.trim());
    formData.append('email', document.getElementById('email').value.trim());
    formData.append('phone', document.getElementById('phone').value.trim());
    formData.append('password', document.getElementById('password').value.trim());


    fetch('update-profile.php', {
        method: 'POST',
        body: formData,
    }).then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                setTimeout(() => {
                    window.location.href = "profile.php";
                });

            } else {
                alert(data.message);
            }
        }).catch(error => {
            alert("Erro na requisição" + error);

        });

});


// Toggle Password Visibility
const togglePasswordBtn = document.getElementById('togglePassword');
togglePasswordBtn.addEventListener('click', function () {
    const passwordInput = document.getElementById('password');
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);
    this.querySelector('i').classList.toggle('bi-eye');
    this.querySelector('i').classList.toggle('bi-eye-slash');
});

