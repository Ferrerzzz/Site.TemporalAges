<?php
require_once 'ligacaoBD.php';

$con=ligaBD();

if ($con==TRUE){
    $mail = $_POST['email'];
    $pass = $_POST['sass'];
   



    $query = $con->query ("select * from utilizadores where email = '$mail' and  pass='$pass' ;");

    
    
    
    $linhas=mysqli_num_rows($query);

    
    if ($linhas >0 || $linhas2>0 )
        {   

        session_start();
        $_SESSION["login"]=$mail;
        $_SESSION["start"]=time();
        $_SESSION['expirar'] = $_SESSION['start'] + (3600);

        $now=time();
         if ($now > $_SESSION['expirar']) {
        session_destroy();
        echo "<meta http-equiv=\"refresh\"content=\"0; url=index.html\">";

         }


        

        ?>
        <script>

        function finalizar() {
            const email = $mail
            const battletag = document.getElementById("battletag").value;

             const userData = {
             email,
            gameTag: battletag
  };




  localStorage.setItem("utilizadorLogado", JSON.stringify(userData));

  
  window.location.href = "index.html";
}
</script>

<?php






       
     }else{
        echo"<script>alert('Login Errado');</script>";
        echo "<meta http-equiv=\"refresh\"content=\"0; url=login.html\">";
    
   
}

}
$con->close();