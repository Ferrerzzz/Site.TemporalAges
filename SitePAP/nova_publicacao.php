<?php include 'ligacaobd.php'; ?>
<?php $con = ligaBD(); ?>

<!DOCTYPE html>
<html lang="pt-PT">
<head>
  <meta charset="UTF-8">
  <title>Nova Publicação</title>
  <style>
    body {
      background-color: #111;
      color: #fff;
      font-family: Arial, sans-serif;
    }

    .container {
      max-width: 700px;
      margin: 50px auto;
      background-color: #1e1e1e;
      padding: 30px;
      border-radius: 10px;
      border: 1px solid #333;
    }

    h2 {
      margin-bottom: 20px;
    }

    input, textarea {
      width: 100%;
      padding: 12px;
      margin-bottom: 20px;
      background-color: #2c2c2c;
      border: none;
      color: #fff;
      border-radius: 6px;
    }

    button {
      padding: 12px 24px;
      background-color: #f4c430;
      color: #000;
      border: none;
      font-weight: bold;
      cursor: pointer;
      border-radius: 6px;
    }

    a.voltar {
      display: inline-block;
      margin-top: 20px;
      color: #f4c430;
      text-decoration: none;
    }
  </style>
</head>
<body>
   <h1>Nova Publicação</h1>

<form action="processa_post.php" method="post">
  <label for="titulo">Título:</label><br>
  <input type="text" id="titulo" name="titulo" required><br><br>

  <label for="mensagem">Mensagem:</label><br>
  <textarea id="mensagem" name="mensagem" rows="6" required></textarea><br><br>

  <input type="hidden" id="autor" name="autor">

  <button type="submit">Publicar</button>
</form>

<a href="forum.php">← Voltar ao Fórum</a>


<script>
  document.addEventListener("DOMContentLoaded", () => {
    const userData = localStorage.getItem("utilizadorLogado");

    if (!userData) {
      alert("Tens de iniciar sessão para adicionar uma publicação.");
      window.location.href = "login.html";
    } else {
      const user = JSON.parse(userData);
      const autorInput = document.getElementById("autor");

      if (autorInput) {
        autorInput.value = user.gameTag;
      }
    }
  });
</script>

</body>
</html>