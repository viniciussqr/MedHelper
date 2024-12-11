document.getElementById("formCadastroServidor").addEventListener('submit', function (event) {
  event.preventDefault(); 

  const nome = document.getElementById('nome').value.trim();
  const usuario = document.getElementById('usuario').value;
  const email = document.getElementById('email').value.trim();
  const telefone = document.getElementById('telefone').value.trim();
  const siape = document.getElementById('siape').value.trim();
  const senha = document.getElementById('senha').value;
  const confirmarSenha = document.getElementById('confirmarSenha').value;

  if (!nome || !usuario || !email || !senha || !confirmarSenha || !telefone || !siape) {
    alert("Por favor, preencha todos os campos!!");
    return;
  }

  if (senha !== confirmarSenha) {
    alert("As senhas não coincidem.");
    return;
  }

  const formData = new FormData();
  formData.append('nome', nome);
  formData.append('usuario', usuario);
  formData.append('email', email);
  formData.append('senha', senha);
  formData.append('telefone', telefone);
  formData.append('siape', siape);

  fetch('cadastro-servidor.php', {
    method: 'POST',
    body: formData
  })
    .then(response => response.json())
    .then(data => {
      if (data.status === 'sucesso') {
        alert(data.status);
        setTimeout(() => {
          window.location.href = "login-servidor.html"; // Redireciona para a página da loja
        }, 1000);
      } else {
        alert(data.status);
      }
    })
    .catch(error => {
      alert(data.mensagem);
    });


});