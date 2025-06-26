<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <title>Registo</title>
  <link rel="stylesheet" href="css/registo-style.css">
</head>
<body>

   <div class="step active" id="step-1">
    <h1>Temporal Ages</h1>
    <p>Campo obrigatório</p>
    <label for="data-nascimento">Data de nascimento</label>
    <input type="date" id="data-nascimento" name="data_nascimento" value="2000-12-12" required>
    <p class="login">Já tem uma conta? <a href="login.html">Conecte-se</a></p>
    <button type="button" onclick="nextStep()">Continuar</button>
  </div>

  <div class="step" id="step-2">
    <h1>Temporal Ages</h1>
    <p>Campos Opcionais</p>
    <label for="nome">Nome</label>
    <input type="text" id="nome" name="nome" placeholder="Primeiro nome">
    <label for="sobrenome">Sobrenome</label>
    <input type="text" id="sobrenome" name="sobrenome" placeholder="Último nome">
    <button type="button" onclick="nextStep()">Continuar</button>
  </div>

  <div class="step" id="step-3">
    <h1>Temporal Ages</h1>
    <p>Campo obrigatório</p>
    <label for="email">E-mail da conta</label>
    <input type="email" id="email" name="email" required>
    <button type="button" onclick="nextStep()">Continuar</button>
  </div>

  <div class="step" id="step-4">
    <h1>Temporal Ages</h1>
    <p>Proteja sua conta e escolha uma senha forte.</p>
    <p>Campo obrigatório</p>
    <label for="senha">Senha</label>
    <input type="password" id="senha" name="senha" required>
    <button type="button" onclick="nextStep()">Continuar</button>
  </div>

  <div class="step" id="step-5">
    <h1>Temporal Ages</h1>
    <p>Confirme sua senha anterior.</p>
    <label for="senha2">Confirmar Senha</label>
    <input type="password" id="senha2" required>
    <button type="button" onclick="nextStep()">Continuar</button>
  </div>

  <div class="step" id="step-6">
    <h1>Temporal Ages</h1>
    <p>Campo obrigatório</p>
    <label for="battletag">Game Tag</label>
    <input type="text" id="battletag" name="battletag" placeholder="Ex: Ferrerzzz" required>
    <button type="button" onclick="nextStep()">Continuar</button>
  </div>



  <div class="step" id="step-7">
  <h1>Tudo pronto!</h1>
  <p>A seguinte conta foi criada:</p>
  <div class="green" id="dados-confirmacao">
   
  </div>

  <form action="adicionar-registo-user.php" method="POST">
    <input type="hidden" id="final-email" name="email">
    <input type="hidden" id="final-senha" name="senha">
    <input type="hidden" id="final-battletag" name="battletag">
    <input type="hidden" id="final-data" name="data_nascimento">
    <input type="hidden" id="final-nome" name="nome">
    <input type="hidden" id="final-sobrenome" name="sobrenome">
    <button type="submit">Confirmar e Enviar</button>
  </form>
</div>

    <div class="progress-dots-container">
    <div class="progress-dots">
      <span class="dot" data-step="1"></span>
      <span class="dot" data-step="2"></span>
      <span class="dot" data-step="3"></span>
      <span class="dot" data-step="4"></span>
      <span class="dot" data-step="5"></span>
      <span class="dot" data-step="6"></span>
      <span class="dot" data-step="7"></span>
    </div>
  </div>


  <script>
    let currentStep = 1;
    const totalSteps = 7;
    let email=" ";
    let battletag =" ";
    let pais =" ";
    let data_nascimento = " ";
    let senha=" ";

function nextStep() {
  const currentStepDiv = document.getElementById(`step-${currentStep}`);
  const requiredFields = currentStepDiv.querySelectorAll("[required]");
  let allValid = true;

  requiredFields.forEach(field => {
    if (!field.value.trim()) {
      allValid = false;
      field.classList.add("invalid");
    } else {
      field.classList.remove("invalid");
    }
  });

  if (!allValid) {
    alert("Por favor, preencha todos os campos obrigatórios antes de continuar.");
    return;
  }

  if (currentStep === 5) {
    senha = document.getElementById("senha").value;
    const senha2 = document.getElementById("senha2").value;

    if (senha !== senha2) {
      alert("As senhas não coincidem. Tente novamente.");
      return;
    }
  }

  if (currentStep === 3) {
    email = document.getElementById("email").value;
  }

  if (currentStep < totalSteps) {
    document.getElementById(`step-${currentStep}`).classList.remove("active");
    currentStep++;
    updateDots();
    document.getElementById(`step-${currentStep}`).classList.add("active");
  }

  if (currentStep === 6) {
    battletag = document.getElementById("battletag").value;
  }

  if (currentStep === 1) {
    pais = document.getElementById("pais").value;
    data_nascimento = document.getElementById("data_nascimento").value;
  }

 
  if (currentStep === 7) {

  email = document.getElementById("email").value;
  senha = document.getElementById("senha").value;
  const nome = document.getElementById("nome").value;
  const sobrenome = document.getElementById("sobrenome").value;
  battletag = document.getElementById("battletag").value;
  data_nascimento = document.getElementById("data-nascimento").value;


  document.getElementById("final-email").value = email;
  document.getElementById("final-senha").value = senha;
  document.getElementById("final-battletag").value = battletag;
  document.getElementById("final-data").value = data_nascimento;
  document.getElementById("final-nome").value = nome;
  document.getElementById("final-sobrenome").value = sobrenome;


const dadosDiv = document.getElementById("dados-confirmacao");
dadosDiv.innerHTML = `
  <p><strong>Email:</strong> ${email}</p>
`;
}
}

    function updateDots() {
      const dots = document.querySelectorAll(".dot");
      dots.forEach(dot => {
        dot.classList.remove("active");
        if (parseInt(dot.getAttribute("data-step")) === currentStep) {
          dot.classList.add("active");
        }
      });
    }
  </script>

</body>
</html>
