<?php
session_start();
include_once "./php/crud/config.php";

if (isset($_GET['del'])) {
    $id_del = $_GET['del'];
    if (isset($_SESSION['panier'][$id_del])) {
        unset($_SESSION['panier'][$id_del]);
    }
}

if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = array();
}

if (isset($_POST['checkout'])) {
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        $ids = array_keys($_SESSION['panier']);

        if (!empty($ids)) {
            $total = 0;

            // Commencez une transaction pour assurer l'intégrité des données
            mysqli_begin_transaction($link);

            try {
                // Insérez les détails de la commande dans la table "orders"
                $insert_order_query = "INSERT INTO orders (user_id, product_id, quantity, total_price) VALUES (?, ?, ?, ?)";
                $stmt = mysqli_prepare($link, $insert_order_query);

                foreach ($ids as $product_id) {
                    $quantity = $_SESSION['panier'][$product_id];

                    $product_query = "SELECT * FROM products WHERE id = ?";
                    $product_stmt = mysqli_prepare($link, $product_query);
                    mysqli_stmt_bind_param($product_stmt, "i", $product_id);
                    mysqli_stmt_execute($product_stmt);
                    $product_result = mysqli_stmt_get_result($product_stmt);
                    $product = mysqli_fetch_assoc($product_result);

                    $total_price = $product['price'] * $quantity;

                    mysqli_stmt_bind_param($stmt, "iiid", $user_id, $product_id, $quantity, $total_price);
                    mysqli_stmt_execute($stmt);
                }

                // Validez la transaction
                mysqli_commit($link);

                // Réinitialisez le panier
                $_SESSION['panier'] = array();
            } catch (mysqli_sql_exception $e) {
                // En cas d'erreur, annulez la transaction
                mysqli_rollback($link);
                throw $e;
            } finally {
                mysqli_stmt_close($stmt);
            }
        }
    } else {
        header("Location: login.php");
        exit();
    }
}

// Récupérer l'ID de l'utilisateur connecté en cours
$current_user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>
    <link rel="stylesheet" href="./css/panier_style.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body class="panier">
    <a href="index.php" class="link">Boutique</a>
    <section>
        <table>
            <tr>
                <th></th>
                <th>Nom</th>
                <th>Prix</th>
                <th>Quantité</th>
                <th>Action</th>
            </tr>
            <?php 
                $total = 0 ;
                // liste des produits
                //récupérer les clés du tableau session
                $ids = array_keys($_SESSION['panier']);


                //s'il n'y a aucune clé dans le tableau
                if(empty($ids)){
                    echo "<tr><td colspan='5'>Votre panier est vide</td></tr>";
                } else {
                    //si oui 
                    $ids_string = implode(',', $ids);
                    $products_query = "SELECT * FROM products WHERE id IN ($ids_string)";
                    $products_result = mysqli_query($link, $products_query);
                    
                    //lise des produits avec une boucle while
                    while($product = mysqli_fetch_assoc($products_result)):
                        //calculer le total ( prix unitaire * quantité) 
                        //et additionner chaque résultat à chaque tour de boucle
                        $total += $product['price'] * $_SESSION['panier'][$product['id']];

            ?>
            <tr>
                <td><img src="images_produits/<?= $product['img'] ?>"></td>
                <td><?= $product['name'] ?></td>
                <td><?= $product['price'] ?>€</td>
                <td><?= $_SESSION['panier'][$product['id']] ?></td>
                <td><a href="panier.php?del=<?= $product['id'] ?>"><img src="./images_produits/delete.png"></a></td>
            </tr>
            <?php endwhile; ?>

            <tr class="total">
                <th>Total : <?= $total ?>€</th>
            </tr>
            <?php } ?>
        </table>
    </section>

    <form method="post" action="panier.php">
    <button type="submit" name="checkout">Finaliser l'achat</button>
</form>
</body>

</html>