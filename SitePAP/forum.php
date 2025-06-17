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
        dropdown.innerHTML = `
          <span class="nav-link">${user.gameTag}</span>
          <div class="dropdown-content">
            <div style="padding: 12px 18px; font-weight: bold;">
              ${user.gameTag}<br>
              <span style="font-size: 0.85em; font-weight: normal;">${user.email}</span>
            </div>
            <a href="#" onclick="logout()">Terminar Sessão</a>
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
            <a href="#">Visão geral</a>
            <a href="comoJogar.html">Como jogar</a>
          </div>
        </div>

        <a class="nav-link" href="personagens.html">Personagens</a>
        <a class="nav-link" href="#">Mapas</a>
        <a class="nav-link" href="noticias.html">Notícias</a>

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


  <header>
    <h1>Fórum Dungeon 2D: Temporal Ages</h1>
  </header>

  <main>
    <table>
      <thead>
        <tr>
          <th>Título</th>
          <th>Mensagem</th>
          <th>Data</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $query = $con->query("SELECT * FROM posts ORDER BY data_postagem DESC");

          while ($post = $query->fetch_assoc()) {
              echo '<tr>';
              echo "<td>" . htmlspecialchars($post['titulo']) . "</td>";
              echo "<td>" . nl2br(htmlspecialchars($post['mensagem'])) . "</td>";
              echo "<td>" . date('d/m/Y H:i', strtotime($post['data_postagem'])) . "</td>";
              echo '</tr>';
          }

          $con->close();
        ?>
      </tbody>
    </table>

    <form action="processa_post.php" method="post">
      <h2>Novo Tópico</h2>
      <input type="text" name="titulo" placeholder="Título" required>
      <textarea name="mensagem" rows="5" placeholder="Escreve aqui a tua mensagem..." required></textarea>
      <button type="submit">Publicar</button>
    </form>
  </main>

</body>
</html>