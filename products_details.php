<?php
include_once "./php/crud/config.php";

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $product_id = $_GET['id'];

    // Récupérer les détails du produit en fonction de l'ID
    $query = "SELECT * FROM products WHERE id = $product_id";
    $result = mysqli_query($link, $query);
    $product = mysqli_fetch_assoc($result);
} else {
    // Rediriger en cas d'ID invalide
    header("Location: index.php");
    exit();
}

include './php/includes/menu.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Produit</title>
</head>

<body>

    <h1>Détails du produit</h1>
    <div class="d-flex justify-content-center">
    <div class="bg-white card m-3 w-75">
        <div class="row">
            <div class="col-md-4">
                <div class="image_product">
                    <img src="images_produits/<?= $product['img'] ?>" alt="<?= $product['name'] ?>" class="img-fluid">
                </div>
            </div>
            <div class="col-md-8">
                <div class="product_info p-3">
                    <h2 class="card-header bg-white"><?= $product['brand'] ?></h2>
                    <h3 class="brand"><?= $product['name'] ?></h3>
                    <h6 class="name"><?= $product['category'] ?></h6>
                    <p class="price"><?= $product['price'] ?>€</p>
                    <p class="ref"><?= $product['ref'] ?></p>
                    <p class="description"><?= $product['description'] ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

    <?php include './php/includes/footer.php'; ?>
</body>

</html>

</html>