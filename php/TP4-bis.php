<?php

session_start();

if (isset($_POST['reset'])) {
    session_destroy(); // Détruit toutes les données de session
    session_start(); // Redémarre la session
}
if (!isset($_SESSION['capitales'])) {
    $_SESSION['capitales'] = [
        "France" => "Paris",
        "Allemagne" => "Berlin",
        "Italie" => "Rome" ,
        "Espagne" => "Madrid",
        "Pologne" => "Varsovie",
        "République Tchèque" => "Prague",
        "Angleterre" => "Londre",
        "Portugal" => "Lisbonne",
        "Pays-bas" => "Amsterdam",
    ];
}
if (!isset($_SESSION['valeurs'])) {
    $_SESSION['valeurs'] = [];
}
if (!isset($_SESSION['pos'])) {
    $_SESSION['pos'] = 0;
}
if (!isset($_SESSION['neg'])) {
    $_SESSION['neg'] = 0;
}
//Question 1
function factorielle($a,&$b) {
    $b = 1;
    for ($i=1;$i<=$a;$i++) {
        $b = $b * $i; 
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['question1'])) {
    $factor = isset($_POST['factor'])? floatval($_POST['factor']) : 0;

    factorielle($factor,$result);
}
//Question 2
function factorielle2($a) {
    if ($a==1) {
        return 1;
    } else {
        return factorielle2($a-1) * $a ;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['question2'])) {
    $fact = isset($_POST['fact'])? floatval($_POST['fact']) : 0;
}

//Question 3 
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['question3'])) {
    $value1 = isset($_POST['value1'])? floatval($_POST['value1']) : 0;
    $value2 = isset($_POST['value2'])? floatval($_POST['value2']) : 0;
}

// Question 4

function convertir($montant, $monnaie) {
    if ($monnaie == "$") {
        return $montant / 1.08;
    } else {
        return $montant * 1.08;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['question4'])) {
    $montant = isset($_POST['montant'])? floatval($_POST['montant']) : 0;
    $monnaie = isset($_POST['monnaie'])? $_POST['monnaie'] : "";
}

//Question 5
/*
$confirm = "O"
while ($confirm == "O") {
    echo convertir(trim(fgets(STDIN)),trim(fgets(STDIN)));
    $confirm = trim(fgets(STDIN));
}
*/
//Question 6
function recherche($countrie) {
    if (isset($_SESSION['capitales'][$countrie])) {
        return 'La capitale de ce pays est ' . $_SESSION['capitales'][$countrie];
    } else {
    return "Cette capitale ne doit pas être « capitale », elle s’est échappée de mon capital mémoire";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['question6bis'])) {
    $capitale = isset($_POST['capitale'])? $_POST['capitale'] : "";
    $pays = isset($_POST['pays'])? $_POST['pays'] : "";

    $_SESSION['capitales'][$pays] = $capitale;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['question6'])) {
    $countrie = isset($_POST['countrie'])? $_POST['countrie'] : "";
}

//Question 7
/*
for($i=0;$i<5;$i++) {
    $pays = trim(fgets(STDIN));
    echo recherche($pays);
}
*/

//Question 8

function cube($n) {
    return $n ** 3;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['question8'])) {
    $nombre = isset($_POST['nombre'])? floatval($_POST['nombre']) : 0;
}
//Question 9

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['question9'])) {
    $nbr = isset($_POST['nbr'])? floatval($_POST['nbr']) : 0;
}

