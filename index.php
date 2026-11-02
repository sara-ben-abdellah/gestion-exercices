
<?php

require_once("conn.php");

// Récupérer tous les exercices
$sql = "SELECT * FROM exercice ORDER BY id DESC";
$stmt = $conn->query($sql);
$exercices = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Gestion des exercices</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <h1>Gestion des exercices</h1>

    <div class="formulaire">

        <h2>Ajouter un exercice</h2>

        <form action="ajouter_exe.php" method="POST">

            <label>Titre :</label>
            <input type="text" name="titre" required>

            <label>Auteur :</label>
            <input type="text" name="auteur" required>

            <label>Date de création :</label>
            <input type="date" name="date_creation" required>

            <button type="submit">Ajouter</button>

        </form>

    </div>

    <h2>Liste des exercices</h2>

    <table>

        <tr>
            <th>ID</th>
            <th>Titre</th>
            <th>Auteur</th>
            <th>Date de création</th>
            <th>Actions</th>
        </tr>

        <?php foreach ($exercices as $exercice) { ?>

        <tr>

            <td>
                <?= htmlspecialchars($exercice["id"]) ?>
            </td>

            <td>
                <?= htmlspecialchars($exercice["titre"]) ?>
            </td>

            <td>
                <?= htmlspecialchars($exercice["auteur"]) ?>
            </td>

            <td>
                <?= htmlspecialchars($exercice["date_creation"]) ?>
            </td>

            <td>

                <a class="modifier"
                   href="modif_exe.php?id=<?= $exercice['id'] ?>">
                   Modifier
                </a>

                <form action="supp_exe.php"
                      method="POST"
                      class="form-supprimer"
                      onsubmit="return confirm('Voulez-vous vraiment supprimer cet exercice ?');">

                    <input type="hidden"
                           name="id"
                           value="<?= $exercice['id'] ?>">

                    <button type="submit" class="supprimer">
                        Supprimer
                    </button>

                </form>

            </td>

        </tr>

        <?php } ?>

    </table>

</div>

</body>
</html>
