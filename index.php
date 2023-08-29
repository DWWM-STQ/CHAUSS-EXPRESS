<!DOCTYPE html>
<html lang="en">

<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <?php include './php/includes/menu.php'; ?>
    <h1>Boutique</h1>

    <!-- afficher le nombre de produit dans le panier -->
    <a href="./panier.php" class="link">Panier<span><?= array_sum($_SESSION['panier']) ?></span></a>

    <form action="" method="get">
        <div>
            <label for="category">Catégorie :</label>
            <select name="category" id="category">
                <option value="">Toutes</option>
                <option value="homme">Homme</option>
                <option value="femme">Femme</option>
                <option value="enfant">Enfant</option>
            </select>
        </div>
        <div>
            <label for="price_sort">Tri par prix :</label>
            <select name="price_sort" id="price_sort">
                <option value="">Aucun</option>
                <option value="asc">Croissant</option>
                <option value="desc">Décroissant</option>
            </select>
        </div>
        <button type="submit">Appliquer le tri</button>
    </form>

    <section class="products_list">
        <?php 
        // Inclure la page de connexion
        include_once "./php/crud/config.php";
        
        // Gérer le tri
        $category = $_GET['category'] ?? ''; // Récupérer la catégorie depuis l'URL
        $priceSort = $_GET['price_sort'] ?? ''; // Récupérer l'ordre de tri depuis l'URL

        // Construire la requête SQL en fonction des critères de tri
        $query = "SELECT * FROM products";
        if (!empty($category)) {
            $query .= " WHERE category = '$category'";
        }
        if ($priceSort === 'asc') {
            $query .= " ORDER BY price ASC";
        } elseif ($priceSort === 'desc') {
            $query .= " ORDER BY price DESC";
        }

        // Exécuter la requête SQL
        $result = mysqli_query($link, $query);
        
        while ($row = mysqli_fetch_assoc($result)) { 
        ?>
        <form action="" class="product">
            <div class="image_product">
            <img src="images_produits/<?= $row['img'] ?>" style="width: 200px;">
            </div>
            <h2 class="price"><?= $row['brand'] ?></h2>
            <h4 class="price"><?= $row['name'] ?></h4>
            <div class="content">
                <h2 class="price"><?= $row['price'] ?>€</h2>
                <p class="price"><?= $row['ref'] ?></p>
                <a href="ajouter_panier.php?id=<?= $row['id'] ?>" class="id_product">Ajouter au panier</a>
                <a href="products_details.php?id=<?= $row['id'] ?>" class="id_product">Voir les détails</a>
            </div>
        </form>

        <?php 
        }
        // Fermer la connexion à la base de données
        mysqli_close($link);
        ?>

        <?php include './php/includes/footer.php'; ?>
    </section>


</body>

</html>