// Question 10-11
function parcours_pos($tab) {
    $pos = 0;
    for ($i=0;$i<count($tab);$i++) {
        if ($tab[$i] >= 0) {
            $pos++;
        }    
    }
    return $pos;
}
function parcours_neg($tab) {
    $neg = 0;
    for ($i=0;$i<count($tab);$i++) {
        if ($tab[$i] < 0) {
            $neg++;
        }    
    }
    return $neg;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['question10'])) {
    $val = isset($_POST['val'])? floatval($_POST['val']) : 0;

    $_SESSION['valeurs'][] = $val;
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
    <h2>Les sous-programmes Procédures & Fonctions 2</h2>
    <form action="" method="post">
        <input class="reset" type="image" name="reset" src="../images/rotate-left-solid.svg">
    </form>
    <div class="container">
        <h3>Question 1: Calcul de Factorielle, m1</h3>
        <form action="" method="post">
            <input type="hidden" name="question1">
            <label class="form-label" for="factorielle">Entrez un nombre:</label><br>
            <input class="zone" name="factor" type="number" required><br>
            <input class="btn-success" type="submit" value="Calculer">
        </form>
        <?php if (isset($factor)): ?>
            <p>La factorielle de <?= $factor ?> est <?= $result?></p>
        <?php endif; ?>
    </div>
    <div class="container">
        <h3>Question 2: Calcul de la factorielle, m2</h3>
        <form action="" method="post">
            <input type="hidden" name="question2">
            <label class="form-label" for="fact">Entrez un nombre:</label><br>
            <input class="zone" type="number" name="fact" required><br>
            <input class="btn-success" type="submit" value="Calculer">
        </form>
        <?php if(isset($fact)): ?>
            <p>La factorielle de <?= $fact?> est <?= factorielle2($fact)?></p>
        <?php endif; ?>
    </div>
    <div class="container">
        <h3>Question 3: Calculs factorielles</h3>
        <form action="" method="post">
            <input type="hidden" name="question3">
            <label class="form-label" for="value1">Entrez une première valeur:</label><br>
            <input class="zone" type="number" name="value1" required><br>
            <label class="form-label" for="value2">Entrez une seconde valeur:</label><br>
            <input class="zone" type="number" name="value2" required><br>
            <input class="btn-success" type="submit" value="Calculer">
        </form>
        <?php if(isset($value1) && isset($value2)): ?>
            <p>La factorielle de la première valeur est <?=factorielle($value1,$value1)?></p>
            <p>La factorielle de la seconde valeur est <?=factorielle2($value2)?></p>
        <?php endif; ?>
    </div>
    <div class="container">
        <h3>Question 4: Convertir Euro en Dollars et inversement</h3>
        <form action="" method="post">
            <input type="hidden" name="question4">
            <label class="form-label" for="montant">Entrez un montant à convertir: </label><br>
            <input class="zone" type="number" name="montant" step="0.1" required><br>
            <label class="form-label" for="monnaie">Entrez la monnaie du montant:</label>
            <select name="monnaie">
                <option value="$">$</option>
                <option value="€">€</option>
            </select><br>
            <input class="btn-success" type="submit" value="Convertir">
        </form>
        <?php if(isset($montant) && isset($monnaie)): ?>
            <p>Le montant en <?= $monnaie?> est de <?= convertir($montant,$monnaie) . $monnaie?></p>
        <?php endif; ?>
    </div>
    <div class="container">
        <h3>Question 6: Ajouter une nouvelle capitale à la liste</h3>
        <form action="" method="post">
                <input type="hidden" name="question6bis">
                <label class="form-label" for="pays">Entrez un pays:</label><br>
                <input class="zone" type="text" name="pays" required><br>
                <label class="form-label" for="capitale">Entrez une capitale: </label><br>
                <input class="zone" type="text" name="capitale" required><br>
                <input class="btn-success" type="submit" value="Ajouter cette capitale">
        </form>
        <?php if(isset($pays) && isset($capitale)): ?>
            <p>Ces informations ont bien été ajoutés</p>
        <?php endif; ?>
    </div>
    <div class="container">
        <h3>Renvoie la capitale</h3>
        <form action="" method="post">
                <input type="hidden" name="question6">
                <label class="form-label" for="countrie">Entrez un pays:</label><br>
                <input class="zone" type="text" name="countrie" required><br>
                <input class="btn-success" type="submit" value="Chercher la capitale">
        </form>
        <?php if(isset($countrie)): ?>
            <p><?=recherche($countrie)?></p>
        <?php endif; ?>
    </div>
    <div class="container">
        <h3>Question 8: Calcul le cube d'un nombre</h3>
        <form action="" method="post">
                <input type="hidden" name="question8">
                <label class="form-label" for="nombre">Entrez un nombre:</label><br>
                <input class="zone" type="number" name="nombre" required><br>
                <input class="btn-success" type="submit" value="Calculer son cube">
        </form>
        <?php if(isset($nombre)): ?>
            <p>Ce nombre au cube est <?=cube($nombre)?></p>
        <?php endif; ?>
    </div>
    <div class="container">
        <h3>Question 9: Calcul des puissances</h3>
        <form action="" method="post">
                <input type="hidden" name="question9">
                <label class="form-label" for="nbr">Entrez un nombre:</label><br>
                <input class="zone" type="number" name="nbr" required><br>
                <input class="btn-success" type="submit" value="Calculer">
        </form>
        <?php if(isset($nbr)): ?>
            <p>Les résultats sont:</p>
            <?php for ($i=1;$i<4;$i++):?>
                <p><?=cube($nbr) ** $i?></p>
            <?php endfor;?>
        <?php endif; ?>
    </div>
    <div class="container">
        <h3>Question 10-11: Calcul le signe des nombres</h3>
        <form action="" method="post">
                <input type="hidden" name="question10">
                <label class="form-label" for="val">Entrez un nombre:</label><br>
                <input class="zone" type="number" name="val" required><br>
                <input class="btn-success" type="submit" value="Calculer les signes">
        </form>
        <?php if(isset($val)): ?>
            <p>Il y a <?= parcours_pos($_SESSION['valeurs'])?> nombres positifs et <?= parcours_neg($_SESSION['valeurs'])?> nombres négatifs</p>
        <?php endif; ?>
    </div>
    <button id="scrollToTopBtn" onclick="scrollToTop()"><img src="../images/arrow-up-solid.svg" id="icontotop"></button>
</body>
</html>
