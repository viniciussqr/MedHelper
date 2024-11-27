document.getElementById('btnAvançar').addEventListener('click', function() {
  // Coleta os dados do formulário
  const form = document.getElementById('StepForm');
  const formData = new FormData(form);

  // Envia os dados para o PHP usando fetch
  fetch('Cadastro.php', {
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
