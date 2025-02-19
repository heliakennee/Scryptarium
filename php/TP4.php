<?php

session_start();

// Réinitialisation de la session si l'utilisateur le demande
if (isset($_POST['reset'])) {
    session_destroy(); // Détruit toutes les données de session
    session_start(); // Redémarre la session
}
if (!isset($_SESSION['tot'])) {
    $_SESSION['tot'] = 0;
}
if (!isset($_SESSION['entrée'])) {
    $_SESSION['entrée'] = 0;
}

//Question 1:
function identite($nom,$prenom) {
    return "Le cours d’algorithmique est bientôt fini. Bon courage à vous $prenom $nom pour la suite.";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['question1'])) {
    $nom = isset($_POST['nom'])? $_POST['nom'] : '';
    $prenom = isset($_POST['prenom'])? $_POST['prenom'] : '';
}

//Question 2:
function MTCOM($ca) {
    if ($ca < 10000) {
        return "Le montant des commissions de ce commercial est de " . $ca * 0.1 . " avec un taux de 10%";
    } elseif ($ca <= 20000) {
        return "Le montant des commissions de ce commercial est de " . $ca * 0.12 . " avec un taux de 12%";
    } elseif ($ca <=30000) {
        return "Le montant des commissions de ce commercial est de " . $ca * 0.15 . " avec un taux de 15%";
    } else {
        return "Le montant des commissions de ce commercial est de " . $ca * 0.2 . " avec un taux de 20%";
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['question2'])) {
    $ca = isset($_POST['ca'])? floatval($_POST['ca']) : 0;
}

//Question 3 

function cube($nb) {
    return $nb**3;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['question3'])) {
    $nb = isset($_POST['nb'])? floatval($_POST['nb']) : 0;
}

//Question 4
function moyenne($valeur,$entrée) {
    return $valeur / $entrée;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['question4'])) {
    $valeur = isset($_POST['valeur'])? floatval(($_POST['valeur'])) : 0;

    $_SESSION['tot'] += $valeur ; 
    $_SESSION['entrée'] += 1;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Scryptarium</title>
    <link rel="icon" href="../Icon&image/icon_elephant.png" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.6">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/script.js"></script>
</head>
<body>
    <a href="../index.html">
        <img src="../images/house-solid.svg" alt="Home" class="icon">
    </a>
    <h2>Les sous-programmes Procédures & Fonctions</h2>
    <form action="" method="post">
        <input class="reset" type="image" name="reset" src="../images/rotate-left-solid.svg">
    </form>
        
    <div class="container">
        <h3>Question 1: Afficher nom et prenom</h3>
        <form action="" method="post">
            <input type="hidden" name="question1">
            <label class="form-label" for="nom">Entrez votre nom :</label><br>
            <input class="zone" type="text" name="nom"  required><br>
            <label class="form-label" for="prenom">Entrez votre prénom :</label><br>
            <input class="zone" type="text" name="prenom"  required><br>
            <input class="btn-success" type="submit" value="Valider">
            <?php if (isset($nom) && isset($prenom)) : ?>
                <p><?=identite($nom,$prenom)?></p>
            <?php endif; ?>
        </form>
    </div>
    <div class="container">
        <h3>Question 2: Calculer taux d'un commercial</h3>
        <form action="" method="post">
            <input type="hidden" name="question2">
            <label class="form-label" for="ca">Entrez un chiffre d'affaire:</label><br>
            <input class="zone" type="number"  name="ca" step="100" required><br>
            <input class="btn-success" type="submit" value="Calculer le montant et le taux">
        </form>
        <?php if (isset($ca)): ?>
            <p><?=MTCOM($ca)?></p>
        <?php endif; ?>
    </div>
    <div class="container">
        <h3>Question 3: Calcul du cube</h3>
        <form action="" method="post">
            <input type="hidden" name="question3">
            <label class="form-label" for="nb">Entrez un nombre:</label><br>
            <input class="zone" type="number" name="nb" required><br>
            <input class="btn-success" type="submit" value="Calculer le cube du nombre">
        </form>
        <?php if(isset($nb)): ?>
            <p>Le cube de <?=$nb?> est <?=cube($nb)?></p>
        <?php endif ; ?>
    </div>
    <div class="container">
        <h3>Question 4: Calcul d'une moyenne</h3>
        <form action="" method="post">
            <input type="hidden" name="question4">
            <label class="form-label" for="valeur">Entrez un nombre:</label><br>
            <input class="zone" type="number" name="valeur"  required><br>
            <input class="btn-success" type="submit" value="Commencer le calcul de moyenne">
        </form>
        <?php if(isset($valeur)): ?>
            <p>La moyenne est: <?= moyenne($_SESSION['tot'],$_SESSION['entrée']) ?></p>
        <?php endif; ?>
    </div>    
    <button id="scrollToTopBtn" onclick="scrollToTop()"><img src="../images/arrow-up-solid.svg" id="icontotop"></button>
</body>
</html>
