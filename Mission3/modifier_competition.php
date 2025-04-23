<?php
include 'menu.php';
$pdo = new PDO('mysql:host=localhost;dbname=ffbsq_competitions', 'root', '');

// Vérification de l'ID
if (!isset($_GET['id'])) {
    die("ID de compétition manquant.");
}

$id = $_GET['id'];
$sql = $pdo->prepare("SELECT * FROM competition WHERE id_competition = ?");
$sql->execute([$id]);
$competition = $sql->fetch();

if (!$competition) {
    die("Compétition non trouvée.");
}
?>

<div class="container mt-4">
    <h2 class="text-center">Modifier la Compétition</h2>
    <form method="POST" action="traitement_modifier_competition.php" class="needs-validation" novalidate>
        <input type="hidden" name="id_competition" value="<?= $competition['id_competition'] ?>">

        <div class="mb-3">
            <label class="form-label">Nom</label>
            <input type="text" name="nom_competition" class="form-control" value="<?= $competition['nom_competition'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Date</label>
            <input type="date" name="date_competition" class="form-control" value="<?= $competition['date_competition'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Lieu</label>
            <input type="text" name="lieu" class="form-control" value="<?= $competition['lieu'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nombre d'équipes</label>
            <input type="number" name="nb_equipes" class="form-control" value="<?= $competition['nb_equipes'] ?>" required>
        </div>

        <button type="submit" class="btn btn-warning w-100">Modifier</button>
    </form>
</div>
