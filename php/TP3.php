<?php
session_start();

// Réinitialisation de la session si l'utilisateur le demande
if (isset($_POST['reset'])) {
    session_destroy(); // Détruit toutes les données de session
    session_start(); // Redémarre la session
}

// Initialisation des variables de session pour chaque question si elles ne sont pas déjà définies
if (!isset($_SESSION['tot'])) {
    $_SESSION['tot'] = 0;
}
if (!isset($_SESSION['resultat_somme'])) {
    $_SESSION['resultat_somme'] = 0;
}
if (!isset($_SESSION['cpt'])) {
    $_SESSION['cpt'] = 0;
}
if (!isset($_SESSION['compteur'])) {
    $_SESSION['compteur'] = 0;
}
if (!isset($_SESSION['notes'])) {
    $_SESSION['notes'] = [];
}
if (!isset($_SESSION['totalNotes'])) {
    $_SESSION['totalNotes'] = 0;
}
if (!isset($_SESSION['nbNotes'])) {
    $_SESSION['nbNotes'] = 0;
}

// Question 1 : Somme de trois valeurs
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['question1'])) {
    $val1 = isset($_POST['valeur1']) ? floatval($_POST['valeur1']) : 0;
    $_SESSION['compteur'] ++;
    $_SESSION['resultat_somme'] += $val1;
}

// Question 2 : Moyenne des valeurs soumises
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['question2'])) {
    $val = isset($_POST['valeur']) ? floatval($_POST['valeur']) : 0;
    
    // On accumule les valeurs et on compte combien ont été ajoutées
    $_SESSION['tot'] += $val;
    $_SESSION['cpt']++;
}

// Question 3 : Factorielle
function factorielle($n) {
    if ($n == 0 || $n == 1) {
        return 1;
    }
    return $n * factorielle($n - 1);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['question3'])) {
    $nbr = isset($_POST['nbr']) ? intval($_POST['nbr']) : 0;
    if ($nbr >= 0) {
        $_SESSION['resultat_factorielle'] = factorielle($nbr);
    }
}

// Question 4 : Notes des étudiants
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['question4'])) {
    $note = isset($_POST['note']) ? floatval($_POST['note']) : 0;
    
    // On ajoute la note soumise et on actualise le total des notes
    $_SESSION['notes'][] = $note;
    $_SESSION['totalNotes'] += $note;
    $_SESSION['nbNotes']++;
}

// Question 5 : Conversion des monnaies
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['question5'])) {
    $montant = isset($_POST['montant']) ? floatval($_POST['montant']) : 0;
    $devise = isset($_POST['devise']) ? $_POST['devise'] : 'euro';
    
    switch ($devise) {
        case 'dollar':
            $_SESSION['resultat_conversion'] = $montant * 1.2 . ' dollars';
            break;
        case 'yen':
            $_SESSION['resultat_conversion'] = $montant * 133.16 . ' yens';
            break;
        case 'dirham':
            $_SESSION['resultat_conversion'] = $montant * 11.17 . ' dirhams';
            break;
        default:
            $_SESSION['resultat_conversion'] = 'Devise non reconnue.';
    }
}

