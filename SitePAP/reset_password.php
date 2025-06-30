<?php
$email = $_GET['email'] ?? '';
$token = $_GET['token'] ?? '';

if (empty($email) || empty($token)) {
    die("Link inválido.");
}
?>

<!DOCTYPE html>
<html lang="pt-PT">
<head>
  <meta charset="UTF-8">
  <title>Redefinir Password</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f3f3f3;
      margin: 0;
      padding: 0;
    }

    .container {
      width: 400px;
      margin: 80px auto;
      background-color: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
      color: #0a4ba1;
    }

    label {
      display: block;
      margin-top: 20px;
      color: #333;
    }

    input[type="password"],
    input[type="hidden"] {
      width: 100%;
      padding: 10px;
      margin-top: 8px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .error {
      color: red;
      font-size: 14px;
      display: none;
      margin-top: 5px;
    }

    button {
      margin-top: 20px;
      width: 100%;
      padding: 10px;
      background-color: #0a4ba1;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    button:hover {
      background-color: #083b81;
    }
  </style>
  <script>
    function validarPasswords(event) {
      const pass1 = document.getElementById('nova_password').value;
      const pass2 = document.getElementById('confirmar_password').value;
      const erro = document.getElementById('erro');

      if (pass1 !== pass2) {
        erro.style.display = 'block';
        event.preventDefault();
      } else {
        erro.style.display = 'none';
      }
    }
  </script>
</head>
<body>
  <div class="container">
    <h2>Redefinir Password</h2>
    <form action="atualizar_password.php" method="post" onsubmit="validarPasswords(event)">
      <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">

      <label>Nova password:</label>
      <input type="password" id="nova_password" name="nova_password" required>

      <label>Repetir nova password:</label>
      <input type="password" id="confirmar_password" required>

      <div id="erro" class="error">As passwords não coincidem.</div>

      <button type="submit">Atualizar Password</button>
    </form>
  </div>
</body>
</html>
