<?php
require_once "../../../php/crud/config.php";

$category = $img = $brand = $type = $name = $color = $price = $ref = $description = "";
$category_err = $img_err = $brand_err = $type_err = $name_err = $color_err = $price_err = $ref_err = $description_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

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
        $description_err = "Enter a description";
    } else {
        $description = $input_description;
    }

    if (empty($category_err) && empty($img_err) && empty($brand_err) && empty($type_err) && empty($name_err) && empty($color_err) && empty($price_err) && empty($ref_err) && empty($description_err)) {
        $sql_update = 'UPDATE products SET category=?, img=?, brand=?, type=?, name=?, color=?, price=?, ref=?, description=? WHERE id=?';

        if ($stmt_update = mysqli_prepare($link, $sql_update)) {
            mysqli_stmt_bind_param($stmt_update, "ssssssissi", $category, $img, $brand, $type, $name, $color, $price, $ref, $description, $id);

            if (mysqli_stmt_execute($stmt_update)) {
                mysqli_stmt_close($stmt_update);
                mysqli_close($link);
                header("Location: ../index_produits.php");
                exit();
            } else {
                echo "Oops! Unexpected error occurred during update, please try again later. Error: " . mysqli_error($link);
            }
        }
    }

    mysqli_close($link);
} elseif (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = trim($_GET['id']);

    $sql = "SELECT * FROM products WHERE id=?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $param_id);

        $param_id = $id;

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                $category = $row['category'];
                $img = $row['img'];
                $brand = $row['brand'];
                $type = $row['type'];
                $name = $row['name'];
                $color = $row['color'];
                $price = $row['price'];
                $ref = $row['ref'];
                $description = $row['description'];
            } else {
                header('Location: ../index_produits.php');
                exit();
            }
        } else {
            echo "Oops ! Une erreur inattendue s'est produite, veuillez réessayer ultérieurement.";
        }
    }
    mysqli_stmt_close($stmt);
} else {
    header('Location: ../index_produits.php');
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../css/style2.CSS">
    <title>Mis à jour Produit</title>
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
                    <h2 class="mt-5">Mise à jour du produit : <?php echo $name; ?></h2>
                    <p class="text-center">Changez les valeurs et validez !</p>
                </div>

                <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="POST"><br>

                    <div class="form-group">
                        <label>Catégorie</label>
                        <input type="text" name="category"
                            class="form-control <?php echo (!empty($category_err)) ? 'is-invalid' : ''; ?>"
                            value="<?php echo $category; ?>">
                        <span class="invalid-feedback"><?php echo $category_err; ?></span>
                    </div>

                    <div class="form-group">
                        <label>Image</label>
                        <input type="text" name="img"
                            class="form-control <?php echo (!empty($img_err)) ? 'is-invalid' : ''; ?>"
                            value="<?php echo $img; ?>">
                        <span class="invalid-feedback"><?php echo $img_err; ?></span>
                    </div>

                    <div class="form-group">
                        <label>Marque</label>
                        <input type="text" name="brand"
                            class="form-control <?php echo (!empty($brand_err)) ? 'is-invalid' : ''; ?>"
                            value="<?php echo $brand; ?>">
                        <span class="invalid-feedback"><?php echo $brand_err; ?></span>
                    </div>

                    <div class="form-group">
                        <label>Type de modèle</label>
                        <input type="text" name="type"
                            class="form-control <?php echo (!empty($type_err)) ? 'is-invalid' : ''; ?>"
                            value="<?php echo $type; ?>">
                        <span class="invalid-feedback"><?php echo $type_err; ?></span>
                    </div>

                    <div class="form-group">
                        <label>Nom du modèle</label>
                        <input type="text" name="name"
                            class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>"
                            value="<?php echo $name; ?>">
                        <span class="invalid-feedback"><?php echo $name_err; ?></span>
                    </div>

                    <div class="form-group">
                        <label>Couleur</label>
                        <input type="text" name="color"
                            class="form-control <?php echo (!empty($color_err)) ? 'is-invalid' : ''; ?>"
                            value="<?php echo $color; ?>">
                        <span class="invalid-feedback"><?php echo $color_err; ?></span>
                    </div>

                    <div class="form-group">
                        <label>Prix</label>
                        <input type="number" name="price"
                            class="form-control <?php echo (!empty($price_err)) ? 'is-invalid' : ''; ?>"
                            value="<?php echo $price; ?>">
                        <span class="invalid-feedback"><?php echo $price_err; ?></span>
                    </div>

                    <div class="form-group">
                        <label>Référence</label>
                        <input type="text" name="ref"
                            class="form-control <?php echo (!empty($ref_err)) ? 'is-invalid' : ''; ?>"
                            value="<?php echo $ref; ?>">
                        <span class="invalid-feedback"><?php echo $ref_err; ?></span>
                    </div>

                    <label for="description" class="text-white">Description</label>
                    <textarea class="form-control <?php echo (!empty($description_err)) ? 'is-invalid' : ''; ?>"
                        id="description" rows="5" name="description"><?php echo $description; ?></textarea>
                    <span class="invalid-feedback"><?php echo $description_err;?></span>

                    <input type="hidden" name="id" value="<?php echo $id; ?>" />

                    <input type="submit" class="btn btn-primary" value="Enregistrer">
                    <a href="../index_produits.php" class="btn btn-secondary ml-2">Annuler</a>
                </form>
            </div>
        </div>
    </div>

</body>

</html>