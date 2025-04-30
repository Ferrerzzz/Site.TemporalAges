<?php 
$servername="localhost";
$username="root";
$password="";//campo a ser mudado consoante a password da base de dados.
$dbname="finalm7";



//cria a conexão
$con = new mysqli($servername,$username,$password,$dbname);
//verifica a conexão 
date_default_timezone_set("Europe/Lisbon");

$passe=password_hash($_POST['pass'], PASSWORD_DEFAULT);

if ($con==TRUE){
    $nome = $_POST['nome'];
    
    $query = $con->query ("select * from utilizadores where nome_utl = '$nome';");
    
    $linhas=mysqli_num_rows($query);
    
    if ($linhas >0)
        {
        echo"<script>alert('Este Nome já se encontra registado na base de dados');</script>";
        echo "<meta http-equiv=\"refresh\"content=\"2; url=registo.php\">";

       
     }else{
      
        $stm=$con->prepare("INSERT INTO utilizadores (nome_utl,email,pass,data_nasc) values (?,?,?,?)");

        $stm->bind_param("ssss",$_POST["nome"],$_POST["email"],$passe,$_POST["datanasc"]);

        if ($stm->execute()){
            echo"<script>alert('Registo efetuado com sucesso');</script>";
            echo "<meta http-equiv=\"refresh\"content=\"0; url=index.html\">";

        }else{
            echo"<script>alert('ocurreu um erro');</script>"; 
        }
        
        
       
        
        }
        

          
}

$con->close();


?>

