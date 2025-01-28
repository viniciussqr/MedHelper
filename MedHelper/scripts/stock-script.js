document.addEventListener('DOMContentLoaded', function () {
    const cardStock = document.getElementById('stockContainer');
    const emptyMessage = document.getElementById('emptyMessage');
    const searchInput = document.getElementById('searchInput');
    const filterMenu = document.querySelectorAll('.dropdown-menu .dropdown-item');

    const definirIconeECor = (tipo) => {
        if (tipo.toLowerCase() === 'pomada') {
            return { icone: 'bi bi-droplet', cor: '#007bff' };
        }
        return { icone: 'bi bi-capsule', cor: '#007bff' };
    };

    // Função para criar os cards dos produtos
    const criarCardProduto = (produto) => {

        emptyMessage.classList.add('d-none');
        const { icone, cor } = definirIconeECor(produto.tipo_produto);
        const card = document.createElement('div');
        card.classList.add('card-medicine');
        card.style.borderColor = produto.qtd_atual === 0 ? '#dc3545' : cor;

        const icon = document.createElement('i');
        icon.className = `icon-med ${icone}`;
        icon.style.color = produto.qtd_atual === 0 ? "#dc3545" : cor;
        card.appendChild(icon);

        // Nome do produto
        const name = document.createElement('h5');
        name.innerText = produto.nome;
        name.style.color = produto.qtd_atual === 0 ? '#dc3545' : cor;

        card.appendChild(name);

        // Tipo do produto
        const type = document.createElement('p');
        type.innerText = `Tipo: ${produto.tipo_produto}`;
        type.style.color = produto.qtd_atual === 0 ? "#dc3545" : cor;
        card.appendChild(type);

        // Quantidade do produto
        const quantity = document.createElement('p');
        quantity.style.color = produto.qtd_atual === 0 ? "#dc3545" : cor;
        quantity.innerHTML = `
            Quantidade: 
            <input type="number" value="${produto.qtd_atual}" class="form-control d-inline-block w-50" min="0" readonly>
        `;

        card.appendChild(quantity);

        quantity.querySelector('input').addEventListener('input', function () {
            const newQuantity = parseInt(this.value);
            if (isNaN(newQuantity) || newQuantity < 0) this.value = 0;
            const updatedColor = newQuantity === 0 ? "#dc3545" : cor;
            this.style.color = updatedColor;
            icon.style.color = updatedColor;
            name.style.color = updatedColor;
            type.style.color = updatedColor;
            card.style.borderColor = updatedColor;
        });

        return card;
    };

    // Função para carregar os produtos do backend
    const carregarProdutos = (filtro = '', tipo = '') => {
        const url = `stock.php?search=${encodeURIComponent(filtro)}&filter=${encodeURIComponent(tipo)}`;

        // Realiza a requisição ao backend
        fetch(url, {
            method: 'GET',
        })
            .then(response => response.json()) // Converte a resposta para JSON
            .then(data => {
                if (data.success) {
                    // Limpa o container de produtos
                    cardStock.innerHTML = '';

                    // Adiciona os produtos ao container
                    data.produtos.forEach(produto => {
                        const card = criarCardProduto(produto);
                        cardStock.appendChild(card);
                    });
                } else {
                    // Exibe uma mensagem caso nenhum produto seja encontrado
                    cardStock.innerHTML = `<p class="text-center text-danger">${data.message || 'Nenhum produto encontrado.'}</p>`;
                }
            })
            .catch(error => {
                console.error('Erro ao carregar os produtos:', error);
                cardStock.innerHTML = `<p class="text-center text-danger">Erro ao carregar produtos.</p>`;
            });
    };

    // Evento para filtrar os produtos ao digitar no campo de busca
    searchInput.addEventListener('input', () => {
        const searchTerm = searchInput.value.trim().toLowerCase();
        carregarProdutos(searchTerm); // Recarrega os produtos com o filtro
    });

    // Evento para aplicar o filtro ao selecionar um item no dropdown
    filterMenu.forEach(item => {
        item.addEventListener('click', (event) => {
            event.preventDefault();
            const tipo = event.target.dataset.filter;

            // Verifica o valor do filtro e recarrega os produtos
            if (tipo === 'all') {
                carregarProdutos(searchInput.value.trim());
            } else {
                carregarProdutos(searchInput.value.trim(), tipo);
            }
        });
    });

    // Inicializa o carregamento de todos os produtos ao carregar a página
    carregarProdutos();
});
