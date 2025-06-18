<?php
require_once 'ligacaoBD.php';

$con = ligaBD();

if ($con == TRUE) {
    $mail = $_POST['email'];
    $pass = $_POST['senha'];

    
    $query = $con->query("SELECT email, battletag, pass FROM utilizadores WHERE email = '$mail'");

if (mysqli_num_rows($query) > 0) {
    $utilizador = mysqli_fetch_assoc($query);
    $battletag = $utilizador['battletag'];
    $hashGuardado = $utilizador['pass'];

    if (password_verify($pass, $hashGuardado)) {
        session_start();
        $_SESSION["login"] = $mail;
        $_SESSION["start"] = time();
        $_SESSION['expirar'] = $_SESSION['start'] + 3600;

        $now = time();
        if ($now > $_SESSION['expirar']) {
            session_destroy();
            echo "<meta http-equiv='refresh' content='0; url=index.html'>";
            exit;
        }
        ?>
        <script>
        const userData = {
            email: "<?php echo $mail; ?>",
            gameTag: "<?php echo $battletag; ?>"
        };
        localStorage.setItem("utilizadorLogado", JSON.stringify(userData));
        </script>
        <?php
        echo "<meta http-equiv='refresh' content='0; url=index.html'>";
    } else {
        echo "<script>alert('Senha incorreta.');</script>";
        echo "<meta http-equiv='refresh' content='0; url=login.html'>";
    }
} else {
    echo "<script>alert('Email não encontrado.');</script>";
    echo "<meta http-equiv='refresh' content='0; url=login.html'>";
}
}
?>

