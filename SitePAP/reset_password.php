<?php
$email = $_GET['email'] ?? '';
$token = $_GET['token'] ?? '';


if (empty($email) || empty($token)) {
    die("Link inválido.");
}
?>

<form action="atualizar_password.php" method="post">
  <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
  <label>Nova password:</label>
  <input type="password" name="nova_password" required>
  <button type="submit">Atualizar Password</button>
</form>
