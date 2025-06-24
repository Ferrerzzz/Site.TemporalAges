<?php
include 'ligacaobd.php';
$con = ligaBD();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_post'])) {
  $id =$post['titulo'];
  $stmt = $con->prepare("DELETE FROM posts WHERE id = '$id'");
  $stmt->bind_param("i", $id);
  $stmt->execute();
}
?>

<!DOCTYPE html>
<html lang="pt-PT">
<head>
  <meta charset="UTF-8">
  <title>Eliminar Publicações</title>
  <style>
    table {
      width: 90%;
      margin: 30px auto;
      border-collapse: collapse;
    }
    th, td {
      border: 1px solid #ccc;
      padding: 12px;
      text-align: left;
    }
    th {
      background-color: #0a4ba1;
      color: white;
    }
    form {
      display: inline;
    }
    .btn-eliminar {
      background-color: red;
      color: white;
      padding: 6px 10px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    .btn-eliminar:hover {
      background-color: darkred;
    }
  </style>
</head>
<body>
  <h2 style="text-align: center;">Gestão de Publicações</h2>

  <table>
    <thead>
      <tr>
        <th>Título</th>
        <th>Mensagem</th>
        <th>Data</th>
        <th>Autor</th>
        <th>Ação</th>
      </tr>
    </thead>
    <tbody>
      <?php


      $query = $con->query("SELECT * FROM posts ORDER BY data_postagem DESC");
      while ($post = $query->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($post['titulo']) . "</td>";
        echo "<td>" . htmlspecialchars(substr($post['mensagem'], 0, 60)) . "...</td>";
        echo "<td>" . date('d/m/Y H:i', strtotime($post['data_postagem'])) . "</td>";
        echo "<td>" . htmlspecialchars($post['autor']) . "</td>";
        echo "<td>
                <form method='post' onsubmit=\"return confirm('Tem a certeza que deseja eliminar este post?');\">
                  <input type='hidden' name='id_post' value='{$post['id_post']}'>
                  <button type='submit' class='btn-eliminar'>Eliminar</button>
                </form>
              </td>";
        echo "</tr>";
      }
      ?>
    </tbody>
  </table>
</body>
</html>
