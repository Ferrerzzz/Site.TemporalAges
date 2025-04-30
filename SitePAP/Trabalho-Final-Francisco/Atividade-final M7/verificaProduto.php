<?php

if (isset($_POST['produto']) && !empty($_POST['produto'])) {
    $produto = trim($_POST['produto']); 

    
    if ($produto == "Chuteiras Nike Air Rosa") {
        
        echo "<meta http-equiv=\"refresh\" content=\"0; url=produto1.html\">";
        exit; 
    } else if($produto == "Chuteira Nike Air bege"){
        echo "<meta http-equiv=\"refresh\" content=\"0; url=produto2.html\">";
        exit; 
    }else if($produto == "Chuteira Nike Air Azul e Roxo"){
        echo "<meta http-equiv=\"refresh\" content=\"0; url=produto3.html\">";
        exit; 
    }else if($produto == "Chuteira Nike Mercurial Gold"){
        echo "<meta http-equiv=\"refresh\" content=\"0; url=produto4.html\">";
        exit; 
    }else if ($produto == "Chuteira Nike CR7 Azul"){
        echo "<meta http-equiv=\"refresh\" content=\"0; url=produto5.html\">";
        exit; 
        
    }else if ($produto == " Chuteira Nike Mercurial Azul"){
        echo "<meta http-equiv=\"refresh\" content=\"0; url=produto6.html\">";
        exit; 
    }else if ($produto == "Chuteira Nike Air Branco"){
        echo "<meta http-equiv=\"refresh\" content=\"0; url=produto7.html\">";
        exit; 
    }else if ($produto == "Chuteira Nike Mercurial Laranja"){
        echo "<meta http-equiv=\"refresh\" content=\"0; url=produto8.html\">";
        exit; 
    }else {
        echo"<script>alert('Produto não encontrado');</script>";
        echo "<meta http-equiv=\"refresh\" content=\"0; url=index.html\">";
    }
} else {
   
    echo "<script>alert('Por favor, insira o nome do produto para pesquisar');</script>";
    echo "<meta http-equiv=\"refresh\" content=\"3; url=index.html\">";
}
?>