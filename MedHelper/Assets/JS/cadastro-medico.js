document.getElementById("formCadastroMedico").addEventListener('submit', function (event) {
  event.preventDefault();

  const nome = document.getElementById('nome').value.trim();
  const usuario = document.getElementById('usuario').value;
  const email = document.getElementById('email').value.trim();
  const telefone = document.getElementById('telefone').value.trim();
  const siape = document.getElementById('siape').value.trim();
  const crm = document.getElementById('crm').value.trim();
  const especializacao = document.getElementById('especializacao').value.trim();
  const senha = document.getElementById('senha').value;
  const confirmarSenha = document.getElementById('confirmaSenha').value;

  if (!nome || !usuario || !email || !senha || !confirmarSenha || !telefone || !siape || !crm || !especializacao) {
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
  formData.append('crm', crm);
  formData.append('especializacao', especializacao);

  fetch('cadastro-medico.php', {
    method: 'POST',
    body: formData
  })
    .then(response => response.json())
    .then(data => {
      if (data.status === 'sucesso') {
        alert(data.status);
        setTimeout(() => {
          window.location.href = "login-medico.html";
        }, 1000);
      } else {
        alert(data.status);
      }
    })
    .catch(error => {
      alert(data.mensagem);
    });


});