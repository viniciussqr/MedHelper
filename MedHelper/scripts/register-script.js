function validarFormulario() {
    const email = document.getElementById('email').value.trim();
    const phone = document.getElementById('phone').value.trim();

    // Validação simples de email
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        alert("Por favor, insira um e-mail válido.");
        return false;
    }

    // Validação simples de telefone (apenas números)
    const phoneRegex = /^[0-9]{10,11}$/;
    if (!phoneRegex.test(phone)) {
        alert("Por favor, insira um número de telefone válido.");
        return false;
    }

    return true;
}

document.getElementById('registerForm').addEventListener('submit', function (event) {

    event.preventDefault();

    if (!validarFormulario()) {
        return;
    }

    const confirmPassword = document.getElementById('confirmPassword').value.trim();
    const password = document.getElementById('password').value.trim();

    if (password !== confirmPassword) {
        alert("As senhas não coincidem.");
        return;
    }

    const formData = new FormData();
    formData.append('userType', document.getElementById('userType').value.trim());
    formData.append('name', document.getElementById('name').value.trim());
    formData.append('phone', document.getElementById('phone').value.trim());
    formData.append('email', document.getElementById('email').value.trim());
    formData.append('codSiape', document.getElementById('codSiape').value.trim());
    formData.append('password', document.getElementById('password').value.trim());
    if (document.getElementById('userType').value === 'medico') {
        formData.append('specialization', document.getElementById('specialization').value.trim());
        formData.append('crm', document.getElementById('crm').value.trim());
    }

    const form = this;

    fetch('register.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Cadastro realizado com sucesso.");
                form.reset();
                setTimeout(() => {
                    window.location.href = "login.html";
                }, 1000);
            } else {
                alert(data.message);
            }

        })
        .catch(error => {
            console.error('Erro na requisição:', error);
            alert('Ocorreu um erro ao processar sua solicitação. Tente novamente mais tarde.');
            form.reset();
        });
});


document.getElementById('togglePassword1').addEventListener('click', function () {
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

document.getElementById('togglePassword2').addEventListener('click', function () {
    var confirmPasswordInput = document.getElementById('confirmPassword');
    var icon = this.querySelector('i');
    if (confirmPasswordInput.type === 'password') {
        confirmPasswordInput.type = 'text';
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
    } else {
        confirmPasswordInput.type = 'password';
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
    }
});

document.getElementById('userType').addEventListener('change', function () {
    var medicoFields = document.getElementById('medicoFields');
    if (this.value === 'medico') {
        medicoFields.classList.remove('d-none');
    } else {
        medicoFields.classList.add('d-none');
    }
});





