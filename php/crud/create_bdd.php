<?php

// Informations de connexion à PhpMyAdmin
$host1 = "localhost";
$user1 = "root";
$password1 = "";


// On lance la connexion
$link = mysqli_connect($host1, $user1, $password1);

// Vérifier la connexion
if (!$link) {
    die("Erreur de connexion : " . mysqli_connect_error());
}

// Nom de la base de données à créer
$databaseName = "chaussures";

// Création de la BDD
$sql = "CREATE DATABASE IF NOT EXISTS $databaseName";

// On exécute la requête de création de base de données
if (mysqli_query($link, $sql)) {
    echo "Création réussie de la base de données '$databaseName'";
} else {
    echo "Erreur lors de la création de la base de données : " . mysqli_error($link);
}

// Fermer la connexion initiale
mysqli_close($link);

// Nouvelle connexion à la base de données créée
$link = mysqli_connect($host1, $user1, $password1, $databaseName);

// Vérifier la nouvelle connexion
if (!$link) {
    die("Erreur de connexion à la nouvelle base de données : " . mysqli_connect_error());
}

// Utiliser la nouvelle base de données
// Vous pouvez maintenant effectuer des opérations sur la base de données '$databaseName'

// Fermer la nouvelle connexion
mysqli_close($link);
?>
