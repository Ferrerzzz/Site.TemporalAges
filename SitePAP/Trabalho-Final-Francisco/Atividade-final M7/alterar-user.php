<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos-lgn.css">
    <title>Document</title>
</head>
<body>

<?php
require_once 'ligacaoBD.php';
//require_once 'testaSessao.php';

if(isset($_GET['id'])){
    $operacao="update";
    $con=ligaBD();
    $stm= $con->prepare ("select * from utilizadores where id_utl = ?");
    $stm->bind_param("i",$_GET["id"]);
    $stm->execute();
    $res=$stm->get_result();
    $resultados =$res->fetch_assoc();
    $con->close();
}else
$operacao="insert";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    require("validacao.php");
$validacao= validarFormulario();
}
?>

<form action="<?php ($operacao=="update")? $_SERVER["PHP_SELF"]."?id=".$_GET["id"]: $_SERVER["PHP_SELF"];?>"method="post">

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
<table>
    <tr>
        <td>Nome de Utilizador *<?php
            if($_POST && in_array("nome_utl",$validacao))
                echo"<span class=\"erro\">(Preenchimento obrigatorio)</span>";
        ?></td>

        <td>
            <input name="nome_utl" type="text" size="45" maxlength="8" required pattern="^\S+$" title="O username não pode conter espaços." value="<?php
            if($_POST){
                if(!empty($_POST["nome_utl"]))
                    echo $_POST["nome_utl"];
            }else if($operacao=="update")
            echo $resultados["nome_utl"];
            ?>" /></td>
        
    </tr>
    <tr>
            <td>Email *<?php
            if($_POST && in_array("email",$validacao))
            echo "<span class=\"erro\">(Preenchimento obrigatório</span>";?></td>

<td>
            <input name="email" type="text" size="45" maxlength="40" required pattern="[a-z0-9._-]+@[a-z0-9.-]+\.[a-z]{2,}$" value="<?php
            if($_POST){
                if(!empty($_POST["email"]))
                    echo $_POST["email"];
            }else if($operacao=="update")
            echo $resultados["email"];
            ?>" /></td>


    </tr>

    <tr>
        <td>Palavra Passe*<?php
            if($_POST && in_array("pass",$validacao))
                echo"<span class=\"erro\">(Preenchimento obrigatorio)</span>";
        ?></td>

        <td>
            <input name="pass" type="text" size="45" minlength="7" required pattern="^\S+$" title="A palavra-passe não pode conter espaços." value="<?php
            if($_POST){
                if(!empty($_POST["pass"]))
                    echo $_POST["pass"];
            }else if($operacao=="update")
            echo $resultados["pass"];
            ?>" /></td>
        
    </tr>

    <tr>
        <td>Data de Nascimento*<?php
            if($_POST && in_array("data_nasc",$validacao))
                echo"<span class=\"erro\">(Preenchimento obrigatorio)</span>";
        ?></td>

        <td>
            <input name="data_nasc" type="date" size="30" onkeypress="return SomenteNumero(event);"value="<?php
            if($_POST){
                if(!empty($_POST["data_nasc"]))
                    echo $_POST["data_nasc"];
            }else if($operacao=="update")
                echo $resultados["data_nasc"];
            ?>" /></td>
        
    </tr>


    <tr>
        <td><p><input name="Adicionar" type="submit" value="Adicionar/Alterar"/></p></td>
    </tr>

    <p><b>* Campos Obrigatorios</b></p>

    <p><a href="conta.php">Voltar à lista</a></p>
    </form>

        </div>
    </div>

    
    <script>
    
    $(document).ready(function(){
    $(":button").click(function(){
    $("input[name=nome_utl]").val("");
    $("input[name=email]").val("");
    $("input[name=pass]").val("");
    $("input[name=data_nasc]").val("");

        
    });
    });

    //Função que permite preencher um campo que seja numérico

    function SomenteNumero(e){
        var tecla=(window.event)?event.keyCode:e.which;
        if((tecla>47&&tecla<58)) return true;
        else{
        if (tecla==8 || tecla==0) return true;
        else return false;
        }
    }
    </script>

    <?php
    if($_POST && count($validacao)==0){
        $con = ligaBD();
        
        
        if ($operacao=="update"){
            $stm = $con->prepare("update utilizadores set nome_utl =?, email =?, pass=?,data_nasc=? where id_utl=? ");
            $stm->bind_param("ssssi",$_POST["nome_utl"],$_POST["email"],$_POST["pass"],$_POST["data_nasc"],$_GET["id"]);
            if ($stm->execute()){
                header("Location: conta.php");
            }else{
                echo "Ocorreu um erro a inserir o registo.";
                header("Refresh: 5; url=conta.php");
            }
            $stm->close();
        }
        
        }  
     ?>


</body>
</html>