// Question 6 : Opérations mathématiques
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['question6'])) {
    $valeur1 = isset($_POST['valeur1']) ? floatval($_POST['valeur1']) : 0;
    $valeur2 = isset($_POST['valeur2']) ? floatval($_POST['valeur2']) : 0;
    $operation = isset($_POST['operation']) ? $_POST['operation'] : '';
    
    switch ($operation) {
        case '+':
            $_SESSION['resultat_operation'] = $valeur1 + $valeur2;
            break;
        case '-':
            $_SESSION['resultat_operation'] = $valeur1 - $valeur2;
            break;
        case '*':
            $_SESSION['resultat_operation'] = $valeur1 * $valeur2;
            break;
        case '/':
            if ($valeur2 != 0) {
                $_SESSION['resultat_operation'] = $valeur1 / $valeur2;
            } else {
                $_SESSION['resultat_operation'] = 'Division par zéro impossible.';
            }
            break;
        default:
            $_SESSION['resultat_operation'] = 'Opération non valide.';
    }
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
    <h2>Structures répétitives</h2>
    <form action="" method="post">
        <input class="reset" type="image" name="reset" src="../images/rotate-left-solid.svg">
    </form>
    <div class="container">
        <!-- Question 1 : Somme de trois valeurs -->
        <h3>Question 1: Somme de trois valeurs</h3>
        <form action="" method="post">
            <input type="hidden" name="question1">
            <label class="form-label" for="valeur1">Entrez la première valeur :</label> <br>
            <input class="zone" type="number" name="valeur1" required><br>
            <input class="btn-success" type="submit" value="Calculer la somme">
        </form>
        <?php if (isset($_SESSION['resultat_somme']) && $_SESSION['compteur']==3): ?>
            <p>La somme des trois valeurs est : <?= $_SESSION['resultat_somme'] ?></p>
        <?php endif; ?>
    </div>
    <div class="container">
        <!-- Question 2 : Moyenne des valeurs soumises -->
        <h3>Question 2: Moyenne des valeurs</h3>
        <form action="" method="post">
            <input type="hidden" name="question2">
            <label for="valeur" class="form-label">Entrez une valeur :</label> <br>
            <input class="zone" type="number" name="valeur" required><br>
            <input class="btn-success" type="submit" value="Calculer la moyenne">
        </form>
        <?php if ($_SESSION['cpt'] > 0): ?>
            <p>La moyenne des valeurs est : <?= $_SESSION['tot'] / $_SESSION['cpt'] ?></p>
        <?php endif; ?>
    </div>
    <div class="container">
        <!-- Question 3 : Factorielle -->
        <h3>Question 3: Calcul de la factorielle</h3>
        <form action="" method="post">
            <input type="hidden" name="question3">
            <label class="form-label" for="nbr">Entrez un nombre :</label> <br>
            <input class="zone" type="number" name="nbr" required><br>
            <input class="btn-success" type="submit" value="Calculer la factorielle">
        </form>
        <?php if (isset($_SESSION['resultat_factorielle'])): ?>
            <p>La factorielle est : <?= $_SESSION['resultat_factorielle'] ?></p>
        <?php endif; ?>
    </div>
    <div class="container">
        <!-- Question 4 : Notes des étudiants -->
        <h3>Question 4: Notes des étudiants</h3>
        <form action="" method="post">
            <input type="hidden" name="question4">
            <label class="form-label" for="note">Entrez une note :</label><br>
            <input class="zone" type="number" name="note" step="0.01" required><br>
            <input class="btn-success" type="submit" value="Ajouter la note">
        </form>
        <?php if ($_SESSION['nbNotes'] > 0): ?>
            <p>Nombre total de notes : <?= $_SESSION['nbNotes'] ?></p>
            <p>Moyenne des notes : <?= $_SESSION['totalNotes'] / $_SESSION['nbNotes'] ?></p>
        <?php endif; ?>
    </div>
    <div class="container">
        <!-- Question 5 : Conversion des monnaies -->
        <h3>Question 5: Conversion des monnaies</h3>
        <form action="" method="post">
            <input type="hidden" name="question5">
            <label class="form-label" for="montant">Montant à convertir :</label> <br>
            <input class="zone" type="number" name="montant" required><br>
            <label class="form-label" for="devise">Choisissez la devise :</label><br>
            <select name="devise">
                <option value="dollar">Dollar</option>
                <option value="yen">Yen</option>
                <option value="dirham">Dirham</option>
            </select><br>
            <input class="btn-success" type="submit" value="Convertir">
        </form>
        <?php if (isset($_SESSION['resultat_conversion'])): ?>
            <p>Résultat de la conversion : <?= $_SESSION['resultat_conversion'] ?></p>
        <?php endif; ?>
    </div>
    <div class="container">
        <!-- Question 6 : Opérations mathématiques -->
        <h3>Question 6: Opérations mathématiques</h3>
        <form action="" method="post">
            <input type="hidden" name="question6">
            <label class="form-label" for="valeur1">Entrez la première valeur :</label><br>
            <input class="zone" type="number" name="valeur1" required><br>
            <label class="form-label" for="valeur2">Entrez la deuxième valeur :</label><br>
            <input class="zone" type="number" name="valeur2" required><br>
            <label class="from-label" for="operation">Choisissez l'opération :</label>
            <select name="operation">
                <option value="+">+</option>
                <option value="-">-</option>
                <option value="*">*</option>
                <option value="/">/</option>
            </select><br>
            <input class="btn-success" type="submit" value="Calculer">
        </form>
        <?php if (isset($_SESSION['resultat_operation'])): ?>
            <p>Résultat de l'opération : <?= $_SESSION['resultat_operation'] ?></p>
        <?php endif; ?>
    </div>
    <button id="scrollToTopBtn" onclick="scrollToTop()"><img src="../images/arrow-up-solid.svg" id="icontotop"></button>
</body>
</html>
