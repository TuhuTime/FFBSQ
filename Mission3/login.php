<?php
session_start();
include 'menu.php';

$pdo = new PDO('mysql:host=localhost;dbname=ffbsq_competitions', 'siteuser', '');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Vérification de l'utilisateur
    $sql = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = ?");
    $sql->execute([$email]);
    $user = $sql->fetch();

    if ($user && password_verify($mot_de_passe, $user['mot_de_passe'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['nom'] = $user['nom'];
        header("Location: index.php");
        exit;
    } else {
        $error = "Email ou mot de passe incorrect.";
    }
}
?>

    <div class="container mt-4">
        <h2 class="text-center">Connexion</h2>
        <?php if (isset($error)) { echo "<p class='alert alert-danger'>$error</p>"; } ?>
        <form method="POST" class="needs-validation" novalidate>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Mot de passe</label>
                <input type="password" name="mot_de_passe" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Se connecter</button>
        </form>
    </div>
<?php
