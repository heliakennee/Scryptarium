<?php
session_start();

if (isset($_POST['reset'])) {
    session_destroy();
    session_start();
}
if (!isset($_SESSION['notes'])) {
    $_SESSION['notes'] = [];
}
if (!isset($_SESSION['tab1'])) {
    $_SESSION['tab1'] = [];
}
if (!isset($_SESSION['tab2'])) {
    $_SESSION['tab2'] = [];
}
if (!isset($_SESSION['tab3'])) {
    $_SESSION['tab3'] = [];
}
if (!isset($_SESSION['tab4'])) {
    $_SESSION['tab4'] = [];
}
if (!isset($_SESSION['classe'])) {
    $_SESSION['classe'] = [];
}

// Question 8
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['question1'])) {
    $val1 = isset($_POST['val1']) ? (int)$_POST['val1'] : 0;
    $_SESSION['notes'][] = $val1;
}

// Question 9
function Somme($lst) {
    $somme = 0;
    for ($i = 0; $i < count($lst); $i++) {
        $somme += $lst[$i];
    }
    return $somme;
}

// Question 10
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['question3'])) {
    $valtab1 = isset($_POST['valtab1']) ? (int)$_POST['valtab1'] : 0;
    $valtab2 = isset($_POST['valtab2']) ? (int)$_POST['valtab2'] : 0;

    $_SESSION['tab1'][] = $valtab1;
    $_SESSION['tab2'][] = $valtab2;
}

function somme_tab($tab1, $tab2) {
    $tab = [];
    for ($i = 0; $i < count($tab1); $i++) {
        $tab[] = $tab1[$i] + $tab2[$i];
    }
    return $tab;
}

//Question 11
function produit_tab($tab3, $tab4) {
    $produit = 0;
    for ($i = 0;$i<count($tab3);$i++) {
        for ($j = 0;$j<count($tab4);$j++) {
            $produit += $tab3[$i] * $tab4[$j];
        }
    }
    return $produit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['question4'])) {
    $valtab3 = isset($_POST['valtab3']) ? (int)$_POST['valtab3'] : null;
    $valtab4 = isset($_POST['valtab4']) ? (int)$_POST['valtab4'] : null;

    if ($valtab3 !== null) {
        $_SESSION['tab3'][] = $valtab3;
    }
    if ($valtab4 !== null) {
        $_SESSION['tab4'][] = $valtab4;
    }
}

//Question 12
function plus($tab) {
    for ($i=0;$i<count($tab);$i++) {
        $tab[$i]++;
    }
    return $tab;
}
//Question 13
function indice($val,$tab) {
    for ($i=0;$i < count($tab); $i++) {
        if ($tab[$i] == $val) {
            return $i;
        }
    }
}

//Question 14
function moyenne($tab) {
    $moyenne = 0;
    for ($i=0;$i<count($tab);$i++) {
        $moyenne += $tab[$i];
    }
    return $moyenne / count($tab);
}

