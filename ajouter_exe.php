
<?php

require_once("conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $titre = $_POST["titre"];
    $auteur = $_POST["auteur"];
    $date_creation = $_POST["date_creation"];

    $sql = "INSERT INTO exercice (titre, auteur, date_creation)
            VALUES (:titre, :auteur, :date_creation)";

    $stmt = $conn->prepare($sql);

    $stmt->execute([
        ':titre' => $titre,
        ':auteur' => $auteur,
        ':date_creation' => $date_creation
    ]);

    header("Location: index.php");
    exit();
}

?>
