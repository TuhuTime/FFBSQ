<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

include 'menu.php';
$pdo = new PDO('mysql:host=localhost;dbname=ffbsq_competitions', 'root', '');

// Récupération des compétitions et équipes
$competitions = $pdo->query("SELECT id_competition, nom_competition FROM competition")->fetchAll();
$equipes = $pdo->query("SELECT id_equipe, nom_equipe FROM equipe")->fetchAll();
?>

<div class="container mt-4">
    <h2 class="text-center">Ajouter un Résultat</h2>
    <form method="POST" action="traitement_resultat.php" class="needs-validation" novalidate>

        <div class="mb-3">
            <label class="form-label">Compétition</label>
            <select name="competition_id" class="form-select" required>
                <?php foreach ($competitions as $comp) { ?>
                    <option value="<?= $comp['id_competition']; ?>"><?= $comp['nom_competition']; ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Équipe</label>
            <select name="equipe_id" class="form-select" required>
                <?php foreach ($equipes as $equipe) { ?>
                    <option value="<?= $equipe['id_equipe']; ?>"><?= $equipe['nom_equipe']; ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Position</label>
            <select name="position" class="form-select" required>
                <option value="1">1ère place</option>
                <option value="2">2ème place</option>
                <option value="3">3ème place</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success w-100">Ajouter le résultat</button>
    </form>
</div>
