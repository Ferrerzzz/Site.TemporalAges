<?php
include 'ligacaobd.php';
$con = ligaBD();
/* 
session_start();
if (!isset($_SESSION['utilizador']) || $_SESSION['utilizador']['tipo'] !== 'Admin') {
    exit('Acesso negado.');
} */

$id = intval($_GET['id']);
$res = $con->query("SELECT * FROM utilizadores WHERE id_utl = $id");
$user = $res->fetch_assoc();
?>

<h2>Editar Utilizador</h2>
<form method="post" action="processa_edicao_utilizador.php">
  <input type="hidden" name="id" value="<?= $user['id_utl'] ?>">

  <label>Email:</label><br>
  <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>"><br><br>

  <label>BattleTag:</label><br>
  <input type="text" name="battletag" value="<?= htmlspecialchars($user['battletag']) ?>"><br><br>

  <button type="submit">Guardar Alterações</button>
</form>
