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
        echo "Password atualizada com sucesso.";
    } else {
        echo "Erro ao atualizar a password.";
    }
} else {
    echo "Dados incompletos.";
}
?>
