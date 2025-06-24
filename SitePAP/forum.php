<?php include 'ligacaobd.php'; ?>
<?php $con = ligaBD(); ?>
<!DOCTYPE html>
<html lang="pt-PT">
<head>
  <meta charset="UTF-8">
  <title>Fórum Dungeon 2D</title>
  <link rel="stylesheet" href="css/forum.css">
  
</head>
<body>
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
        </div>
      `;
    }
  });

  function logout() {
    localStorage.removeItem("utilizadorLogado");
    location.reload(); 
  }
</script>


    <div class="navbar-container">
    <div class="navbar">
      <div class="nav-left">
        <div class="logo">
          <img src="imagens/logo.png" alt="temporalAges" width="60">
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
        <button class="btn-jogue">Jogar Agora</button>
      </div>
    </div>
  </div>
<br>
<br>
<br>
<br>
<br>


  <header>
    <h1>Fórum Dungeon 2D: Temporal Ages</h1>
  </header>

  <main>
    <table>
      <thead>
        <tr>
<thead>
  <tr>
    <th>Tópico</th>
    <th>Mensagem</th>
    <th>Data</th>
    <th>Autor</th>
  </tr>
</thead>
        </tr>
      </thead>
      <tbody>
<?php
  $query = $con->query("SELECT * FROM posts ORDER BY data_postagem DESC");
  $id = 0;

  while ($post = $query->fetch_assoc()) {
    $id++;
    $mensagemCompleta = htmlspecialchars($post['mensagem']);
    $mensagemCurta = substr($mensagemCompleta, 0, 50);
    $temMaisTexto = strlen($mensagemCompleta) > 50;

    echo "<tr>";
    echo "<td>" . htmlspecialchars($post['titulo']) . "</td>";

    echo "<td>";
    echo "<div id='resumo-$id'>" . nl2br($mensagemCurta) . ($temMaisTexto ? '...' : '') . "</div>";

    if ($temMaisTexto) {
      echo "<div id='completo-$id' style='display: none;'>" . nl2br($mensagemCompleta) . "</div>";
      echo "<button class='expand-btn' onclick='toggleTexto($id, this)'>Expandir</button>";
    }

    echo "</td>";

    echo "<td>" . date('d/m/Y H:i', strtotime($post['data_postagem'])) . "</td>";
    echo "<td>" . htmlspecialchars($post['autor']) . "</td>";
    echo "</tr>";
  }
?>

      </tbody>
    </table>

  <button class="update-button" onclick="mostrarFormularioNovoPost()">+ Adicionar Nova Publicação</button>


  <div id="form-novo-post" style="display: none; margin-top: 20px;">
  <h2>Criar Novo Post</h2>
  <form method="post" action="processa_post.php">
    <label for="titulo">Título:</label><br>
    <input type="text" id="titulo" name="titulo" required><br><br>

    <label for="mensagem">Mensagem:</label><br>
    <textarea id="mensagem" name="mensagem" rows="5" cols="60" required></textarea><br><br>

    <input type="hidden" id="autor" name="autor"> <!-- será preenchido por JS -->

    <button type="submit">Publicar</button>
  </form>
</div>
  </main>


      <footer id="sobre">
      <div class="footer-container">
          <div class="footer-section">
              <h3>Sobre Nós</h3>
              <p>Temporal Ages</p>
              
          </div>
          
          <div class="footer-section">
              <h3>Ajuda</h3>
              <ul>
                  <li><a href="login.html"><b>Login</b></a></li>
                  <li><a href="registo.php">Registo</a></li>
                  <li><a href="conta.php">Conta</a></li>
                  <li><a href="">Recuperar Palavra-Passe</a></li>
              </ul>
          </div>
  
          <div class="footer-section">
              <h3>Redes Sociais</h3>
              <ul>
                  <li><a href="#" >Facebook</a><br></li>
                  <li><a href="#" >Instagram</a><br></li>
                  <li><a href="#" >Twitter</a><br></li>
                  <li><a href="#" >LinkedIn</a></li>
              </ul>
          </div>
  
          <div class="footer-section">
              <h3>Contate-nos</h3>
              <p>Email: suporte@temporalages.gg</p>
              <p>Telefone: 21 922 9500</p>
              <p>Endereço: R. São Francisco Xavier 87</p>
          </div>
      </div>
      
      <div class="footer-bottom">
          <p>&copy; 2025. Todos os direitos reservados Temporal Ages.</p>
      </div>
        </footer>

<script>
  function mostrarFormularioNovoPost() {
  const form = document.getElementById("form-novo-post");
  const dados = JSON.parse(localStorage.getItem("utilizadorLogado"));

  if (!dados) {
    alert("Tem de fazer login para publicar.");
    return;
  }

  document.getElementById("autor").value = dados.gameTag;
  form.style.display = "block";
}

  function toggleTexto(id, btn) {
    const resumo = document.getElementById(`resumo-${id}`);
    const completo = document.getElementById(`completo-${id}`);

    if (completo.style.display === "none") {
      resumo.style.display = "none";
      completo.style.display = "block";
      btn.textContent = "Recolher";
    } else {
      resumo.style.display = "block";
      completo.style.display = "none";
      btn.textContent = "Expandir";
    }
  }
</script>
</body>
</html>