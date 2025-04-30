<?php
require_once __DIR__ . '/db.php';
if (isset($_GET['id_img'])) {
    $sql = "SELECT imageType,imageData FROM imagens WHERE id_img=?";
    $statement = $conn->prepare($sql);
    $statement->bind_param("i", $_GET['id_img']);
    $statement->execute() or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_connect_error());
    $result = $statement->get_result();

    $row = $result->fetch_assoc();
    header("Content-type: " . $row["imageType"]);
    echo $row["imageData"];
}
?>

