<?php
$pdo = new PDO('mysql:host=localhost;dbname=ffbsq_competitions', 'root', '');

$id = $_POST['id_competition'];
$nom = $_POST['nom_competition'];
$date = $_POST['date_competition'];
$lieu = $_POST['lieu'];
$nb_equipes = $_POST['nb_equipes'];

// Mettre à jour la compétition
$sql = $pdo->prepare("UPDATE competition SET nom_competition=?, date_competition=?, lieu=?, nb_equipes=? WHERE id_competition=?");
$sql->execute([$nom, $date, $lieu, $nb_equipes, $id]);

echo " Compétition modifiée avec succès ! <a href='gestion_competitions.php'>Retour</a>";

