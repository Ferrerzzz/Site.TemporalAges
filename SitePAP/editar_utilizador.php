<?php
include 'ligacaobd.php';
$con = ligaBD();


$tag = isset($_GET['tag']) ? $_GET['tag'] : null;
$id = isset($_GET['id_utl']) ? $_GET['id_utl'] : null;

if ($tag !== null) {
    $stmt = $con->prepare("SELECT * FROM utilizadores WHERE email = ?");
    $stmt->bind_param("s", $tag);
} elseif ($id !== null) {
    $stmt = $con->prepare("SELECT * FROM utilizadores WHERE id_utl = ?");
    $stmt->bind_param("i", $id);
} else {
    die("Parâmetro de utilizador inválido.");
    
}

$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    die("Utilizador não encontrado.");
}
?>
<!DOCTYPE html>
<html lang="pt-PT">
<head>
  <meta charset="UTF-8">
  <title>Editar Utilizador</title>
  <style>
    body {
      background-color: #f4f6fa;
      font-family: 'Segoe UI', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .form-container {
      background: white;
      padding: 40px 30px;
      border-radius: 12px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      max-width: 400px;
      width: 100%;
    }

    .form-container h2 {
      text-align: center;
      margin-bottom: 30px;
      font-size: 24px;
      color: #0a4ba1;
    }

    label {
      display: block;
      font-weight: 600;
      margin-bottom: 8px;
      color: #333;
    }

    input[type="email"],
    input[type="text"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 14px;
    }

    button {
      width: 100%;
      padding: 12px;
      background-color: #0a4ba1;
      color: white;
      font-weight: bold;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    button:hover {
      background-color: #083a7b;
    }

    .back-link {
      display: block;
      text-align: center;
      margin-top: 20px;
      color: #0a4ba1;
      text-decoration: none;
      font-size: 14px;
    }

    .back-link:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <div class="form-container">
    <h2>Editar Utilizador</h2>
    <form method="post" action="processa_edicao_utilizador.php">
      <input type="hidden" name="id" value="<?= $user['id_utl'] ?>">

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>

      <label for="battletag">BattleTag:</label>
      <input type="text" id="battletag" name="battletag" value="<?= htmlspecialchars($user['battletag']) ?>" required>

      <button type="submit">Guardar Alterações</button>
    </form>
<?php 
if ($tag =="admin"){
  ?>
  <a class="back-link" href="listagem_utilizadores.php">← Voltar à listagem</a>
  <?php
}else{
  ?>
   <a class="back-link" href="index.html">← Voltar</a>
   <?php
   }
   ?>
  </div>

</body>
</html>
