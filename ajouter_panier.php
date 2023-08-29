<?php
// Inclure la page de connexion
include_once "./php/crud/config.php";

// Démarrer la session
session_start();

// Vérifier si le panier n'existe pas dans la session, puis le créer
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = array();
}

// Récupération de l'id depuis le lien
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Vérifier si le produit existe dans la base de données en utilisant une requête préparée
    $query = "SELECT * FROM products WHERE id = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if (mysqli_num_rows($result) === 0) {
        // Si le produit n'existe pas
        die("Ce produit n'existe pas");
    }
    
    // Ajouter le produit dans le panier
    if (isset($_SESSION['panier'][$id])) {
        // Si le produit est déjà dans le panier, augmenter la quantité
        $_SESSION['panier'][$id]++;
    } else {
        // Sinon, ajouter le produit avec une quantité de 1
        $_SESSION['panier'][$id] = 1;
    }
    
    // Redirection vers la page index.php
    header("Location: index.php");
    exit(); // Assurer que le script s'arrête après la redirection
}
?>
