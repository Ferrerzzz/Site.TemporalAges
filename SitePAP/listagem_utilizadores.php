<?php include 'ligacaobd.php'; ?>
<?php $con = ligaBD(); ?>

<!DOCTYPE html>
<html lang="pt-PT">
<head>
  <meta charset="UTF-8">
  <title>Listagem de Utilizadores</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f4f6fa;
      margin: 0;
      padding: 40px;
    }

    h1 {
      text-align: center;
      color: #0a4ba1;
      margin-bottom: 30px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: white;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
      overflow: hidden;
    }

    th, td {
      padding: 14px 16px;
      border-bottom: 1px solid #ddd;
      text-align: left;
      font-size: 14px;
    }

    th {
      background-color: #0a4ba1;
      color: white;
      font-weight: 600;
    }

    tr:hover {
      background-color: #f1f1f1;
    }

    .actions a {
      margin-right: 10px;
      color: #0a4ba1;
      font-weight: bold;
      text-decoration: none;
      transition: color 0.3s;
    }

    .actions a:hover {
      color: #063577;
      text-decoration: underline;
    }

    .back-link {
      display: block;
      margin-top: 20px;
      text-align: center;
      font-size: 14px;
      color: #0a4ba1;
      text-decoration: none;
    }

    .back-link:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <h1>Listagem de Utilizadores</h1>

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>BattleTag</th>
        <th>Email</th>
        <th>Data de Nascimento</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $sql = "SELECT id_utl, battletag, email, data_nasc FROM utilizadores ORDER BY id_utl ASC";
        $res = $con->query($sql);

        while ($user = $res->fetch_assoc()) {
          echo "<tr>
                  <td>{$user['id_utl']}</td>
                  <td>" . htmlspecialchars($user['battletag']) . "</td>
                  <td>" . htmlspecialchars($user['email']) . "</td>
                  <td>" . date('d/m/Y', strtotime($user['data_nasc'])) . "</td>
                  <td class='actions'>
                    <a href='editar_utilizador.php?id={$user['id_utl']}'>Editar</a>
                    <a href='eliminar_utilizador.php?id={$user['id_utl']}' onclick=\"return confirm('Tens a certeza que queres eliminar este utilizador?')\">Eliminar</a>
                  </td>
                </tr>";
        }

        $con->close();
      ?>
    </tbody>
  </table>

  <a class="back-link" href="index.html">← Voltar ao Início</a>

</body>
</html>
