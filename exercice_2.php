<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercices PHP Avancés</title>
</head>
<body>
    <h1>Exercices PHP Avancés</h1>

    
    <h2>1. Informations sur les employés et salaire moyen</h2>
    <?php
    $employes = [
        ['nom' => 'Alice', 'poste' => 'Développeur', 'salaire' => 4000],
        ['nom' => 'Bob', 'poste' => 'Designer', 'salaire' => 3500],
        ['nom' => 'Charlie', 'poste' => 'Manager', 'salaire' => 4500],
        ['nom' => 'Diana', 'poste' => 'Consultant', 'salaire' => 3000],
        ['nom' => 'Eve', 'poste' => 'Analyste', 'salaire' => 3800],
    ];

    function calculerSalaireMoyen($employes) {
        $totalSalaire = array_sum(array_column($employes, 'salaire'));
        $moyenne = $totalSalaire / count($employes);
        echo "Salaire moyen : " . $moyenne . " DH<br>";
    }

    calculerSalaireMoyen($employes);
    ?>


    <h2>2. Recherche d'un employé</h2>
    <form method="POST">
        Nom de l'employé : <input type="text" name="nomRecherche"><br>
        <button type="submit">Rechercher</button>
    </form>

    <?php
    if (isset($_POST['nomRecherche'])) {
        $nomRecherche = htmlspecialchars($_POST['nomRecherche']);
        $trouve = false;

        foreach ($employes as $employe) {
            if (strtolower($employe['nom']) === strtolower($nomRecherche)) {
                echo "Employé trouvé : Nom : " . $employe['nom'] . ", Poste : " . $employe['poste'] . ", Salaire : " . $employe['salaire'] . " DH<br>";
                $trouve = true;
                break;
            }
        }
        if (!$trouve) echo "Employé non trouvé.<br>";
    }
    ?>

   
    <h2>3. Formulaire de connexion</h2>
    <form method="POST">
        Email : <input type="email" name="email"><br>
        Mot de passe : <input type="password" name="password"><br>
        <button type="submit">Se connecter</button>
    </form>

    <?php
    $utilisateurs = [
        ['email' => 'user1@example.com', 'password' => 'password1'],
        ['email' => 'user2@example.com', 'password' => 'password2'],
    ];

    if (isset($_POST['email'], $_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $connexionReussie = false;

        foreach ($utilisateurs as $utilisateur) {
            if ($utilisateur['email'] === $email && $utilisateur['password'] === $password) {
                echo "Connexion réussie ! Bienvenue $email<br>";
                $connexionReussie = true;
                break;
            }
        }
        if (!$connexionReussie) echo "Identifiants incorrects.<br>";
    }
    ?>

    
    <h2>4. Système de panier</h2>
    <?php
    $panier = [
        ['nom' => 'Produit 1', 'quantite' => 2, 'prix' => 100],
        ['nom' => 'Produit 2', 'quantite' => 1, 'prix' => 200],
    ];

    $total = 0;
    foreach ($panier as $produit) {
        $total += $produit['quantite'] * $produit['prix'];
        echo "Nom : " . $produit['nom'] . ", Quantité : " . $produit['quantite'] . ", Prix unitaire : " . $produit['prix'] . " DH<br>";
    }
    echo "Total du panier : " . $total . " DH<br>";
    ?>

   
    <h2>5. Soumettre un commentaire</h2>
    <form method="POST">
        Commentaire : <textarea name="commentaire"></textarea><br>
        <button type="submit">Soumettre</button>
    </form>

    <?php
    session_start();
    if (!isset($_SESSION['commentaires'])) $_SESSION['commentaires'] = [];

    if (isset($_POST['commentaire'])) {
        $_SESSION['commentaires'][] = ['texte' => htmlspecialchars($_POST['commentaire']), 'horodatage' => date('Y-m-d H:i:s')];
    }

    echo "<h3>Commentaires soumis :</h3>";
    foreach ($_SESSION['commentaires'] as $commentaire) {
        echo "[" . $commentaire['horodatage'] . "] " . $commentaire['texte'] . "<br>";
    }
    ?>

    
    <h2>6. Ville la plus chaude</h2>
    <?php
    $villes = [
        'Casablanca' => 25,
        'Marrakech' => 30,
        'Fès' => 28,
        'Rabat' => 22,
        'Tanger' => 20,
    ];

    $villeMaxTemp = array_keys($villes, max($villes))[0];
    echo "La ville la plus chaude est $villeMaxTemp avec " . $villes[$villeMaxTemp] . "°C.<br>";
    ?>

    
    <h2>7. Charger un fichier CSV</h2>
    <form method="POST" enctype="multipart/form-data">
        Fichier CSV : <input type="file" name="csvFile"><br>
        <button type="submit">Charger</button>
    </form>

    <?php
    if (isset($_FILES['csvFile'])) {
        $file = fopen($_FILES['csvFile']['tmp_name'], 'r');
        echo "<table border='1'><tr><th>Nom</th><th>Prix</th><th>Quantité</th></tr>";
        while ($row = fgetcsv($file)) {
            echo "<tr><td>{$row[0]}</td><td>{$row[1]}</td><td>{$row[2]}</td></tr>";
        }
        fclose($file);
        echo "</table>";
    }
    ?>

    
    <h2>8. Sélectionner plusieurs produits</h2>
    <form method="POST">
        <label><input type="checkbox" name="produits[]" value="Produit 1|100"> Produit 1 (100 DH)</label><br>
        <label><input type="checkbox" name="produits[]" value="Produit 2|200"> Produit 2 (200 DH)</label><br>
        <label><input type="checkbox" name="produits[]" value="Produit 3|150"> Produit 3 (150 DH)</label><br>
        <button type="submit">Valider</button>
    </form>

    <?php
    if (isset($_POST['produits'])) {
        $produitsSelectionnes = $_POST['produits'];
        $total = 0;

        echo "Produits sélectionnés :<br>";
        foreach ($produitsSelectionnes as $produit) {
            [$nom, $prix] = explode('|', $produit);
            echo "$nom : $prix DH<br>";
            $total += $prix;
        }
        echo "Prix total : $total DH<br>";
    }
    ?>

</body>
</html>