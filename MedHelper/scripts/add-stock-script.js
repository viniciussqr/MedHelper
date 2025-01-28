document.getElementById('add-stock-form').addEventListener('submit', function (e) {

    e.preventDefault();

    const formData = new FormData();
    formData.append('medName', document.getElementById('medName').value.trim());
    formData.append('medQuantity', document.getElementById('medQuantity').value.trim());
    formData.append('medType', document.getElementById('medType').value.trim());

    const form = this;

    fetch('add-stock.php', {
        method: 'POST',
        body: formData,
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                form.reset();
                setTimeout(() => {
                    window.location.href = "home-server.html";
                }, 1000);
            } else {
                alert("Erro: "+ error);
                form.reset();
            }
        })
        .catch(error => {
            alert(error);
            form.reset();
        });




    const medQuantityInput = document.getElementById('medQuantity');
    medQuantityInput.addEventListener('input', function () {
        this.value = this.value.replace(/[^0-9]/g, ''); // Aceitar apenas números
        if (this.value < 0) {
            this.value = 0; // Garantir que o valor não seja negativo
        }
    });

});
