<?php
include 'ligacaobd.php';

date_default_timezone_set('Europe/Lisbon');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $mensagem = $_POST['mensagem'];
    $autor = $_POST['autor'];
    $data = date("Y-m-d H:i:s");

    $con = ligaBD();

    $stmt = $con->prepare("INSERT INTO posts (titulo, mensagem, autor, data_postagem) VALUES (?, ?, ?, ?)");
    if ($stmt === false) {
        die("Erro na preparação da query: " . $con->error);
    }

    $stmt->bind_param("ssss", $titulo, $mensagem, $autor, $data);

    if ($stmt->execute()) {
        header("Location: forum.php");
        exit;
    } else {
        echo "Erro ao publicar: " . $stmt->error;
    }

    $stmt->close();
    $con->close();
} else {
    echo "Método inválido.";
}
?>
