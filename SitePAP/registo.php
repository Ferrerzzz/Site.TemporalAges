<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <title>Registo</title>
  <link rel="stylesheet" href="css/registo-style.css">
</head>
<body>

  <!-- Navbar -->
  <div class="navbar-container">
    <div class="navbar">
      <div class="nav-left">
        <div class="logo">
          <a href="index.html"><img src="imagens/logo.png" alt="temporalAges" width="60"></a>
        </div>

        <div class="dropdown">
          <span class="nav-link">Temporal Ages</span>
          <div class="dropdown-content">
            <a href="index.html">Visão geral</a>
            <a href="comoJogar.html">Como jogar</a>
          </div>
        </div>

        <a class="nav-link" href="personagens.html">Personagens</a>
        <a class="nav-link" href="mapas.html">Mapas</a>
        <a class="nav-link" href="noticias.php">Notícias</a>

        <div class="dropdown">
          <span class="nav-link">Suporte</span>
          <div class="dropdown-content">
            <a href="forum.php">Fóruns</a>
            <a href="contacto.html">Contacte-nos</a>
          </div>
        </div>
      </div>

      <div class="nav-right">
        <div class="dropdown">
          <span class="nav-link">Conta</span>
          <div class="dropdown-content">
            <a href="login.html">Login</a>
            <a href="registo.php">Registo</a>
          </div>
        </div>
        <a href="TemporalAges.rar" download>
          <button class="btn-jogue">Jogar Agora</button>
        </a>
      </div>
    </div>
  </div>

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


  <!-- Navbar: se houver sessão iniciada, mostra o menu do utilizador -->
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const dados = localStorage.getItem("utilizadorLogado");

      if (dados) {
        const user = JSON.parse(dados);

        const dropdown = document.querySelector(".nav-right .dropdown");

        const isAdmin = user.gameTag.toLowerCase() === "admin";

        let adminOptions = "";
        if (isAdmin) {
          adminOptions = `
            <hr style="margin: 6px 0;">
            <a href="listagem_utilizadores.php">Listagem de Utilizadores</a>
            <a href="adicionar_noticia.php">Adicionar Notícia</a>
            <a href="eliminar_noticias.php">Eliminar Noticia</a>
            <a href="eliminar_post.php">Eliminar Post</a>
          `;
        }

        dropdown.innerHTML = `
          <span class="nav-link">${user.gameTag}</span>
          <div class="dropdown-content">
            <div style="padding: 12px 18px; font-weight: bold;">
              ${user.gameTag}<br>
              <span style="font-size: 0.85em; font-weight: normal;">${user.email}</span>
            </div>
            <a href="#" onclick="logout()">Terminar Sessão</a>
            ${adminOptions}
            <a href="editar_utilizador.php?tag=${encodeURIComponent(user.email)}">Editar os seus dados</a>
          </div>
        `;
      }
    });

    function logout() {
      localStorage.removeItem("utilizadorLogado");
      location.reload();
    }
  </script>

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
