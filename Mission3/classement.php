<?php
include 'menu.php';
// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=ffbsq_competitions', 'root', '');

// Inclure le fichier CSS proprement
echo '<link rel="stylesheet" type="text/css" href="style.css">';

// Exécution de la requête pour récupérer le classement des équipes
$sql = $pdo->query("
    SELECT 
        e.nom_equipe, 
        c.nom_club,
        SUM(r.points) AS total_points
    FROM resultat r
    JOIN equipe e ON r.equipe_id = e.id_equipe
    JOIN club c ON e.club_id = c.id_club
    GROUP BY e.id_equipe, c.nom_club
    ORDER BY total_points DESC
");

echo "<h2>🏆 Classement des Équipes</h2>";
echo "<table border='1' cellpadding='10'>";
echo "<tr><th>Position</th><th>Équipe</th><th>Club</th><th>Points</th></tr>";

$position = 1;
while ($row = $sql->fetch()) {
    echo "<tr>
        <td>{$position}</td>
        <td>{$row['nom_equipe']}</td>
        <td>{$row['nom_club']}</td>
        <td>{$row['total_points']}</td>
    </tr>";
    $position++;
}
echo "</table>";
?>
