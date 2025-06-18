<?php include 'ligacaobd.php'; ?>
<?php $con = ligaBD(); ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $titulo = $_POST['titulo'];
  $descricao = $_POST['descricao'];
  $data = date('Y-m-d');

  // Verificar se foi enviada uma imagem
  if (!isset($_FILES['imagem']) || $_FILES['imagem']['error'] !== 0) {
    echo "<script>alert('É obrigatório selecionar uma imagem.'); window.history.back();</script>";
    exit;
  }

  // Diretório de destino
  $pasta_destino = "imagens/noticias/";
  if (!file_exists($pasta_destino)) {
    mkdir($pasta_destino, 0777, true);
  }

  // Processar a imagem
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

  // Inserir no BD
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
    body { font-family: Arial, sans-serif; padding: 20px; background: #f2f2f2; }
    form { background: white; padding: 20px; border-radius: 8px; max-width: 600px; margin: auto; }
    input, textarea { width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px; }
    button { padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; }
    button:hover { background: #0056b3; }
    a { display: block; margin-top: 15px; color: #007bff; text-align: center; }
  </style>
</head>
<body>

  <form method="POST" enctype="multipart/form-data">
    <h1>Adicionar Nova Notícia</h1>

    <label for="titulo">Título:</label>
    <input type="text" id="titulo" name="titulo" required>

    <label for="descricao">Descrição:</label>
    <textarea id="descricao" name="descricao" rows="6" required></textarea>

    <label for="imagem">Imagem (obrigatória):</label>
    <input type="file" id="imagem" name="imagem" accept="image/*" required>

    <button type="submit">Publicar</button>
    <a href="index.html">← Voltar </a>
  </form>

</body>
</html>
