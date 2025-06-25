<?php
include 'ligacaobd.php';
$con = ligaBD();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (!empty($_POST['id'])) {
    $id = intval($_POST['id']);
    $stmt = $con->prepare("DELETE FROM posts WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

  
    header("Location: eliminar_post.php");
    exit();
  }
}
?>
<!DOCTYPE html>
<html lang="pt-PT">
<head>
  <meta charset="UTF-8">
  <title>Eliminar Publicações</title>
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
                  <input type='hidden' name='id' value='{$post['id']}'>
                  <button type='submit' class='btn-eliminar'>Eliminar</button>
                </form>
              </td>";
        echo "</tr>";
      }
      ?>
        
    </tbody>
  </table>
  <a class="back-link" href="index.html">← Voltar ao Início</a>
</body>
</html>
