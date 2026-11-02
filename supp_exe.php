
<?php

require_once("conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST"
    && isset($_POST["id"])) {

    $id = $_POST["id"];

    $sql = "DELETE FROM exercice WHERE id = :id";

    $stmt = $conn->prepare($sql);

    $stmt->execute([':id' => $id]);

    header("Location: index.php");
    exit();
}

header("Location: index.php");
exit();

?>
