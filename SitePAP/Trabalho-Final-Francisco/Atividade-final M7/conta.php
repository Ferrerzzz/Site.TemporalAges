<?php

require_once 'ligacaoBD.php';
//require_once 'testaSessao.php';
$con=ligaBD();
session_start();
if(isset ($_SESSION["login"])){

    $_SESSION["start"]=time();
    $_SESSION['expirar'] = $_SESSION['start'] + (3600);

    $now=time();
     if ($now > $_SESSION['expirar']) {
    session_destroy();
    echo "<meta http-equiv=\"refresh\"content=\"0; url=index.html\">";
    
     }

$mail =$_SESSION["login"];
if ($con==TRUE){
$query = $con->query ("select * from utilizadores");
$linhas=mysqli_num_rows($query);
if ($linhas >0)
{

    ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos-lgn.css">
    <title>login</title>
</head>
<body>

    <div id="inicio">
        <p>Bem-vindo ao meu projeto final do M7 <?php echo $_SESSION["login"]?></p>
    </div>

    <div id="nav">
        <nav>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="login.html">Login</a></li>
            <li><a href="registo.html">Registo</a></li>
            <li><a href="image.php">Adicionar-imagem</a></li>
            <li><a href="pesquisar.html">Pesquisar</a></li>
            <li><a href="lista.php">Lista</a></li>
            <li><a href="conta.php">Conta</a></li>
           
           
  
            </ul>
        </nav>
    </div>

    <?php 
    if ($_SESSION["login"]=="admin@mail.pt"||$_SESSION["login"]=="admin"){
        $query = $con->query ("select * from utilizadores"); //adicionar apagar e editar
        ?>

        
    <div class="product-detail">
    
    
    <div class="product-info">


        <?php
        echo"<table border=\"2\">";
    echo '<tr><th bgcolor="#aac1e1">Nome De utilizador</th><th bgcolor="#aac1e1">Email</th><th bgcolor="#aac1e1">Password</th><th bgcolor="#aac1e1">Data de Nascimento</th><th bgcolor="#aac1e1">Editar</th>';
    
    while($resultados = $query->fetch_assoc()){
        echo '<tr>';
        echo "<td>".$resultados['nome_utl']."</td>
              <td>".$resultados['email']."</td>
              <td>".$resultados['pass']."</td>
              <td>".$resultados['data_nasc']."</td>
              <td><a href='alterar-user.php?id=".$resultados['id_utl']."'><img src='../Atividade-final M7/Imgs/lapis.jpg' height='20px' ></a></td>";
              
              
        echo '</tr>';
        //meter paginação
    }
        
    echo "</table>";



}else{
    $query = $con->query ("select * from utilizadores where email='$mail'");
?>
    <div class="product-detail">
    
    
    <div class="product-info">

        <?php
        echo"<table border=\"2\">";
    echo '<tr><th bgcolor="#aac1e1">Nome De utilizador</th><th bgcolor="#aac1e1">Email</th><th bgcolor="#aac1e1">Password</th><th bgcolor="#aac1e1">Data de Nascimento</th><th bgcolor="#aac1e1">Editar</th>';
    
    while($resultados = $query->fetch_assoc()){
        echo '<tr>';
        echo "<td>".$resultados['nome_utl']."</td>
              <td>".$resultados['email']."</td>
              <td>".$resultados['pass']."</td>
              <td>".$resultados['data_nasc']."</td>;
              <td><a href='alterar-user.php?id=".$resultados['id_utl']."'><img src='../Atividade-final M7/Imgs/lapis.jpg' height='20px' ></a></td>";
    
        //meter paginação
    }
        
    echo "</table>";


}
 
        ?>

       
        
    </div>
</div>


    <footer id="#sobre">
        <div class="footer-container">
            <div class="footer-section">
                <h3>Sobre Nós</h3>
                <p>Trabalho Final M7 Francisco Ferreira.</p>
                
            </div>
            
            <div class="footer-section">
                <h3>Ajuda</h3>
                <ul>
                    <li><a href="login.html">Login</a></li>
                    <li><a href="registo.php">Registo</a></li>
                    <li><a href="conta.php">Conta</a></li>
                    <li><a href="">Recuperar Palavra-Passe</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Redes Sociais</h3>
                <a href="#" >Facebook</a><br>
                <a href="#" >Instagram</a><br>
                <a href="#" >Twitter</a><br>
                <a href="#" >LinkedIn</a>
            </div>
    
            <div class="footer-section">
                <h3>Contate-nos</h3>
                <p>Email: francisco.ferreira27674@al.aememmartins.pt</p>
                <p>Telefone: 21 922 9500</p>
                <p>Endereço: R. São Francisco Xavier 87</p>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; 2024. Todos os direitos reservados Francisco Ferreira.</p>
        </div>
    </footer>



</body>
<?php

  
}else
    echo"\nA tabela está vazia";

    
}
$con->close();

}else{
        echo"<script>alert('Login não efetuado);</script>";
        echo "<meta http-equiv=\"refresh\"content=\"0; url=login.html\">";
}

session_destroy();
 
?>
<script type="text/javascript">
    function checkdelete(){
        return confirm('Tem a certeza que pertende apagar o registo?');
            }
</script>