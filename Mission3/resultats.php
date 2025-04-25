<?php
include 'menu.php';
$pdo = new PDO('mysql:host=localhost;dbname=ffbsq_competitions', 'root', '');

$competitionId = $_POST['competition_id'] ?? null;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Résultats par Compétition</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="text-center mb-4">Résultats d'une Compétition</h2>

    <form method="post" class="form-inline justify-content-center mb-4">
        <label for="competition_id" class="mr-2">Choisir une compétition :</label>
        <select name="competition_id" id="competition_id" class="form-control mr-2" required>
            <option value="">-- Sélectionner --</option>
            <?php
            $competitions = $pdo->query("SELECT id_competition, nom_competition FROM competition ORDER BY date_competition DESC")->fetchAll();
            foreach ($competitions as $comp):
                $selected = ($comp['id_competition'] == $competitionId) ? 'selected' : '';
                echo "<option value='{$comp['id_competition']}' $selected>" . htmlspecialchars($comp['nom_competition']) . "</option>";
            endforeach;
            ?>
        </select>
        <button type="submit" class="btn btn-primary">Afficher</button>
    </form>

    <?php if ($competitionId): ?>
        <table class="table table-bordered table-striped table-hover">
            <thead class="thead-dark">
            <tr>
                <th>Équipe</th>
                <th>Position</th>
                <th>Points</th>
                <th>Nombre réel participants</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $sql = "
            SELECT
              e.nom_equipe,
              r.position,
              r.points,
              c.nb_equipe_reel
            FROM resultat r
            JOIN equipe e ON r.equipe_id = e.id_equipe
            JOIN competition c ON r.competition_id = c.id_competition
            WHERE c.id_competition = :id AND r.points > 0
            ORDER BY r.position ASC
          ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id' => $competitionId]);
            $results = $stmt->fetchAll();

            foreach ($results as $row):
                ?>
                <tr>
                    <td><?= htmlspecialchars($row['nom_equipe']) ?></td>
                    <td><?= htmlspecialchars($row['position']) ?></td>
                    <td><?= htmlspecialchars($row['points']) ?></td>
                    <td><?= htmlspecialchars($row['nb_equipe_reel'] ?? 'Non renseigné') ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <a href="index.php" class="btn btn-secondary mt-3">⬅ Retour à l'accueil</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
