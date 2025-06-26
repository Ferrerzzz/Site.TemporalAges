<?php include 'ligacaobd.php'; ?>
<?php $con = ligaBD(); ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $titulo = $_POST['titulo'];
  $descricao = $_POST['descricao'];
  $data = date('Y-m-d');

  if (!isset($_FILES['imagem']) || $_FILES['imagem']['error'] !== 0) {
    echo "<script>alert('É obrigatório selecionar uma imagem.'); window.history.back();</script>";
    exit;
  }

  $pasta_destino = "imagens/noticias/";
  if (!file_exists($pasta_destino)) {
    mkdir($pasta_destino, 0777, true);
  }

  $extensao = strtolower(pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));
  $permitidas = ['jpg', 'jpeg', 'png', 'gif'];

  if (!in_array($extensao, $permitidas)) {
    echo "<script>alert('A imagem deve ser JPG, JPEG, PNG ou GIF.'); window.history.back();</script>";
    exit;
  }

  $imagem_nome = uniqid("noticia_") . "." . $extensao;
  $caminho_final = $pasta_destino . $imagem_nome;

  if (!move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho_final)) {
    echo "<script>alert('Erro ao guardar a imagem.'); window.history.back();</script>";
    exit;
  }

  $stmt = $con->prepare("INSERT INTO noticias (titulo, descricao, data_publicacao, imagem) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("ssss", $titulo, $descricao, $data, $imagem_nome);
  $stmt->execute();
  $stmt->close();
  $con->close();

  header("Location: noticias.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="pt-PT">
<head>
  <meta charset="UTF-8">
  <title>Adicionar Notícia</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f4f6fa;
      margin: 0;
      padding: 40px;
    }

    form {
      background: white;
      max-width: 700px;
      margin: 0 auto;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
    }

    h1 {
      text-align: center;
      margin-bottom: 30px;
      color: #0a4ba1;
    }

    label {
      font-weight: 600;
      display: block;
      margin-bottom: 8px;
      color: #333;
    }

    input[type="text"],
    textarea,
    input[type="file"] {
      width: 100%;
      padding: 12px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 14px;
      background-color: #fafafa;
      box-sizing: border-box;
    }

    textarea {
      resize: vertical;
    }

    button {
      background-color: #0a4ba1;
      color: white;
      border: none;
      padding: 12px 24px;
      font-size: 16px;
      border-radius: 8px;
      cursor: pointer;
      width: 100%;
      transition: background-color 0.3s;
    }

    button:hover {
      background-color: #083e88;
    }

    a {
      display: block;
      margin-top: 20px;
      text-align: center;
      color: #0a4ba1;
      font-size: 14px;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }

  
  </style>
</head>
<body>

  <form method="POST" enctype="multipart/form-data">
    <h1>Adicionar Nova Notícia</h1>

    <label for="titulo">Título:</label>
    <input type="text" id="titulo" name="titulo" required>

    <label for="descricao">Descrição:</label>
    <textarea id="descricao" name="descricao" rows="6" required></textarea>

    <label for="imagem">Imagem</label>
    <input type="file" id="imagem" name="imagem" accept="image/*" required>

    <button type="submit">Publicar</button>
    <a href="index.html">← Voltar</a>
  </form>

</body>
</html>
