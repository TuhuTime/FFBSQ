<?php require 'connexion.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Adhérents</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="text-center mb-4">Liste des Adhérents</h2>
    <table class="table table-bordered table-hover table-striped">
        <thead class="thead-dark">
        <tr><th>Nom</th><th>Prénom</th><th>Âge</th><th>Catégorie</th><th>Club</th></tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT a.nom, a.prenom, YEAR(CURDATE()) - YEAR(a.date_naissance) AS age,
            CASE 
              WHEN YEAR(CURDATE()) - YEAR(a.date_naissance) < 18 THEN 'U18'
              WHEN YEAR(CURDATE()) - YEAR(a.date_naissance) <= 40 THEN 'Senior'
              ELSE 'Vétéran'
            END AS categorie_age,
            c.nom_club
            FROM adherents a
            JOIN club c ON a.club_id = c.id_club";
        $data = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        foreach($data as $row):
            ?>
            <tr>
                <td><?= htmlspecialchars($row['nom']) ?></td>
                <td><?= htmlspecialchars($row['prenom']) ?></td>
                <td><?= htmlspecialchars($row['age']) ?></td>
                <td><?= htmlspecialchars($row['categorie_age']) ?></td>
                <td><?= htmlspecialchars($row['nom_club']) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <a href="../Mission3/index.php" class="btn btn-primary">⬅ Retour Accueil</a>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
