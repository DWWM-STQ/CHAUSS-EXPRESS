<?php
require_once "../../../php/crud/config.php";

$category = $img = $brand = $type = $name = $color = $price = $ref = $description = "";
$category_err = $img_err = $brand_err = $type_err = $name_err = $color_err = $price_err = $ref_err = $description_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $input_category = trim($_POST["category"]);
    if (empty($input_category)) {
        $category_err = "Entrer une catégorie";
    } else {
        $category = $input_category;
    }

    $input_img = trim($_POST["img"]);
    if (empty($input_img)) {
        $img_err = "Entrer une image";
    } else {
        $img = $input_img;
    }

    $input_brand = trim($_POST["brand"]);
    if (empty($input_brand)) {
        $brand_err = "Entrer une marque";
    } else {
        $brand = $input_brand;
    }

    $input_type = trim($_POST["type"]);
    if (empty($input_type)) {
        $type_err = "Entrer un type";
    } else {
        $type = $input_type;
    }

    $input_name = trim($_POST["name"]);
    if (empty($input_name)) {
        $name_err = "Entrer un nom de modèle";
    } else {
        $name = $input_name;
    }

    $input_color = trim($_POST["color"]);
    if (empty($input_color)) {
        $color_err = "Entrer une couleur";
    } else {
        $color = $input_color;
    }

    $input_price = trim($_POST["price"]);
    if (empty($input_price)) {
        $price_err = "Entrer un prix";
    } elseif (!is_numeric($input_price)) {
        $price_err = "Le prix doit être un nombre";
    } else {
        $price = $input_price;
    }

    $input_ref = trim($_POST["ref"]);
    if (empty($input_ref)) {
        $ref_err = "Entrer une référence";
    } else {
        $ref = $input_ref;
    }

    $input_description = trim($_POST["description"]);
    if (empty($input_description)) {
    $description = "Entrer une description";
    } else {
        $description = $input_description;
    }



    if (empty($img_err) && empty($price_err) && empty($name_err) && empty($category_err)) {
        $sql = "INSERT INTO products (category, img, brand, type, name, color, price, ref, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($link, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssssssiss", $category, $img, $brand, $type, $name, $color, $price, $ref, $description);


            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_close($stmt);
                mysqli_close($link);
                header("location: ../index_produits.php");
                exit();
            } else {
                echo "Une erreur est survenue lors de l'exécution de la requête : " . mysqli_stmt_error($stmt);
            }
        } else {
            echo "Une erreur est survenue lors de la préparation de la requête : " . mysqli_error($link);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ajouter un produit</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../css/style2.CSS">
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Création d'un produit</h2><br>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                        <div class="form-group">
                            <label>Catégorie</label>
                            <input type="text" name="category" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Image</label>
                            <input type="text" name="img" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Marque</label>
                            <input type="text" name="brand" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Type de modèle</label>
                            <input type="text" name="type" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Nom du modèle</label>
                            <input type="text" name="name" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Couleur</label>
                            <input type="text" name="color" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Prix</label>
                            <input type="number" name="price" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Référence</label>
                            <input type="text" name="ref" class="form-control">
                            <?php
                            function generateReference($length)
                            {
                                $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                                $reference = '';
                                $charCount = strlen($characters);

                                for ($i = 0; $i < $length; $i++) {
                                    $randomIndex = rand(0, $charCount - 1);
                                    $reference .= $characters[$randomIndex];
                                }

                                return $reference;
                            }

                            $reference = generateReference(10);
                            echo "Référence générée : " . $reference;

                            ?>
                        </div>

                        <label for="message" class="text-white">Description</label>
        <textarea class="mt-2" id="story" rows="5" cols="35" name="message"></textarea>

                        <input type="submit" name="submit" class="btn btn-primary" value="Enregistrer">
                        <a href="../index_produits.php" class="btn btn-secondary ml-2">Annuler</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>