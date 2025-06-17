<?php 
function ligaBD(){
    $con = new mysqli("localhost","root","","pap");

    if($con->connect_error!=0){
        echo "Ocorreu um erro no acesso à base de dados".$con->connect_error;
        exit;
    }
    return $con;
}
?>