<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pap";

$con = new mysqli($servername, $username, $password, $dbname);


$email = $_POST['email'];
$battletag = $_POST['battletag'];
$data_nascimento = $_POST['data_nascimento'];
$passe = password_hash($_POST['senha'], PASSWORD_DEFAULT);


date_default_timezone_set("Europe/Lisbon");

$query = $con->query ("select * from utilizadores where email = '$email' or battletag= '$battletag' ;");
    
$linhas=mysqli_num_rows($query);

if ($linhas > 0) {

    echo "<script>alert('Este Nome já se encontra registado na base de dados');</script>";
    echo "<meta http-equiv=\"refresh\" content=\"2; url=registo.php\">";
} else {

    $stm = $con->prepare("INSERT INTO utilizadores (email, pass, data_nasc, battletag) VALUES (?, ?, ?, ?)");
    $stm->bind_param("ssss", $email, $passe, $data_nascimento, $battletag);

    if ($stm->execute()) {
        echo "<script>alert('Registo efetuado com sucesso');</script>";
        ?>

        <script>
            const userData = {
                email: "<?php echo $email; ?>",
                gameTag: "<?php echo $battletag; ?>"
            };

            localStorage.setItem("utilizadorLogado", JSON.stringify(userData));
        </script>
        
        <?php
        echo "<meta http-equiv=\"refresh\" content=\"0; url=index.html\">";
    } else {
        echo "<script>alert('Ocorreu um erro ao registrar os dados.');</script>";
    }
}

$con->close();
?>
