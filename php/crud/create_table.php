<?php

// On appelle le fichier de connexion à la BDD
require_once('./config.php');

// Vérification de la connexion à la base de données
if (!$link) {
    die("Erreur de connexion : " . mysqli_connect_error());
}

// Création de la table USERS (procédurale)
$sql1 = "CREATE TABLE IF NOT EXISTS users (
    id INT(6) unsigned auto_increment PRIMARY KEY,
    login VARCHAR(50) unique NOT NULL,
    mdp VARCHAR(150) NOT NULL,
    role VARCHAR(15) NOT NULL,
    isVerified bool null
)";

// On exécute la requête et on vérifie le résultat
if (!mysqli_query($link, $sql1)) {
    echo "Erreur de création : " . mysqli_error($link);
}

// Création de la table PRODUITS (procédurale)
$sql2 = "CREATE TABLE IF NOT EXISTS products(
    id INT(6) unsigned auto_increment PRIMARY KEY,
    category VARCHAR(50) NOT NULL,
    type VARCHAR(50) NOT NULL,
    img VARCHAR(255) NOT NULL,
    brand VARCHAR(50) NOT NULL,
    name VARCHAR(50) NOT NULL,
    color VARCHAR(50) NOT NULL,
    price INT(6) NOT NULL,
    ref VARCHAR(10) NOT NULL,
    description text NOT NULL
)";

// On exécute la requête et on vérifie le résultat
if (!mysqli_query($link, $sql2)) {
    echo "Erreur de création : " . mysqli_error($link);
}

// Création de la table CLIENTS (procédurale)
$sql3 = "CREATE TABLE IF NOT EXISTS clients (
    id INT(6) unsigned auto_increment PRIMARY KEY,
    nom VARCHAR(50) NOT  NULL,
    prenom VARCHAR(50) NOT NULL,
    tel VARCHAR(20) NOT NULL,
    adresse text NOT NULL,
    complement VARCHAR(50) NOT NULL,
    cp VARCHAR(20) NOT NULL,
    ville VARCHAR(50) NOT NULL,
    user_id INT(15) NOT NULL,
    CONSTRAINT FK_user_id FOREIGN KEY (user_id) REFERENCES users(id)
)";

// On exécute la requête et on vérifie le résultat
if (!mysqli_query($link, $sql3)) {
    echo "Erreur de création : " . mysqli_error($link);
}

// Création de la table CONTACT (procédurale)
$sql4 = "CREATE TABLE IF NOT EXISTS contact (
    id INT(6) unsigned auto_increment PRIMARY KEY,
    nom VARCHAR(50) NOT  NULL,
    mail VARCHAR(50) NOT NULL,
    sujet VARCHAR(50) NOT NULL,
    message text NOT NULL
)";

// On exécute la requête et on vérifie le résultat
if (!mysqli_query($link, $sql4)) {
    echo "Erreur de création : " . mysqli_error($link);
}

// Création de la table COMMANDE (procédurale)
$sql5 = "CREATE TABLE orders (
    id INT(6) unsigned auto_increment PRIMARY KEY,
    user_id INT(6) NOT NULL,
    product_id INT(6) NOT NULL,
    quantity INT (6) NOT NULL,
    total_price INT (6) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
)";

// On exécute la requête et on vérifie le résultat
if (!mysqli_query($link, $sql5)) {
    echo "Erreur de création : " . mysqli_error($link);
}

// Fermeture de la connexion à la base de données
mysqli_close($link);
