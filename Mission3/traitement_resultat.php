<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=ffbsq_competitions', 'root', '');

    // Récupération des données du formulaire
    $competition_id = $_POST['competition_id'];
    $equipe_id = $_POST['equipe_id'];
    $position = $_POST['position'];

    // Exécuter la procédure stockée pour ajouter le résultat
    $sql = $pdo->prepare("CALL ajouter_resultat(?, ?, ?)");
    $sql->execute([$competition_id, $equipe_id, $position]);

    echo " Résultat ajouté avec succès ! <a href='ajouter_resultat.php'>Retour</a>";

} catch (PDOException $e) {
    echo " Erreur : " . $e->getMessage();
}
?>
<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=ffbsq_competitions', 'root', '');

    // Récupération des données du formulaire
    $competition_id = $_POST['competition_id'];
    $equipe_id = $_POST['equipe_id'];
    $position = $_POST['position'];

    // Exécuter la procédure stockée pour ajouter le résultat
    $sql = $pdo->prepare("CALL ajouter_resultat(?, ?, ?)");
    $sql->execute([$competition_id, $equipe_id, $position]);

    echo " Résultat ajouté avec succès ! <a href='ajouter_resultat.php'>Retour</a>";

} catch (PDOException $e) {
    if (strpos($e->getMessage(), '45000') !== false) {
        echo " <b>Erreur :</b> Cette équipe a déjà un résultat pour cette compétition. <a href='ajouter_resultat.php'>Retour</a>";
    } else {
        echo " Erreur SQL : " . $e->getMessage();
    }
}
?>
