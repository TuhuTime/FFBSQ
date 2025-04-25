<?php
include 'menu.php';
?>

<div class="container mt-4">
    <h2 class="text-center">Compétitions à venir</h2>

    <?php
    $pdo = new PDO('mysql:host=localhost;dbname=ffbsq_competitions', 'siteuser', '');

    $sql = $pdo->query("
        SELECT c.id_competition, c.nom_competition, c.date_competition, c.lieu, cat.nom_categorie, t.nom_type, c.nb_equipes
        FROM competition c
        JOIN categorie cat ON c.categorie_id = cat.id_categorie
        JOIN type_competition t ON c.type_id = t.id_type
        WHERE c.date_competition >= CURDATE()
        ORDER BY c.date_competition ASC
    ");
    $competitions = $sql->fetchAll();
    ?>

    <?php if (count($competitions) > 0) { ?>
        <table class="table table-striped">
            <thead class="table-primary">
            <tr>
                <th>Nom</th>
                <th>Date</th>
                <th>Lieu</th>
                <th>Catégorie</th>
                <th>Type</th>
                <th>Nb équipes</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($competitions as $comp) { ?>
                <tr>
                    <td><?= htmlspecialchars($comp['nom_competition']) ?></td>
                    <td><?= htmlspecialchars($comp['date_competition']) ?></td>
                    <td><?= htmlspecialchars($comp['lieu']) ?></td>
                    <td><?= htmlspecialchars($comp['nom_categorie']) ?></td>
                    <td><?= htmlspecialchars($comp['nom_type']) ?></td>
                    <td><?= htmlspecialchars($comp['nb_equipes']) ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center alert alert-info">Aucune compétition à venir.</p>
    <?php } ?>

    <h2 class="text-center mt-4">Navigation rapide</h2>
    <div class="text-center">
        <a href="creer_competition.php" class="btn btn-primary">Créer une Compétition</a>
        <a href="gestion_competitions.php" class="btn btn-warning">Gérer les Compétitions</a>
        <a href="ajouter_resultat.php" class="btn btn-success">Ajouter un Résultat</a>
        <a href="classement.php" class="btn btn-danger">Voir le Classement</a>
    </div>
</div>
