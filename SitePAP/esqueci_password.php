<!DOCTYPE html>
<html lang="pt-PT">
<head>
  <meta charset="UTF-8">
  <title>Recuperar Password</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f3f3f3;
      margin: 0;
      padding: 0;
    }

    .container {
      width: 400px;
      margin: 100px auto;
      background-color: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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

    input[type="email"] {
      width: 100%;
      padding: 10px;
      margin-top: 8px;
      border: 1px solid #ccc;
      border-radius: 5px;
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
  <div class="container">
    <h2>Recuperar Password</h2>
    <form action="enviar_email_reset.php" method="post">
      <label>Email:</label>
      <input type="email" name="email" required>
      <button type="submit">Enviar link</button>
    </form>
  </div>
  <a class="back-link" href="index.html">← Voltar</a>
</body>
</html>
