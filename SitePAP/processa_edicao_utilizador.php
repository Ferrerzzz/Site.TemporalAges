<?php
include 'ligacaobd.php';
$con = ligaBD();

/* session_start();
if (!isset($_SESSION['utilizador']) || $_SESSION['utilizador']['tipo'] !== 'admin') {
    exit('Acesso negado.');
} */

$id = intval($_POST['id']);
$email = $con->real_escape_string($_POST['email']);
$battletag = $con->real_escape_string($_POST['battletag']);

$con->query("UPDATE utilizadores SET email = '$email', battletag = '$battletag' WHERE id_utl = $id");

header("Location: listagem_utilizadores.php");
