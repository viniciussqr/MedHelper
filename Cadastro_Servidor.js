document.getElementById('btnCriarConta').addEventListener('click', function() {
  // Coleta os dados do formulário
  const form = document.getElementById('StepForm');
  const formData = new FormData(form);

  // Envia os dados para o PHP usando fetch
  fetch('Conexao.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.json())  // Espera uma resposta JSON
  .then(data => {
    if (data.success) {
      // Se a inserção for bem-sucedida, redireciona ou exibe uma mensagem de sucesso
      alert("Cadastro realizado com sucesso!");
      window.location.href = "Login.html";  // Redireciona para a página de login
    } else {
      alert("Erro ao cadastrar. Tente novamente.");
    }
  })
  .catch(error => {
    console.error("Erro na requisição:", error);
    alert("Ocorreu um erro. Tente novamente.");
  });
});
 
 
// Adiciona o evento de envio ao formulário, não ao botão


/* document.getElementById("StepForm").addEventListener("submit", async function (event) {
  event.preventDefault(); // Impede o envio padrão do formulário

  // Captura os dados do formulário
  const formData = new FormData(event.target);

  // Opções para o Fetch API
  const options = {
    method: 'POST',
    body: formData,
  };

  try {
    // Envia os dados para o PHP
    const response = await fetch("ConexaoCadastro.php", options);

    if (!response.ok) {
      throw new Error(`Erro: ${response.status}`);
    }

    // Lê a resposta do servidor
    const result = await response.text();

    // Tratamento da resposta
    if (result.includes("sucesso")) {
      alert("Cadastro realizado com sucesso!");
      window.location.href = "Login.html"; // Redireciona para a página de login
    } else {
      alert(result); // Exibe o erro retornado pelo PHP
    }
  } catch (error) {
    console.error("Erro ao enviar os dados:", error);
    alert("Ocorreu um erro. Tente novamente.");
  }
});
 */