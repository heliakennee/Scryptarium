<?php
session_start();

if (isset($_POST['reset'])) {
    session_destroy(); 
    session_start(); 
}
if (!isset($_SESSION['grille'])) {
    $_SESSION['grille'] = [
        ['0','1','2','3','4','5','6','7','8','9','10'],
        ['1', ' ','⛀', ' ', '⛀', ' ', '⛀', ' ', '⛀', ' ','⛀'],
        ['2', '⛀', ' ', '⛀', ' ', '⛀', ' ', '⛀',' ','⛀', ' '],
        ['3', ' ','⛀', ' ', '⛀', ' ', '⛀', ' ', '⛀', ' ','⛀'],
        ['4', '⛀', ' ', '⛀', ' ', '⛀', ' ', '⛀',' ','⛀', ' '],
        ['5', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ',' ',' '],
        ['6', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ',' ',' '],
        ['7', ' ', '⛂', ' ', '⛂', ' ', '⛂', ' ', '⛂',' ','⛂'],
        ['8', '⛂', ' ', '⛂', ' ', '⛂', ' ', '⛂', ' ','⛂',' '],
        ['9', ' ', '⛂', ' ', '⛂', ' ', '⛂', ' ', '⛂',' ','⛂'],
        ['10', '⛂', ' ', '⛂', ' ', '⛂', ' ', '⛂', ' ','⛂',' ']    
    ];
}

if (!isset($_SESSION['error'])) {
    $_SESSION['error'] = 0;
}


//Question 1
function remplir($x,$y,$val) {
    $tableau = [];
    // Boucle pour remplir le tableau avec des zéros
    for ($i = 0; $i < $y; $i++) {
        $ligne = []; // Créer une nouvelle ligne
        for ($j = 0; $j < $x; $j++) {
            $ligne[] = $val; // Ajouter un zéro dans la ligne
        }
        $tableau[] = $ligne; // Ajouter la ligne au tableau
    }
    return $tableau;
}
$tableau = remplir(13,6,0);

//Question 6
function remplirchiffre($x,$y) {
    $tableau = [];
    // Boucle pour remplir le tableau avec des zéros
    for ($i = 0; $i < $y; $i++) {
        $ligne = []; // Créer une nouvelle ligne
        for ($j = 0; $j < $x; $j++) {
            $ligne[] = $j; // Ajouter un zéro dans la ligne
        }
        $tableau[] = $ligne; // Ajouter la ligne au tableau
    }
    return $tableau;
}
$tab = remplirchiffre(12,8);

function maximum($tableau) {
    $max = 0;
    for ($i = 0; $i < count($tableau); $i++) {
        for ($j = 0; $j < count($tableau[0]); $j++) {
            if ($tableau[$i][$j] > $max) {
                $max = $tableau[$i][$j];
            }
        }
    }
    return $max;
}

//Question 7
function deplacement($deplacement, $x, $y) {
    switch ($deplacement) {
        case '↖️':
            if ($_SESSION['grille'][$y-1][$x-1] != ' ') {
                $_SESSION['error'] = 1;
            } elseif ($_SESSION['grille'][$y][$x] == ' ') {
                $_SESSION['error'] = 2;
            } else {
                $_SESSION['grille'][$y-1][$x-1] = $_SESSION['grille'][$y][$x];
                $_SESSION['grille'][$y][$x] = ' ';
            }
            break;
        case '↗️':
            if ($_SESSION['grille'][$y-1][$x+1] != ' ') {
                $_SESSION['error'] = 1;
            } elseif ($_SESSION['grille'][$y][$x] == ' ') {
                $_SESSION['error'] = 2;
            } else {
                $_SESSION['grille'][$y-1][$x+1] = $_SESSION['grille'][$y][$x];
                $_SESSION['grille'][$y][$x] = ' ';
            }
            break;
        case '↙️':
            if ($_SESSION['grille'][$y+1][$x-1] != ' ') {
                $_SESSION['error'] = 1;
            } elseif ($_SESSION['grille'][$y][$x] == ' ') {
                $_SESSION['error'] = 2;
            } else {
                $_SESSION['grille'][$y+1][$x-1] = $_SESSION['grille'][$y][$x];
                $_SESSION['grille'][$y][$x] = ' ';
            }
            break;
        case '↘️':
            if ($_SESSION['grille'][$y+1][$x+1] != ' ') {
                $_SESSION['error'] = 1;
            } elseif ($_SESSION['grille'][$y][$x] == ' ') {
                $_SESSION['error'] = 2;
            } else {
                $_SESSION['grille'][$y+1][$x+1] = $_SESSION['grille'][$y][$x];
                $_SESSION['grille'][$y][$x] = ' ';
            }
            break;
    }
}   


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['move'])) {
    $x = (int) $_POST['x'];
    $y = (int) $_POST['y'];
    $deplacement = $_POST['move'];
    deplacement($deplacement, $x, $y);
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
    <h2>Les tableaux 3</h2>
    <form action="" method="post">
        <input class="reset" type="image" name="reset" src="../images/rotate-left-solid.svg">
    </form>
    <div class="container">
        <h3>Question 1: Remplir un tableau de 0</h3>
        <?php foreach ($tableau as $ligne): ?>
            <p><?=implode(' ', $ligne) . PHP_EOL ;?></p>
        <?php endforeach; ?>
    </div>
    <div class="container">
        <h3>Question 2: Analyse d'algorithme 1</h3>
        <p class="algo">
            Tableau X(1, 2) en Entier
            Variables i, j, val en Entier <br>
            Début <br>
            Val ← 1 <br>
            Pour i ← 0 à 1 <br>
            Pour j ← 0 à 2 <br>
            X(i, j) ← Val <br>
            Val ← Val + 1 <br>
            j Suivant <br>
            i Suivant <br>
            Pour i ← 0 à 1 <br>
            Pour j ← 0 à 2 <br>
            Ecrire X(i, j) <br>
            j Suivant <br>
            i Suiva <br>
        </p>
        <p>Cet algorithme semble incrémenter les valeurs d'un graphe de 1</p>
    </div>
    <div class="container">
        <h3>Question 3: Analyse d'algorithme 2</h3>
        <p class="algo">
            Tableau X(1, 2) en Entier <br>
            Variables i, j, val en Entier <br>
            Début <br>
            Val ← 1 <br>
            Pour i ← 0 à 1 <br>
            Pour j ← 0 à 2 <br>
            X(i, j) ← Val <br>
            Val ← Val + 1 <br>
            j Suivant <br>
            i Suivant <br>
            Pour j ← 0 à 2 <br>
            Pour i ← 0 à 1 <br>
            Ecrire X(i, j) <br>
            i Suivant <br>
            j Suiv <br>
        </p>
        <p>Cet algorithme semble attribuer des valeurs croisantes aux valeurs du graphe</p>
    </div>
    <div class="container">
        <h3>Question 4: Analyse d'algorithme 3</h3>
        <p class="algo">
            Tableau T(3, 1) en Entier <br>
            Variables k, m, en Entier <br>
            Début <br>
            Pour k ← 0 à 3 <br>
            Pour m ← 0 à 1 <br>
            T(k, m) ← k + m <br>
            m Suivant <br>
            k Suivant <br>
            Pour k ← 0 à 3 <br>
            Pour m ← 0 à 1 <br>
            Ecrire T(k, m) <br>
            m Suivant <br>
            k Suiva <br>
        </p>
        <p>Attribue la somme des coordonnées x et y à la valeur correspondante</p>
    </div>
    <div class="container">
        <h3>Question 5: Analyse d'algorithme 4</h3>
        <p class="algo">
            Tableau T(3, 1) en Entier <br>
            Variables k, m, en Entier <br>
            Début <br>
            Pour k ← 0 à 3 <br>
            Pour m ← 0 à 1 <br> 
            T(k, m) ← 2 * k + (m + 1)  <br>
            m Suivant <br>
            k Suivant <br>
            Pour k ← 0 à 3 <br>
            Pour m ← 0 à 1 <br>
            Ecrire T(k, m) <br>
            m Suivant <br>
            k Suivant <br>
            Fin <br>
        </p>
        <p>Attribue aux valeurs le résultat d'un calcul fait avec les coordonnées: <br> 2 * y + (x + 1)</p>
        <p class="algo">
            Tableau T(3, 1) en Entier <br>
            Variables k, m, en Entier <br>
            Début <br>
            Pour k ← 0 à 3 <br>
            Pour m ← 0 à 1 <br> 
            T(k, m) ← (k + 1) + 4 * m <br>
            m Suivant <br>
            k Suivant <br>
            Pour k ← 0 à 3 <br>
            Pour m ← 0 à 1 <br>
            Ecrire T(k, m) <br>
            m Suivant <br>
            k Suivant <br>
            Fin <br>
        </p>
        <p>Attribue aux valeurs le résultat d'un calcul fait avec les coordonnées: <br> (y + 1) + 4 * x</p>
    </div>
    <div class="container">
        <h3>Question 6: Recherche du maximum</h3>
        <?php foreach ($tab as $ligne): ?>
            <p><?=implode(' ', $ligne) . PHP_EOL ;?></p>
        <?php endforeach; ?>
        <p>Le maximum de ce tableau est <?=maximum($tab)?></p>
    </div>
    <div class="container">
        <h3>Question 7: Jeu de dame</h3><br>
        <form action="" method="post">
            <label class="form-label" for="x">Entrez l'abscisse du point :</label><br>
            <input class="zone" type="number" name="x" value="<?= htmlspecialchars($_POST['x'] ?? '') ?>" required><br>
            <label class="form-label" for="y">Entrez l'ordonnée du point :</label><br>
            <input class="zone" type="number" name="y" value="<?= htmlspecialchars($_POST['y'] ?? '') ?>" required><br>
            <br>
            <button class="deplacement" type="submit" name="move" value="↖️">↖️</button>
            <button class="deplacement" type="submit" name="move" value="↗️">↗️</button><br>
            <button class="deplacement" type="submit" name="move" value="↙️">↙️</button>
            <button class="deplacement" type="submit" name="move" value="↘️">↘️</button>
        </form>
        <?php if($_SESSION['error'] == 1): ?>
            <p>Déplacement invalide</p>
        <?php elseif($_SESSION['error'] == 2): ?>
            <p>Case vide</p>
        <?php $_SESSION['error'] = 0; ?>
        <?php endif; ?>
        <table class="damier">
            <?php foreach ($_SESSION['grille'] as $i => $ligne): ?>
                <tr>
                    <?php foreach ($ligne as $j => $cell): ?>
                        <?php 
                            // Ignorer la première ligne et la première colonne d'index
                            if ($i == 0 || $j == 0): 
                                $class = "index-cell";
                            else:
                                // Déterminer la classe en fonction des coordonnées
                                $class = (($i + $j) % 2 == 1) ? "white-cell" : "black-cell";
                                if (isset($x) && isset($y) && $i == $y && $j == $x) {
                                    $class = 'selec';
                                }
                            endif;
                        ?>
                        <td class="<?= $class ?>">
                            <?= htmlspecialchars($cell) ?>
                        </td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <button id="scrollToTopBtn" onclick="scrollToTop()"><img src="../images/arrow-up-solid.svg" id="icontotop"></button>
</body>
</html>