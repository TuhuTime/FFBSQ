<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}


include 'menu.php';
?>

<div class="container mt-4">
    <h2 class="text-center">Gestion des Compétitions</h2>

    <?php
    $pdo = new PDO('mysql:host=localhost;dbname=ffbsq_competitions', 'siteuser', '');

    $sql = $pdo->query("
        SELECT c.id_competition, c.nom_competition, c.date_competition, c.lieu, cat.nom_categorie, t.nom_type, c.nb_equipes
        FROM competition c
        JOIN categorie cat ON c.categorie_id = cat.id_categorie
        JOIN type_competition t ON c.type_id = t.id_type
        ORDER BY c.date_competition DESC
    ");
    $competitions = $sql->fetchAll();
    ?>

    <table class="table table-hover">
        <thead class="table-dark">
        <tr>
            <th>Nom</th>
            <th>Date</th>
            <th>Lieu</th>
            <th>Catégorie</th>
            <th>Type</th>
            <th>Nb équipes</th>
            <th>Actions</th>
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
                <td>
                    <a href="modifier_competition.php?id=<?= $comp['id_competition'] ?>" class="btn btn-sm btn-warning">Modifier</a>
                    <a href="supprimer_competition.php?id=<?= $comp['id_competition'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette compétition ?')">Supprimer</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
