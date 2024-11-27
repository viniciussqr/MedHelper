
document.getElementById("btnAvançar2_").addEventListener("click", function () {
  window.location.href = "Cadastro_Médico3.html";
});


document.getElementById("btnVoltar2_").addEventListener("click", function () {
  window.location.href = "Cadastro_Médico.html";
});




/* document.addEventListener("DOMContentLoaded", () => {
  const steps = document.querySelectorAll(".Etapa");
  const nextButtons = document.querySelectorAll(".Avançar");
  const prevButtons = document.querySelectorAll(".Voltar");
  let currentStep = 0;

  function showStep(index) {
    steps.forEach((step, i) => {
      step.classList.toggle("active", i === index);
    });
  }

  nextButtons.forEach((button) => {
    button.addEventListener("click", () => {
      if (currentStep < steps.length - 1) {
        currentStep++;
        showStep(currentStep);
      }
    });
  });

  prevButtons.forEach((button) => {
    button.addEventListener("click", () => {
      if (currentStep > 0) {
        currentStep--;
        showStep(currentStep);
      }
    });
  });

  document.getElementById("StepForm").addEventListener("submit", (e) => {
    e.preventDefault();
    alert("Cadastro finalizado com sucesso!");
    // Aqui você pode adicionar lógica para enviar os dados do formulário.
  });
});

  /*   var passoexibido = function () {
      var index = parseInt($(".Etapa:visible").index());
      if (index == 0) {
        $("#Voltar").prop("disabled", true);
      } else if (index == parseInt($(".Etapa").length) - 1) {
        $("#Avançar").prop("disabled", true);
      } else {
        $("#Avançar").prop("disabled", false);
        $("#Voltar").prop("disabled", false);
      }
    };
    
    passoexibido();

    $("#Avançar").click(function(){
        $(".Etapa:visible").hide().next().show();
        passoexibido();
    });

    $("#Voltar").click(function(){
        $(".Etapa:visible").hide().next().show();
        passoexibido();
    }); */
 