<?php

$conexao = mysqli_connect("localhost","root","","finalm7");

//mysqli_set_charset($conexao, 'utf-8');

if ($conexao->connect_error){

    die ("Falha ao efectuar a ligação:" .$conexao->connect_error);

}

$id = filter_input(INPUT_GET, 'id' ,FILTER_SANITIZE_SPECIAL_CHARS);
$queryApagar = $conexao->query("DELETE FROM imagens WHERE id_img='$id'" );

if(mysqli_affected_rows($conexao) > 0){
    header("Location:lista.php");
}
?>