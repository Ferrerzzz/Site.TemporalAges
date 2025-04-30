<?php 
$servername="localhost";
$username="root";
$password="";//campo a ser mudado consoante a password da base de dados.
$dbname="finalm7";



//cria a conexão
$con = new mysqli($servername,$username,$password,$dbname);
//verifica a conexão 
date_default_timezone_set("Europe/Lisbon");



if ($con==TRUE){
    

        
        $stm=$con->prepare("INSERT INTO produto (nome_prd,tamanho,preço,qtd,tipo_relv) values (?,?,?,?,?)");

        $stm->bind_param("sssss",$_POST["nome"],$_POST["tmh"],$_POST["preco"],$_POST["qtd"],$_POST["tpr"]);

        if ($stm->execute()){
            echo"<script>alert('Registo efetuado com sucesso');</script>";
            echo "<meta http-equiv=\"refresh\"content=\"0; url=index.html\">";

        }else{
            echo"<script>alert('ocurreu um erro');</script>"; 
        }
        

          
}

$con->close();


?>

