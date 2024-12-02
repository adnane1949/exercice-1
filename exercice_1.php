<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercices PHP</title>
</head>
<body>
    <h1>Exercices PHP</h1>

    <h2>1. Tableau associatif pour un étudiant</h2>
    <?php
    $etudiant = [
        'nom' => 'Adnane',
        'prenom' => 'Habbaz',
        'matricule' => '20241234'
    ];

    echo "Nom : " . $etudiant['nom'] . "<br>";
    echo "Prénom : " . $etudiant['prenom'] . "<br>";
    echo "Matricule : " . $etudiant['matricule'] . "<br>";
    ?>

    <h2>2. Ajouter et modifier la clé 'note'</h2>
    <?php
    $etudiant['note'] = 15;
    $etudiant['note'] = 17;

    echo "Note : " . $etudiant['note'] . "<br>";
    ?>

    <h2>3. Parcourir et afficher des produits</h2>
    <?php
    $produits = [
        ['nom' => 'Produit 1', 'prix' => 100],
        ['nom' => 'Produit 2', 'prix' => 200],
        ['nom' => 'Produit 3', 'prix' => 150],
    ];

    foreach ($produits as $produit) {
        echo "Nom : " . $produit['nom'] . ", Prix : " . $produit['prix'] . " DH<br>";
    }
    ?>

    <h2>4. Scores des étudiants</h2>
    <?php
    $scores = [
        'Etudiant 1' => 14,
        'Etudiant 2' => 16,
        'Etudiant 3' => 12,
        'Etudiant 4' => 18,
        'Etudiant 5' => 10,
    ];

    $moyenne = array_sum($scores) / count($scores);
    echo "Moyenne des scores : " . $moyenne . "<br>";
    ?>

    <h2>5. Tri des pays par population</h2>
    <?php
    $pays = [
        'Maroc' => 49000000,
        'France' => 67000000,
        'Italie' => 60000000,
        'Espagne' => 47000000,
    ];

    arsort($pays);

    foreach ($pays as $nom => $population) {
        echo "Pays : $nom, Population : $population<br>";
    }
    ?>

    <h2>6. Formulaire pour nom et âge</h2>
    <form method="POST">
        Nom : <input type="text" name="nom"><br>
        Âge : <input type="number" name="age"><br>
        <button type="submit">Soumettre</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nom']) && isset($_POST['age'])) {
        $nom = htmlspecialchars($_POST['nom']);
        $age = (int) $_POST['age'];

        if (filter_var($age, FILTER_VALIDATE_INT) && $age > 0) {
            echo "Bienvenue, $nom, vous avez $age ans !<br>";
        } else {
            echo "Erreur : l'âge doit être un entier supérieur à 0.<br>";
        }
    }
    ?>

    <h2>8. Couleur préférée</h2>
    <form method="POST">
        Couleur préférée :
        <select name="couleur">
            <option value="Rouge">Rouge</option>
            <option value="Vert">Vert</option>
            <option value="Bleu">Bleu</option>
        </select>
        <button type="submit">Soumettre</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['couleur'])) {
        $couleur = htmlspecialchars($_POST['couleur']);
        echo "Votre couleur préférée est : $couleur<br>";
    }
    ?>

    <h2>9. Somme de deux nombres</h2>
    <form method="GET">
        Nombre 1 : <input type="number" name="nombre1"><br>
        Nombre 2 : <input type="number" name="nombre2"><br>
        <button type="submit">Calculer</button>
    </form>

    <?php
    if (isset($_GET['nombre1']) && isset($_GET['nombre2'])) {
        $nombre1 = (int) $_GET['nombre1'];
        $nombre2 = (int) $_GET['nombre2'];
        $somme = $nombre1 + $nombre2;

        echo "La somme est : $somme<br>";
    }
    ?>
</body>
</html>