<?php
include 'ligacaobd.php';
$con = ligaBD();

/* session_start();
if (!isset($_SESSION['utilizador']) || $_SESSION['utilizador']['tipo'] !== 'admin') {
    exit('Acesso negado.');
} */

$id = intval($_GET['id']);

$con->query("DELETE FROM utilizadores WHERE id_utl = $id");

header("Location: listagem_utilizadores.php");
