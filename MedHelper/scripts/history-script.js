document.addEventListener("DOMContentLoaded", function () {
    const historyContainer = document.getElementById("historyContainer");
    const filterBtn = document.getElementById("filterBtn");
    const filterItems = document.querySelectorAll(".dropdown-item");
    const searchInput = document.getElementById("searchInput");
    const emptyMessage = document.getElementById("emptyMessage");
    const historyCardTemplate = document.getElementById("historyCardTemplate").content;
    let patientHistory = []; // Armazena os dados dos pacientes

    // Função para renderizar histórico
    function renderHistory(Patients) {
        historyContainer.innerHTML = "";

        if (!Array.isArray(Patients) || Patients.length === 0) {
            emptyMessage.classList.remove("d-none");
            return;
        }

        emptyMessage.classList.add("d-none");

        Patients.forEach(patient => {
            const card = historyCardTemplate.cloneNode(true);
            card.querySelector('.finalizacao').textContent = `Finalizado em: ${patient.data}`;
            card.querySelector('.patient-name').textContent = patient.nome;
            card.querySelector('.matricula').textContent = `Matrícula: ${patient.matricula}`;
            card.querySelector('.gender').textContent = `Gênero: ${patient.genero}`;
            card.querySelector('.age').textContent = `Idade: ${patient.idade}`;
            card.querySelector('.situacao').textContent = `Situação: ${patient.situacao}`;
            card.querySelector('.medicamento').textContent = `Medicamento: ${patient.medicamento}`;
            card.querySelector('.number').textContent = `Quantidade: ${patient.qtd_medicamento}`;

            historyContainer.appendChild(card);
        });
    }

    // Função para filtrar histórico
    function filterHistory() {
        const searchTerm = searchInput.value.toLowerCase();
        const filter = filterBtn.getAttribute("data-filter");

        let filteredPatients = [...patientHistory];

        if (filter !== "all") {
            if (filter.toLowerCase() === "masculino" || filter.toLowerCase() === "feminino") {
                filteredPatients = filteredPatients.filter(patient => patient.genero.toLowerCase() === filter.toLowerCase());
            } else if (filter === "Jovem") {
                filteredPatients = filteredPatients.filter(patient => patient.idade < 18);
            } else if (filter === "Adulto") {
                filteredPatients = filteredPatients.filter(patient => patient.idade >= 18 && patient.idade < 60);
            } else if (filter === "Idoso") {
                filteredPatients = filteredPatients.filter(patient => patient.idade >= 60);
            }
        }

        if (searchTerm) {
            filteredPatients = filteredPatients.filter(patient =>
                patient.nome.toLowerCase().includes(searchTerm)
            );
        }

        renderHistory(filteredPatients);
    }

    // Função para buscar dados do backend
    async function fetchData() {
        const searchTerm = searchInput.value.trim();
        const filter = filterBtn.getAttribute("data-filter") || "all";
        const url = `history.php?search=${encodeURIComponent(searchTerm)}&filter=${encodeURIComponent(filter)}`;

        try {
            const response = await fetch(url);
            const text = await response.text(); // Pega o texto bruto da resposta
            console.log("Resposta bruta da API:", text);

            const data = JSON.parse(text); // Tenta converter para JSON

            if (data.success && Array.isArray(data.pacientes)) {
                patientHistory = data.pacientes; // Atualiza o histórico global
                renderHistory(patientHistory);
            } else {
                patientHistory = [];
                renderHistory([]);
            }
        } catch (error) {
            console.error("Erro ao buscar dados:", error);
            renderHistory([]);
        }
    }

    // Eventos de filtro
    filterItems.forEach(item => {
        item.addEventListener("click", function () {
            const filter = this.getAttribute("data-filter");
            filterBtn.setAttribute("data-filter", filter);
            filterBtn.textContent = `${this.textContent} `;
            const icon = document.createElement("i");
            icon.className = "bi bi-funnel";
            filterBtn.appendChild(icon);

            filterHistory();
        });
    });

    // Evento para busca
    searchInput.addEventListener("input", filterHistory);

    // Busca inicial de dados
    fetchData();
});
