document.addEventListener('DOMContentLoaded', function () {
    const adicionarEstoqueBtn = document.querySelector('.action-btn.adicionar-estoque');
    adicionarEstoqueBtn.addEventListener('click', function () {
        window.location.href = 'add-stock.html';
    });

    const registrarPacienteBtn = document.querySelector('.action-btn.registrar-paciente');
    registrarPacienteBtn.addEventListener('click', function () {
        window.location.href = 'register-patient.html';
    });
});
