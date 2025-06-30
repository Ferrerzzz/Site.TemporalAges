<?php
include 'ligacaobd.php';
$con = ligaBD();

if (!empty($_POST['email']) && !empty($_POST['nova_password'])) {
    $email = $_POST['email'];
    $nova_password = password_hash($_POST['nova_password'], PASSWORD_DEFAULT);

    $stmt = $con->prepare("UPDATE utilizadores SET pass = ? WHERE email = ?");
    $stmt->bind_param("ss", $nova_password, $email);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
    echo "<script>alert('Password atualizada com sucesso.');</script>";
    echo "<meta http-equiv=\"refresh\" content=\"5; url=index.html\">";
    } else {
        echo "<script>alert('Erro ao atualizar a password.');</script>";
        echo "<meta http-equiv=\"refresh\" content=\"5; url=index.html\">";
    }
} else {
    echo "<script>alert('Dados incompletos.');</script>";
   
}
?>
