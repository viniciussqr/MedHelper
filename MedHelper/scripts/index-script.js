document.addEventListener('DOMContentLoaded', function () {
    const estoqueBtn = document.querySelector('.action-btn.estoque');
    estoqueBtn.addEventListener('click', function () {
        window.location.href = 'stock.html';
    });

    const atendimentoBtn = document.querySelector('.action-btn.atendimento');
    atendimentoBtn.addEventListener('click', function () {
        window.location.href = 'appointments.html';
    });

    const historicoBtn = document.querySelector('.action-btn.historico');
    historicoBtn.addEventListener('click', function () {
        window.location.href = 'history.html';
    });
});
