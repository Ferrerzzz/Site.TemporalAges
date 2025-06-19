<?php
include 'ligacaobd.php';
$con = ligaBD();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"])) {
  $id = intval($_POST["id"]);

  // Apagar a imagem se necessário (opcional)
  $res = $con->query("SELECT imagem FROM noticias WHERE id = $id");
  if ($row = $res->fetch_assoc()) {
    $imagem = $row["imagem"];
    if ($imagem && file_exists("imagens/noticias/" . $imagem)) {
      unlink("imagens/noticias/" . $imagem);
    }
  }

  $con->query("DELETE FROM noticias WHERE id = $id");
}

$con->close();
header("Location: eliminar_noticias.php");
exit();
