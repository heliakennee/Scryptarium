<?php
session_start();

if (isset($_POST['reset'])) {
    session_destroy(); 
    session_start(); 
}

$_SESSION["lst"] = $_SESSION["lst"] ?? [];
$_SESSION["cpt"] = $_SESSION["cpt"] ?? 0;
$_SESSION['sar'] = $_SESSION['sar'] ?? [];
$_SESSION['erreur'] = $_SESSION['erreur'] ?? false;
$_SESSION['X'] = $_SESSION['X'] ?? 0;
$_SESSION['Y'] = $_SESSION['Y'] ?? 0;
$_SESSION['max'] = $_SESSION['max'] ?? 0;
$_SESSION['compteur'] = $_SESSION['compteur'] ?? 0;

// Traitement des questions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Question 1
    if (isset($_POST['question1'])) {
        $q1 = filter_input(INPUT_POST, 'q1', FILTER_VALIDATE_FLOAT);
    }

    // Question 2
    if (isset($_POST['question2'])) {
        $q2 = filter_input(INPUT_POST, 'q2', FILTER_VALIDATE_FLOAT);
    }

    // Question 3
    if (isset($_POST['question3'])) {
        $q3 = filter_input(INPUT_POST, 'q3', FILTER_VALIDATE_FLOAT);
    }

    // Question 4
    if (isset($_POST['question4'])) {
        $q4 = filter_input(INPUT_POST, 'q4', FILTER_VALIDATE_FLOAT);
    }

    // Question 5
    if (isset($_POST['question5'])) {
        $q5 = filter_input(INPUT_POST, 'q5', FILTER_VALIDATE_FLOAT);
        $somme = ($q5 * ($q5 + 1)) / 2; // Utiliser la formule de la somme
    }

    // Question 6
    if (isset($_POST['question6'])) {
        $q6 = filter_input(INPUT_POST, 'q6', FILTER_VALIDATE_FLOAT);    
        $factorielle = 1;
        for ($i = 1; $i <= $q6; $i++) {
            $factorielle *= $i;
        }
    }

    // Question 7
    if (isset($_POST['question7'])) {
        $q7 = filter_input(INPUT_POST, 'q7', FILTER_VALIDATE_FLOAT);
        if ($_SESSION['max'] < $q7) {
            $_SESSION['max'] = $q7;
        }
        $_SESSION['compteur']++;
    }

    // Question 8
    function max_tableau($tab) {
        $max = 0;
        for ($i = 0; $i < count($tab); $i++) { // corrected condition
            if ($tab[$i] > $max) {
                $max = $tab[$i];
            }
        }
        return $max;
    }

    if (isset($_POST['question8'])) {
        $nombre = filter_input(INPUT_POST, 'valeur', FILTER_VALIDATE_FLOAT);
        if ($nombre >= 0) {
            $_SESSION["lst"][] = $nombre;
            $_SESSION['cpt']++;
            $_SESSION["max"] = max_tableau($_SESSION["lst"]);
        } else {
            echo "<div class='alert alert-danger'>Veuillez entrer une valeur positive.</div>";
        }
    }

    // Question 9
    function somme_à_rendre($valeur) {
        $pieces = [50, 20, 10, 5, 2, 1]; // Denominations in Euros
        $result = [];
        foreach ($pieces as $piece) {
            while ($valeur >= $piece) {
                $result[] = $piece;
                $valeur -= $piece;
            }
        }
        return $result;
    }

    if (isset($_POST['question9'])) {
        $prix = filter_input(INPUT_POST, 'prix', FILTER_VALIDATE_FLOAT);
        $payé = filter_input(INPUT_POST, 'payé', FILTER_VALIDATE_FLOAT);

        if ($payé - $prix > 0) {
            $_SESSION['sar'] = somme_à_rendre($payé - $prix);
            $_SESSION['erreur'] = false;
        } elseif ($payé - $prix == 0) {
            $_SESSION['sar'] = [0];
            $_SESSION['erreur'] = false;
        } else {
            $_SESSION['erreur'] = true;
        }
    }

    // Question 10
    function permutations($n, $k) {
        $result = 1;
        for ($i = $n; $i > ($n - $k); $i--) {
            $result *= $i;
        }
        return $result;
    }

    function combinaisons($n, $k) {
        return permutations($n, $k) / permutations($k, $k);
    }

    if (isset($_POST['question10'])) {
        $joué = filter_input(INPUT_POST, 'joué', FILTER_VALIDATE_FLOAT);
        $partant = filter_input(INPUT_POST, 'partant', FILTER_VALIDATE_FLOAT);

        if ($joué > 0 && $partant > 0 && $joué <= $partant) {
            $_SESSION['X'] = permutations($partant, $joué); 
            $_SESSION['Y'] = combinaisons($partant, $joué); 
        } else {
            $_SESSION['X'] = 0;
            $_SESSION['Y'] = 0;
        }
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
    <h2>Structures répétitives 2</h2>
    <form action="" method="post">
        <input class="reset" type="image" name="reset" src="../images/rotate-left-solid.svg">
    </form>
    <div class="container">
        <h3>Exercice 1:</h3>
        <form action="" method="post">
            <input type="hidden" name="question1">
            <label for="q1">Entrez une valeur entre 1 et 3:</label><br>
            <input class="zone" type="number" name="q1" required><br>   
            <input class="btn-success" type="submit" value="Valider">
        </form>
        <?php if (isset($q1)): ?>
            <?php if ($q1 > 0 && $q1 < 4): ?>
                <p>La valeur <?=$q1?> est correcte</p>
            <?php else : ?>
                <p>La valeur <?=$q1?> est incorrecte</p>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    <div class="container">     
        <h3>Exercice 2:</h3>
        <form action="" method="post">
            <input type="hidden" name="question2">
            <label for="q2">Entrez une valeur:</label><br>
            <input class="zone" type="number" name="q2" required><br>
            <input class="btn-success" type="submit" value="Valider">
        </form>
        <?php if (isset($q2)): ?>
            <?php if ($q2 > 9 && $q2 < 21): ?>
                <p>La valeur <?=$q2?> convient</p>
            <?php elseif ($q2 < 10) : ?>
                <p> Plus grand !</p>
            <?php elseif ($q2 > 20): ?>
                <p>Plus petit !</p>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    <div class="container">  
        <h3>Exercice 3:</h3>
        <form action="" method="post">
            <input type="hidden" name="question3">
            <label for="q3">Entrez une valeur:</label><br>
            <input class="zone" type="number" name="q3" required><br>
            <input class="btn-success" type="submit" value="Valider">
        </form>
        <?php if (isset($q3)): ?>
            <?php for ($i=1;$i<11;$i++): ?>
                <p><?=$q3+$i?></p>
            <?php endfor; ?>

        <?php endif; ?>
    </div>
    <div class="container">  
        <h3>Exercice 4:</h3>
        <form action="" method="post">
            <input type="hidden" name="question4">
            <label for="q4">Entrez une valeur:</label><br>
            <input class="zone" type="number" name="q4" required><br>
            <input class="btn-success" type="submit" value="Valider">
        </form>
        <?php if (isset($q4)): ?>
            <p>Table de <?=$q4?></p><br>
            <?php for($i=0;$i<11;$i++):?>
                <p><?=$q4?> x <?=$i?> = <?= $q4 * $i?></p><br>
            <?php endfor; ?>
        <?php endif; ?>
    </div>
    <div class="container">  
        <h3>Exercice 5:</h3>
        <form action="" method="post">
            <input type="hidden" name="question5">
            <label for="q5">Entrez une valeur:</label><br>
            <input class="zone" type="number" name="q5" required><br>
            <input class="btn-success" type="submit" value="Valider">
        </form>
        <?php if (isset($q5)): ?>
            <p>La somme est de <?=$somme?></p>
        <?php endif; ?>  
    </div>      
    <div class="container">  
        <h3>Exercice 6:</h3>
        <form action="" method="post">
            <input type="hidden" name="question6">
            <label for="q6">Entrez une valeur:</label><br>
            <input class="zone" type="number" name="q6" required><br>
            <input class="btn-success" type="submit" value="Valider">
        </form>
        <?php if (isset($q6)): ?>
            <p>La factorielle est <?=$q6?></p>
        <?php endif; ?>
    </div>
    <div class="container">  
        <h3>Exercice 7:</h3>
        <form action="" method="post">
            <input type="hidden" name="question7">
            <label for="q7">Entrez le nombre:</label><br>
            <input class="zone" type="number" name="q7" required><br>
            <input class="btn-success" type="submit" value="Valider">
        </form>
        <?php if (isset($q7) && $_SESSION['compteur'] == 20): ?>
            <p>Le plus grand de ces nombres est <?=$_SESSION['max']?></p>
        <?php endif; ?>
    </div>   
    <div class="container">  
        <h3>Exercice 8:</h3>
        <!-- Formulaire pour question 8 -->
        <form action="" method="post">
            <input type="hidden" name="question8">
            <label for="valeur">Entrez une valeur:</label><br>
            <input class="zone" type="number" name="valeur" required><br>
            <input class="btn-success" type="submit" value="Ajouter la valeur">
        </form>
        <?php if ($_SESSION['cpt'] > 0): ?>
            <p>La valeur la plus élevée est: <?= $_SESSION['max'] ?></p>
        <?php endif; ?>
    </div>   
    <div class="container">  
        <h3>Exercice 9:</h3>
        <!-- Formulaire pour question 9 -->
        <form action="" method="post">
            <input type='hidden' name="question9">
            <label for="prix">Entrez le prix:</label><br>
            <input class="zone" type="number" name="prix" required><br>
            <label for="payé">Entrez la somme payée:</label><br>
            <input class="zone" type="number" name="payé" required><br>
            <input class="btn-success" type="submit" value="Calculer la somme à rendre">
        </form>
        <?php if (!$_SESSION['erreur']): ?>
            <?php if (isset($_SESSION['sar']) && !empty($_SESSION['sar'])): ?>
                <p>La somme à rendre est :</p>
                <ul>
                    <?php foreach ($_SESSION['sar'] as $piece): ?>
                        <li><?= htmlspecialchars($piece) ?>€</li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        <?php else: ?>
            <div class="alert alert-danger">
                <p>Vous n'avez pas donné suffisamment de monnaie.</p>
            </div>
        <?php endif; ?>
    </div>
    <div class="container">  
        <h3>Exercice 10:</h3>
        <!-- Formulaire pour la question 10 -->
        <form  action="" method="post">
            <input type="hidden" name="question10">
            <label for="joué">Quel nombre de chevaux joués ?</label><br>
            <input class="zone" type="number" name="joué" required><br>
            <label for="partant">Combien y a t-il de chevaux dans la course ?</label><br>
            <input class="zone" type="number" name="partant" required><br>
            <input class="btn-success" type="submit" value="Calculer les chances de gagner">
        </form>
        <?php if ($_SESSION['X'] > 0 && $_SESSION['Y'] > 0): ?>
            <p> Vous avez une chance sur <?= $_SESSION['X'] ?> de gagner dans l'ordre.</p>
            <p> Vous avez une chance sur <?= $_SESSION['Y'] ?> de gagner dans le désordre.</p>
        <?php endif; ?>
    </div>
    <button id="scrollToTopBtn" onclick="scrollToTop()"><img src="../images/arrow-up-solid.svg" id="icontotop"></button>
</body>
</html>