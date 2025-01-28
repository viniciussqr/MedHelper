document.addEventListener("DOMContentLoaded", function () {
    const appointmentsContainer = document.getElementById("appointmentsContainer");
    const filterBtn = document.getElementById("filterBtn");
    const filterItems = document.querySelectorAll(".dropdown-item");
    const searchInput = document.getElementById("searchInput");
    const emptyMessage = document.getElementById("emptyMessage");
    const patientCardTemplate = document.getElementById("patientCardTemplate").content;


    // Função para renderizar pacientes e medicamentos
    const renderData = (data) => {
        appointmentsContainer.innerHTML = ""; // Limpa o container

        const { pacientes, produtos } = data;

        if (pacientes.length === 0) {
            emptyMessage.classList.remove("d-none"); // Mostra mensagem de vazio
        } else {
            emptyMessage.classList.add("d-none"); // Esconde mensagem de vazio

            // Renderiza pacientes e adiciona lista de medicamentos
            pacientes.forEach((paciente) => {
                const card = patientCardTemplate.cloneNode(true);

                // Preenche campos do paciente
                card.querySelector('.patient-name').textContent = paciente.nome;
                card.querySelector('.matricula').textContent = `Matrícula: ${paciente.matricula}`;
                card.querySelector('.gender').textContent = `Gênero: ${paciente.genero}`;
                card.querySelector('.age').textContent = `Idade: ${paciente.idade}`;

                // Preenche a lista de medicamentos no select
                const medicamentoSelect = card.querySelector('.medicamentoSelect');
                produtos.forEach((produto) => {
                    const option = document.createElement('option');
                    option.value = produto.nome;
                    option.textContent = `${produto.nome} (Quantidade: ${produto.qtd_atual})`;
                    medicamentoSelect.appendChild(option);
                });

                // Adiciona o card de paciente ao container
                appointmentsContainer.appendChild(card);
            });
        }
    };

    // Função para buscar e processar dados
    const fetchData = async () => {
        const searchTerm = searchInput.value.trim();
        const filter = filterBtn.getAttribute("data-filter") || "all";
        const url = `appointments.php?search=${encodeURIComponent(searchTerm)}&filter=${encodeURIComponent(filter)}`;

        try {
            const response = await fetch(url);
            const data = await response.json();

            if (data.success) {
                renderData(data);
            } else {
                renderData({ pacientes: [], produtos: [] });
            }
        } catch (error) {
            console.error("Erro ao buscar dados:", error);
            renderData({ pacientes: [], produtos: [] });
        }
    };

    // Adicionar eventos ao filtro
    filterItems.forEach((item) => {
        item.addEventListener("click", function () {
            const filter = this.getAttribute("data-filter");
            filterBtn.setAttribute("data-filter", filter);
            filterBtn.textContent = `${this.textContent} `;
            const icon = document.createElement("i");
            icon.className = "bi bi-funnel";
            filterBtn.appendChild(icon);
            fetchData();
        });
    });

    // Evento para busca
    searchInput.addEventListener("input", fetchData);

    // Busca inicial
    fetchData();

    // Função para habilitar os campos de edição
    document.addEventListener('click', function (event) {
        // Verifica se o botão de edição foi clicado
        if (event.target.closest('.btn-editar')) {
            const cardBody = event.target.closest('.card-body');

            // Habilita os campos necessários dentro do card
            cardBody.querySelectorAll('select, input, textarea, button.btn-finalizar').forEach(element => {
                element.disabled = false;

            });

            // Oculta o botão de edição
            event.target.style.display = 'none';
        }
    });

    // Event listener para o botão "Finalizar Atendimento"

    document.addEventListener('click', function (event) {
        // Verifica se o botão "Finalizar Atendimento" foi clicado
        if (event.target.closest('.btn-finalizar')) {
            const cardBody = event.target.closest('.card-body');


            // Obtém os valores do formulário dentro do cartão correspondente
            const date = new Date();
            const formData = new FormData();
            formData.append('patient-name', cardBody.querySelector('[name="patient-name"]').textContent.trim());
            formData.append('matricula', cardBody.querySelector('[name="matricula"]').textContent.replace('Matrícula: ', '').trim());
            formData.append('gender', cardBody.querySelector('[name="gender"]').textContent.replace('Gênero: ', '').trim());
            formData.append('age', cardBody.querySelector('[name="age"]').textContent.replace('Idade: ', '').trim());
            formData.append('medicamentoSelect', cardBody.querySelector('[name="medicamentoSelect"]').value.trim());
            formData.append('inputNumber', cardBody.querySelector('[name="inputNumber"]').value.trim());
            formData.append('situacao', cardBody.querySelector('[name="situacao"]').value.trim());
            formData.append('data', date.toISOString());


            // Faz a requisição para o backend
            fetch('history.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Atendimento finalizado com sucesso!");
                        setTimeout(() => {
                            window.location.href = "appointments.html";
                        }, 1000);
                    } else {
                        alert(data.message);
                        setTimeout(() => {
                            window.location.href = "appointments.html";
                        }, 1000);
                    }
                })
                .catch(error => {
                    console.error("Ocorreu um erro ao processar a solicitação:", error);
                    setTimeout(() => {
                        window.location.href = "appointments.html";
                    }, 1000);
                });
        }
    });

});
