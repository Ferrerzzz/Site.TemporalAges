<?php include 'ligacaobd.php'; ?>
<?php $con = ligaBD(); ?>

<?php

  session_start();
  $isAdmin = false;

  echo "<script>
    const dados = localStorage.getItem('utilizadorLogado');
    if (!dados || JSON.parse(dados).gameTag.toLowerCase() !== 'admin') {
      alert('Acesso restrito ao administrador.');
      window.location.href = 'noticias.php';
    }
  </script>";
?>

<!DOCTYPE html>
<html lang="pt-PT">
<head>
  <meta charset="UTF-8">
  <title>Gerir Notícias - Admin</title>
  <link rel="stylesheet" href="css/noticias.css">
  <style>
    .delete-btn {
      background-color: #ff4d4d;
      color: white;
      border: none;
      padding: 8px 12px;
      border-radius: 6px;
      cursor: pointer;
      font-weight: bold;
      margin-top: 10px;
    }

    .delete-btn:hover {
      background-color: #e60000;
    }


    .navbar-container {
  padding: 25px;
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  z-index: 10;
}
.navbar {
  display: flex;
  align-items: center;
  justify-content: space-between;
  background: #ffffff;
  box-shadow: 0 2px 5px rgba(0,0,0,0.2);
  color: #000;
  border-radius: 12px;
  height: 70px; 
  padding: 0 60px; 

  }

.nav-link {
  text-decoration: none;
  color: black;
  font-weight: bold;
  cursor: pointer;
  transition: background-color 0.3s ease;
  padding: 5px 12px;
  border-radius: 5px;
  font-size: 1.18em; 
}

.nav-right {
  display: flex;
  align-items: center;
  gap: 20px;
}

.nav-left {
  display: flex;
  align-items: center;
  gap: 40px;

}
.dropdown {
  position: relative;
}
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #fff;
  min-width: 150px;
  box-shadow: 0px 8px 16px rgba(0,0,0,0.2);
  z-index: 1;
  border-radius: 5px;
  overflow: hidden;
}
.dropdown:hover .dropdown-content {
  display: block;
}
.dropdown-content a {
    color: black;
    padding: 12px 18px;
    text-decoration: none;
    display: block;
    font-size: 1em; 
  }
.dropdown-content a:hover {
  background-color: #ddd;
}
.nav-link {
  text-decoration: none;
  color: black;
  font-weight: bold;
  cursor: pointer;
}

.nav-link:hover {
    background-color: #dcdde1; 
  }

.dropdown .nav-link::after {
    content: " ▼";
    font-size: 0.7em;
    margin-left: 6px;
    color: #333;
  }
.search-icon, .user-icon {
  font-size: 18px;
  cursor: pointer;
}
.btn-jogue {
  background-color: #0044ff;
  color: white;
  padding: 8px 15px;
  border: none;
  border-radius: 8px;
  font-weight: bold;
  font-size: 1.12em;
}

footer {

  background-color: #202020; 
  color: white; 
  padding: 20px 0; 
  text-align: left; 
}

.footer-container {
  display: flex; 
  justify-content: space-around;
  flex-wrap: wrap; 
  max-width: 1200px;
  margin: 0 auto; 
  padding: 20px; 
}

.footer-section {
  flex: 1; 
  min-width: 200px; 
  margin: 10px; 
}

.footer-section h3 {
  border-bottom: 2px solid #f39c12;
  padding-bottom: 10px; 
}

.footer-section a {
  color: #f39c12; 
  text-decoration: none; 
}

.footer-section a:hover {
  text-decoration: underline; 
}

.footer-bottom {
  text-align: center; 
  margin-top: 20px;
}




  </style>
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


<section class="section light-section">
    <br>
    <br>
    <br>
    <br>

  <div class="title-section">Eliminar Notícias</div>
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
        echo '<form action="remover_noticia.php" method="POST" onsubmit="return confirm(\'Tens a certeza que queres eliminar esta notícia?\')">';
        echo '<input type="hidden" name="id" value="' . $noticia['id'] . '">';
        echo '<button class="delete-btn" type="submit">Eliminar</button>';
        echo '</form>';
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
</body>
</html>
