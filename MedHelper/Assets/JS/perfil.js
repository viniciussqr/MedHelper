document.getElementById('btnLabel').addEventListener('submit', () => {
    
    if (confirm('Você tem certeza que deseja sair da conta?')) {
      fetch('logout.php', {
        method: 'POST', 
        headers: {
          'Content-Type': 'application/json',
        },
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.status === 'sucesso') {
            alert(data.message); 
            window.location.href = 'login.html'; 
          } else {
            alert('Erro ao encerrar a sessão. Tente novamente.');
          }
        })
        .catch((error) => {
          console.error('Erro na requisição de logout:', error);
          alert('Ocorreu um erro. Tente novamente.');
        });
    }
  });
  