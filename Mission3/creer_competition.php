<?php
include 'menu.php';
?>

<div class="container mt-4">
    <h2 class="text-center">Créer une Compétition</h2>
    <form method="POST" action="traitement_creation_competition.php" class="needs-validation" novalidate>

        <div class="mb-3">
            <label class="form-label">Nom de la compétition</label>
            <input type="text" name="nom_competition" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Date</label>
            <input type="date" name="date_competition" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Lieu</label>
            <input type="text" name="lieu" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Catégorie</label>
            <select name="categorie_id" class="form-select" required>
                <option value="1">Senior</option>
                <option value="2">Junior</option>
                <option value="3">Cadet</option>
                <option value="4">Vétéran</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Type</label>
            <select name="type_id" class="form-select" required>
                <option value="1">Individuel</option>
                <option value="2">Doublette</option>
                <option value="3">Triplette</option>
                <option value="4">Quadrette</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Nombre d'équipes</label>
            <input type="number" name="nb_equipes" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-primary w-100">Créer la compétition</button>
    </form>
</div>
