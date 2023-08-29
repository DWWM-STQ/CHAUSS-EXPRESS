<?php
require '../../../php/crud/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id']) && !empty($_POST['id'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM products WHERE id = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        $param_id = $id;

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt); // Close the statement
            mysqli_close($link); // Close the connection
            header('location: ../index_produits.php');
            exit();
        } else {
            echo "Une erreur est survenue !";
        }
    } else {
        echo "Erreur de préparation de la requête : " . mysqli_error($link);
    }
} else {
    if (empty(trim($_GET['id']))) {
        header('location: ../index_produits.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Delete Record</title>
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
                    <h2 class="mt-5 mb-3">Suppression d'un produit</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>" />
                            <p>Êtes-vous sûr de vouloir supprimer ce produit ?</p>
                            <p>
                                <input type="submit" value="Yes" class="btn btn-danger">
                                <a href="../index_produits.php" class="btn btn-secondary">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>