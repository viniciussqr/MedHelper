document.getElementById('register-patient-form').addEventListener('submit', function (e) {
    e.preventDefault();

    const formData = new FormData();
    formData.append('patientName', document.getElementById('patientName').value.trim());
    formData.append('patientMatricula', document.getElementById('patientMatricula').value.trim());
    formData.append('patientGender', document.getElementById('patientGender').value.trim());
    formData.append('patientAge', document.getElementById('patientAge').value.trim());

    const form = this;

    fetch('register-patient.php', {
        method: 'POST',
        body: formData,
    })
        .then(response => response.json())
        .then((data) => {
            if (data.success) {
                alert(data.message);
                form.reset();
                setTimeout(() => {
                    window.location.href = "home-server.html";
                }, 1000);
            } else if (data.error) {
                alert(data.message);
                form.reset();
                setTimeout(() => {
                    window.location.href = "register-patient.html";
                }, 1000);
            } else {
                alert("Ocorreu um erro inesperado. Tente novamente.");
                form.reset();
                setTimeout(() => {
                    window.location.href = "register-patient.html";
                }, 1000);
            }
        })
        .catch(error => {
            console.error('Erro na requisição:', error);
            alert('Ocorreu um erro ao processar sua solicitação. Tente novamente mais tarde.');
        });
});

// Impedir entrada de letras no campo de idade
document.getElementById('patientAge').addEventListener('input', function () {
    this.value = this.value.replace(/[^0-9]/g, '');
});
