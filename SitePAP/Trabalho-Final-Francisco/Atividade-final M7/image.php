<?php
require_once __DIR__ . '/db.php';
if (count($_FILES) > 0) {
    if (is_uploaded_file($_FILES['userImage']['tmp_name'])) {
        $imgData = file_get_contents($_FILES['userImage']['tmp_name']);
        $imgType = $_FILES['userImage']['type'];
        $sql = "INSERT INTO imagens(imageType ,imageData) VALUES(?, ?)";
        $statement = $conn->prepare($sql);
        $statement->bind_param('ss', $imgType, $imgData);
        $current_id = $statement->execute() or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_connect_error());
        echo"<script>alert('imagem Inserida com sucesso');</script>";
        echo "<meta http-equiv=\"refresh\"content=\"0; url=index.html\">";
    }
}
?>
<HTML>
<HEAD>

</HEAD>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos-lgn.css">
    <title>login</title>
</head>
<body>

    <div id="inicio">
        <p>Bem-vindo ao meu projeto final do M7</p>
    </div>

    <div id="nav">
        <nav>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="login.html">Login</a></li>
            <li><a href="registo.php">Registo</a></li>
            <li><a href="image.php">Adicionar-imagem</a></li>
            <li><a href="pesquisar.html">Pesquisar</a></li>
            <li><a href="lista.php">Lista</a></li>
            <li><a href="conta.php">Conta</a></li>
           
           
  
            </ul>
        </nav>
    </div>

    <div class="product-detail">
    
    
    <div class="product-info">
    <form name="frmImage" enctype="multipart/form-data" action=""
        method="post">
            <label>Adicionar Imagem:</label>
            <br>
            <br>
                <input name="userImage" type="file" class="full-width" />
       
            <br>
                <a class="btn-comprar"><button id="btn-comprar" type="submit">Inserir imagem</button></a>

                
            </div>
        </div>
        
    </form>
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
</html>