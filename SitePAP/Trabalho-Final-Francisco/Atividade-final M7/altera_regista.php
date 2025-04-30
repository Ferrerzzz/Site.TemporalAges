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
    $stm= $con->prepare ("select * from produto where id_prd = ?");
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
        <td>Nome do produto *<?php
            if($_POST && in_array("nome_prd",$validacao))
                echo"<span class=\"erro\">(Preenchimento obrigatorio)</span>";
        ?></td>

        <td>
            <input name="nome_prd" type="text" size="45" value="<?php
            if($_POST){
                if(!empty($_POST["nome_prd"]))
                    echo $_POST["nome_prd"];
            }else if($operacao=="update")
            echo $resultados["nome_prd"];
            ?>" /></td>
        
    </tr>
    <tr>
            <td>Tamanho *<?php
            if($_POST && in_array("tamanho",$validacao))
            echo "<span class=\"erro\">(Preenchimento obrigatório</span>";?></td>

<td>
            <input name="tamanho" type="text" size="45" value="<?php
            if($_POST){
                if(!empty($_POST["tamanho"]))
                    echo $_POST["tamanho"];
            }else if($operacao=="update")
            echo $resultados["tamanho"];
            ?>" /></td>


    </tr>

    <tr>
        <td>Preço *<?php
            if($_POST && in_array("preço",$validacao))
                echo"<span class=\"erro\">(Preenchimento obrigatorio)</span>";
        ?></td>

        <td>
            <input name="preço" type="text" size="45" value="<?php
            if($_POST){
                if(!empty($_POST["preço"]))
                    echo $_POST["preço"];
            }else if($operacao=="update")
            echo $resultados["preço"];
            ?>" /></td>
        
    </tr>

    <tr>
        <td>Quantidade*<?php
            if($_POST && in_array("qtd",$validacao))
                echo"<span class=\"erro\">(Preenchimento obrigatorio)</span>";
        ?></td>

        <td>
            <input name="qtd" type="text" size="30" onkeypress="return SomenteNumero(event);"value="<?php
            if($_POST){
                if(!empty($_POST["qtd"]))
                    echo $_POST["qtd"];
            }else if($operacao=="update")
                echo $resultados["qtd"];
            ?>" /></td>
        
    </tr>

    <tr>
        <td>Tipo de Relvado*<?php
            if($_POST && in_array("tipo_relv",$validacao))
                echo"<span class=\"erro\">(Preenchimento obrigatorio)</span>";
        ?></td>

        <td>
            <input name="tipo_relv" type="text" size="30" onkeypress="return SomenteNumero(event);"value="<?php
            if($_POST){
                if(!empty($_POST["tipo_relv"]))
                    echo $_POST["tipo_relv"];
            }else if($operacao=="update")
            echo $resultados["tipo_relv"];
            ?>" /></td>
        
    </tr>
    <tr>
        <td><p><input name="Adicionar" type="submit" value="Adicionar/Alterar"/></p></td>
    </tr>

    <p><b>* Campos Obrigatorios</b></p>

    <p><a href="lista.php">Voltar à lista</a></p>
    </form>

        </div>
    </div>

    
    <script>
    
    $(document).ready(function(){
    $(":button").click(function(){
    $("input[name=nome_prd]").val("");
    $("input[name=tamanho]").val("");
    $("input[name=preço]").val("");
    $("input[name=qtd]").val("");
    $("input[name=tipo_relv]").val("");
        
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
        
        if ($operacao == "insert"){

            $stm = $con->prepare("insert into produto (nome_prd,tamanho,preço,qtd,tipo_relv) values (?,?,?,?,?)");
            $stm->bind_param("sssss",$_POST["nome_prd"],$_POST["tamanho"],$_POST["preço"],$_POST["qtd"],$_POST["tipo_relv"]);

            if ($stm->execute()){
                header("Location: lista.php");
            }else{
                echo "Ocorreu um erro a inserir o registo.";
                header("Refresh: 5; url=lista.php");
            }
            $stm->close();
        }

        if ($operacao=="update"){
            $stm = $con->prepare("update produto set nome_prd =?, tamanho =?, preço=?,qtd=?, tipo_relv=? where id_prd=? ");
            $stm->bind_param("sssssi",$_POST["nome_prd"],$_POST["tamanho"],$_POST["preço"],$_POST["qtd"],$_POST["tipo_relv"],$_GET["id"]);
            if ($stm->execute()){
                header("Location: lista.php");
            }else{
                echo "Ocorreu um erro a inserir o registo.";
                header("Refresh: 5; url=lista.php");
            }
            $stm->close();
        }
        
        }  
     ?>


</body>
</html>