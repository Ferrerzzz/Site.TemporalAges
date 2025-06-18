<?php include 'ligacaobd.php'; ?>
<?php $con = ligaBD(); ?>

<!DOCTYPE html>
<html lang="pt-PT">
<head>
  <meta charset="UTF-8">
  <title>Listagem de Utilizadores</title>
  <style>
    body { font-family: Arial, sans-serif; padding: 20px; background: #f5f5f5; }
    table { width: 100%; border-collapse: collapse; background: white; }
    th, td { padding: 10px; border: 1px solid #ccc; text-align: left; }
    h1 { margin-bottom: 20px; }
    a { text-decoration: none; color: #007bff; }
  </style>
</head>
<body>

  <h1>Listagem de Utilizadores</h1>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Battletag</th>
        <th>Email</th>
        <th>Data de Nascimento</th>
        <th>Editar | Eliminar</th>
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
          <td>
            <a href='editar_utilizador.php?id={$user['id_utl']}'>Editar</a> |
            <a href='eliminar_utilizador.php?id={$user['id_utl']}' onclick=\"return confirm('Tens a certeza que queres eliminar este utilizador?')\">Eliminar</a>
          </td>
        </tr>";
        }

        $con->close();
      ?>
    </tbody>
  </table>

  <br>
  <a href="index.html">← Voltar</a>

</body>
</html>