<?php
session_start();

if (isset($_POST['reset'])) {
    session_destroy(); 
    session_start(); 
}
if (!isset($_SESSION['notes'])) {
    $_SESSION['notes'] = [];
}
if (!isset($_SESSION['cpt'])) {
    $_SESSION['cpt'] = 0;
}
// Question 1
function remplir($tab) {
	for ($i=0;$i<7;$i++) {
		$tab[] = 0;
	}
	var_dump($tab);
}

//Question 2
$lst = ['a','e','i','o','u','y'];

//Question 3

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['question3'])) {
    $note = isset($_POST['note'])? $_POST['note'] : 0;

    $_SESSION['notes'][]=$note;
    $_SESSION['cpt']++; 
}


//Question 4
function carre($tab) {
	for ($i=0;$i<7;$i++) {
		$tab[] = $i**2;
	}
	var_dump($tab);
}

//Question 5

function question5($tab) {
	for ($i=1;$i<6;$i++) {
		$tab[]= $tab[$i-1]+2;
	}
	var_dump($tab);
}
function moyenne($tab) {
	$v = 0;
	for ($i=0;$i<count($tab);$i++) {
		$v+=$tab[$i];
	}
	return $v/count($tab);
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
    <h2>Les tableaux
    </h2>
    <form action="" method="post">
        <input class="reset" type="image" name="reset" src="../images/rotate-left-solid.svg">
    </form>
    <div class="container">
        <h3>Question 1: Tableau de 0</h3><br>
        <p><?= remplir([])?></p>
    </div>
    <div class="container">
        <h3>Question 2: Voyelles</h3><br>
        <p><?= var_dump($lst)?></p>
    </div>
    <div class="container">
        <h3>Question 3: Tableau de 9 notes </h3>
        <form action="" method="post">
            <input type="hidden" name="question3">
            <label class="form-label" for="note">Entrez une note : </label><br>
            <input class="zone" type="number" name="note" required><br>
            <input class="btn-success" type="submit" value="Valider note">
        </form>
        <?php if (count($_SESSION['notes'])==9): ?>
            <p><?=var_dump($_SESSION['notes'])?></p>
        <?php endif; ?>
    </div>
    <div class="container">
        <h3>Question 4: Analyse d'algorithme 1</h3>
        <p class="algo">
            Tableau Nb(5) en Entier <br>
            Variable i en Entier <br>
            Début <br>
            Pour i ← 0 à 5 <br>
            Nb(i) ← i * i <br>
            i suivant <br>
            Pour i ← 0 à 5 <br>
            Ecrire Nb(i) <br>
            i suivant <br>
            Fin <br>
        </p>
        <p>Cet algorithme semble stocker les carés des nombres de 0 à 5</p>
        <p><?= carre([])?></p>
    </div>
    <div class="container">
        <h3>Question 5: Analyse d'algorithme 2</h3>
        <p class="algo">
            Tableau N(6) en Entier <br>
            Variables i, k en Entier <br>
            Début <br>
            N(0) ← 1 <br>
            Pour k ← 1 à 6 <br>
            N(k) ← N(k-1) + 2 <br>
            k Suivant <br>
            Pour i ← 0 à 6 <br>
            Ecrire N(i) <br>
            i suivant <br>
            Fin <br>
        </p>
        <p><?= question5([])?></p>
    </div>
    <div class="container">
        <h3>Question 6: Analyse d'algorithme 3</h3>
        <p class="algo">Tableau Suite(7) en Entier <br>
            Variable i en Entier <br>
            Début <br>
            Suite(0) ← 1 <br>
            Suite(1) ← 1 <br>
            Pour i ← 2 à 7 <br>
            Suite(i) ← Suite(i-1) + Suite(i-2) <br>
            i suivant   <br>
            Pour i ← 0 à 7 <br>
            Ecrire Suite(i) <br>
            i suivant <br>
            Fin <br>
        </p>
        <p>Cet algorithme semble reproduire la suite de Fibonacci.</p>
    </div>
    <div class="container">
        <h3>Question 7: Moyenne des notes</h3>
        <form action="" method="post">
            <input type="hidden" name="question3">
            <label class="form-label" for="note">Entrez une note : </label><br>
            <input class="zone" type="number" name="note" required><br>
            <input class="btn-success" type="submit" value="Valider note">
        </form>
        <?php if (count($_SESSION['notes'])==9): ?>
            <p><?=moyenne($_SESSION['notes'])?></p>
        <?php endif; ?>
    </div>
    <button id="scrollToTopBtn" onclick="scrollToTop()"><img src="../images/arrow-up-solid.svg" id="icontotop"></button>
</body>
</html>