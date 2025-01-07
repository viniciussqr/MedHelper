document.getElementById("formLoginMedico").addEventListener("submit", function (event) {
    event.preventDefault();

    const siape = document.getElementById('siape').value.trim();
    const senha = document.getElementById('senha').value;

    if (!siape || !senha) {
        alert("Por favor, preencha todos os campos!!");
        return;
    }

    const formData = new FormData();
    formData.append('siape', siape);
    formData.append('senha', senha);


    fetch('login-medico.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'sucesso') {
                alert(data.status);
                setTimeout(() => {
                    window.location.href = "home.html";
                }, 1000);
            } else {
                alert(data.status);
            }
        })
        .catch(error => {
            alert(data.mensagem);
        });
});

