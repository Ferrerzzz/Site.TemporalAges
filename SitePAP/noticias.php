<?php include 'ligacaobd.php'; ?>
<?php $con = ligaBD(); ?>

<!DOCTYPE html>
<html lang="pt-PT">
<head>
  <meta charset="UTF-8">
  <title>Notícias</title>
  <link rel="stylesheet" href="css/forum.css">
  <link rel="stylesheet" href="css/noticias.css">
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
             <a href="TemporalAges.rar" download>
      <button class="btn-jogue-agora">JOGAR AGORA</button>
      </a>
      </div>
    </div>
  </div>


<section class="section light-section">
        <br>
        <br>
        <br>
        <br>
<div class="title-section">NOTÍCIAS</div>
<div class="news-grid">

  <div class="grid-item">
    <img src="imagens/gajo1-removebg-preview.png" alt="Melhoramentos">
    <div class="grid-content">
      <h3>RETROSPECTIVA SEMANAL: Melhoramentos no Dungeon 2D</h3>
      <p>13 de jun.</p>
    </div>
  </div>

  <div class="grid-item">
    <img src="imagens/BossRoomEg.png" alt="Mapa Egipto">
    <div class="grid-content">
      <h3>Nova Dungeon:Antigo Egito</h3>
      <p>6 de jun.</p>
    </div>
  </div>

  <div class="grid-item">
    <img src="imagens/BossRoom.png" alt="Mapa Grécia">
    <div class="grid-content">
      <h3>Novas Mecânicas: Desafios Mitológicos da Grécia</h3>
      <p>30 de mai.</p>
    </div>
  </div>

  <div class="grid-item">
    <img src="imagens/anubis-removebg-preview.png" alt="Comunidade">
    <div class="grid-content">
      <h3>Caras novas no antigo egito</h3>
      <p>29 de mai.</p>
    </div>
  </div>
</div>

</div>

</section>


<section class="section blue-section">
  <div class="news-block">
    <?php
      $result = $con->query("SELECT * FROM noticias ORDER BY data_publicacao DESC");

      while ($noticia = $result->fetch_assoc()) {
        echo '<div class="news-item">';
        echo '<img src="imagens/noticias/' . htmlspecialchars($noticia['imagem']) . '" alt="' . htmlspecialchars($noticia['titulo']) . '">';
        echo '<div class="news-text">';
        echo '<h2>' . htmlspecialchars($noticia['titulo']) . '</h2>';
        echo '<p>' . htmlspecialchars($noticia['descricao']) . '</p>';
        echo '<p class="date">' . date('d \d\e F \d\e Y', strtotime($noticia['data_publicacao'])) . '</p>';
        echo '</div></div>';
        echo '<div style="height: 2px; background-color: white; margin: 16px 0;"></div>';
      }

      $con->close();
    ?>
  </div>
</section>
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
                  <li><a href="editar_utilizador.php">Conta</a></li>
                  <li><a href="esqueci_password.php">Recuperar Palavra-Passe</a></li>
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
</body>
</html>