function sup_moyenne($tab) {
    $moyenne = moyenne($tab);
    $lst = [];
    foreach ($tab as $note) {
        if ($moyenne < $note) {
            $lst[] = $note;
        }
    }
    return $lst;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['question7'])) {
    $note = isset($_POST['note']) ? (int)$_POST['note'] : 0;
    $_SESSION['classe'][] = $note;
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Exercices PHP</title>
    <link rel="icon" href="../Icon&image/icon_elephant.png" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.6">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/script.js"></script>
</head>
<body>
    <a href="../index.html">
        <img src="../images/house-solid.svg" alt="Home" class="icon">
    </a>
    <h2>Les tableaux 2</h2>
    <form action="" method="post">
        <input class="reset" type="image" name="reset" src="../images/rotate-left-solid.svg">
    </form>
    <div class="container">
        <h3>Question 8: Tableau de valeurs</h3>
        <form action="" method="post">
            <input type="hidden" name="question1">
            <label class="form-label" for="val1">Entrez une valeur :</label><br>
            <input class="zone" type="number" name="val1" required><br>
            <input class="btn-success" type="submit" value="Valider valeur">
        </form>
        <?php if (isset($val1)): ?>
            <p>Tableau des valeurs : <?= var_dump($_SESSION['notes']) ?></p>
        <?php endif; ?>
    </div>
    <div class="container">
        <h3>Question 9: Somme des valeurs d'un tableau</h3>
        <?php if (count($_SESSION['notes']) > 0): ?>
            <p>Somme des valeurs : <?= Somme($_SESSION['notes']) ?></p>
        <?php else: ?>
            <p><i>Le tableau saisi dans l'exercice 8 sera réutilisé</i></p>
        <?php endif; ?>
    </div>
    <div class="container">
        <h3>Question 10: Somme des valeurs de deux tableaux</h3>
        <form action="" method="post">
            <input type="hidden" name="question3">
            <label class="form-label" for="valtab1">Entrez une valeur pour le tableau 1 :</label><br>
            <input class="zone" type="number" name="valtab1" required><br>
            <label class="form-label" for="valtab2">Entrez une valeur pour le tableau 2 :</label><br>
            <input class="zone" type="number" name="valtab2" required><br>
            <input class="btn-success" type="submit" value="Valider valeur">
        </form>
        <?php if (count($_SESSION['tab1']) > 0 && count($_SESSION['tab1']) == count($_SESSION['tab2'])): ?>
            <p>Somme des tableaux : <?= var_dump(somme_tab($_SESSION['tab1'], $_SESSION['tab2'])) ?></p>
        <?php else: ?>
            <p>Les tableaux doivent avoir le même nombre d'éléments pour afficher la somme.</p>
        <?php endif; ?>
    </div>
    <div class="container">
        <h3>Question 11: Produit des valeurs de deux tableaux</h3>   
        <form action="" method="post">
            <input type="hidden" name="question4">
            <label class="form-label" for="valtab3">Entrez une valeur pour le tableau 1 :</label><br>
            <input class="zone" type="number" name="valtab3"><br>
            <label class="form-label" for="valtab4">Entrez une valeur pour le tableau 2 :</label><br>
            <input class="zone" type="number" name="valtab4"><br>
            <input class="btn-success" type="submit" value="Ajouter au tableau  ">
        </form>
        <?php if (count($_SESSION['tab3']) > 0 && count($_SESSION['tab4']) > 0): ?>
            <p>Produit des tableaux : <?= produit_tab($_SESSION['tab3'], $_SESSION['tab4']) ?></p>
        <?php else: ?>
            <p>Ajoutez des valeurs dans les deux tableaux pour calculer le produit.</p>
        <?php endif; ?>
    </div>
    <div class="container">
        <h3>Question 12: Augmentation des valeurs du tableau</h3>
        <p><i>Le tableau saisi dans l'exercice 8 sera réutilisé</i></p>
        <?php if (count($_SESSION['notes']) > 0): ?>
            <p>Nouveau tableau : <?= var_dump(plus($_SESSION['notes']))?></p>
        <?php endif; ?>
    </div>
    <div class="container">
        <h3>Question 13: Renvoie de la valeur la plus élevé</h3>
        <p><i>Le tableau saisi dans l'exercice 8 sera réutilisé</i></p>
        <?php if (count($_SESSION['notes']) > 0): ?>
            <p>Valeur la plus haute : <?= max($_SESSION['notes'])?></p>
            <p>Indice de la valeur :<?= indice(max($_SESSION['notes']),$_SESSION['notes'])?></p>
        <?php endif; ?>
    </div>
    <div class="container">
        <h3>Question 14: Renvoie du nombre de note superieur à la moyenne</h3>
        <form action="" method="post">
            <input type="hidden" name="question7">
            <label for="note">Entrez une note :</label><br>
            <input class="zone" type="number" name="note" required><br>
            <input class="btn-success" type="submit" value="Ajouter au tableau">
        </form>
        <?php if (count($_SESSION['classe']) > 0): ?>
            <p>Valeur la moyenne de la classe : <?= moyenne($_SESSION['classe'])?></p>
            <p>Nombre de notes superieur à la moyenne de la classe  :<?= var_dump(sup_moyenne($_SESSION['classe']))?></p>
        <?php endif; ?>
    </div>
    <button id="scrollToTopBtn" onclick="scrollToTop()"><img src="../Icon&image/arrow-up-solid.svg" id="icontotop"></button>
</body>
</html>
