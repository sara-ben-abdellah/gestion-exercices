
<?php

require_once("conn.php");

// Récupérer l'identifiant
if (isset($_GET["id"])) {
    $id = $_GET["id"];
} elseif (isset($_POST["id"])) {
    $id = $_POST["id"];
} else {
    die("Identifiant manquant");
}

// Si le formulaire est envoyé
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $titre = $_POST["titre"];
    $auteur = $_POST["auteur"];
    $date_creation = $_POST["date_creation"];

    $sql = "UPDATE exercice
            SET titre = :titre,
                auteur = :auteur,
                date_creation = :date_creation
            WHERE id = :id";

    $stmt = $conn->prepare($sql);

    $stmt->execute([
        ':titre' => $titre,
        ':auteur' => $auteur,
        ':date_creation' => $date_creation,
        ':id' => $id
    ]);

    header("Location: index.php");
    exit();
}

// Récupérer les informations de l'exercice
$sql = "SELECT * FROM exercice WHERE id = :id";

$stmt = $conn->prepare($sql);
$stmt->execute([':id' => $id]);

$exercice = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$exercice) {
    die("Exercice introuvable");
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Modifier un exercice</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <h1>Modifier un exercice</h1>

    <form action="modif_exe.php" method="POST">

        <input type="hidden" name="id"
               value="<?= htmlspecialchars($exercice['id']) ?>">

        <label>Titre :</label>
        <input type="text" name="titre"
               value="<?= htmlspecialchars($exercice['titre']) ?>" required>

        <label>Auteur :</label>
        <input type="text" name="auteur"
               value="<?= htmlspecialchars($exercice['auteur']) ?>" required>

        <label>Date de création :</label>
        <input type="date" name="date_creation"
               value="<?= htmlspecialchars($exercice['date_creation']) ?>" required>

        <button type="submit">Enregistrer les modifications</button>

    </form>

    <a href="index.php">Retour à la liste</a>

</div>

</body>
</html>
