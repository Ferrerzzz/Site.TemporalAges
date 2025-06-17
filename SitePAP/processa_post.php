<?php
include 'ligacaobd.php';
$con = ligaBD();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo'] ?? '');
    $mensagem = trim($_POST['mensagem'] ?? '');

    if (!empty($titulo) && !empty($mensagem)) {
        $stmt = $con->prepare("INSERT INTO posts (titulo, mensagem) VALUES (?, ?)");
        if ($stmt) {
            $stmt->bind_param("ss", $titulo, $mensagem);
            $stmt->execute();
            $stmt->close();
        } else {
            echo "Erro ao preparar a inserção.";
        }
    }
}

$con->close();
header("Location: forum.php");
exit;
?>