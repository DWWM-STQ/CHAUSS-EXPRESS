<?php
session_start();

if (isset($_SESSION['client'])) {
    $client = $_SESSION['client'];
} else {
    $client = '';
}

require '../../php/crud/config.php';

$nom = $prenom = $tel = $adresse = $complement = $cp = $ville = $user_id = '';
$nom_err = $prenom_err = $tel_err = $adresse_err = $complement_err = $cp_err = $ville_err = $user_id_err = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $input_nom = trim($_POST["nom"]);
    if (!empty($input_nom)) {
        $nom = $input_nom;
    }

    $input_prenom = trim($_POST["prenom"]);
    if (!empty($input_prenom)) {
        $prenom = $input_prenom;
    }

    $input_tel = trim($_POST["tel"]);
    if (!empty($input_tel)) {
        $tel = $input_tel;
    }

    $input_adresse = trim($_POST["adresse"]);
    if (!empty($input_adresse)) {
        $adresse = $input_adresse;
    } else {
        $adresse = '';
    }

    $input_complement = trim($_POST["complement"]);
    if (!empty($input_complement)) {
        $complement = $input_complement;
    }

    $input_cp = trim($_POST["cp"]);
    if (!empty($input_cp)) {
        $cp = $input_cp;
    }

    $input_ville = trim($_POST["ville"]);
    if (!empty($input_ville)) {
        $ville = $input_ville;
    }

    $recup = $_SESSION['recup_id'];
    $sql = "update clients set nom=?, prenom=?, tel=?, adresse=?, complement=?, cp=?, ville=?, user_id=? where id=$recup";

    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "sssssssi", $param_nom, $param_prenom, $param_tel, $param_adresse, $param_complement, $param_cp, $param_ville, $param_user_id);

        $param_nom = $nom;
        $param_prenom = $prenom;
        $param_tel = $tel;
        $param_adresse = $adresse;
        $param_complement = $complement;
        $param_cp = $cp;
        $param_ville = $ville;
        $param_user_id = $_SESSION['id'];


        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['recup_id'] = '';
            header("location: ../../index.php");
            exit();
        } else {
            echo "Oops ! erreur inattendu, rééssayez plus tard !!!";
        }
    }

    mysqli_close($link);
} else {

    // récup id dans table users
    $sql = "select * from users where login=?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $param_login);

        $param_login = $client;

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $_SESSION['id'] = $row['id'];
            } else {
                header('location: ../../index.php');
                exit();
            }
        } else {
            echo "Oops ! erreur inattendu, rééssayez plus tard !!!";
        }
    }

    // récup table clients
    $sql = "select * from clients where user_id=?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $param_user_id);

        $param_user_id = $_SESSION['id'];

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $nom = $row['nom'];
                $prenom = $row['prenom'];
                $tel = $row['tel'];
                $adresse = $row['adresse'];
                $complement = $row['complement'];
                $cp = $row['cp'];
                $ville = $row['ville'];
                $user_id = $row['user_id'];
                $_SESSION['recup_id'] = $row['id'];
            } else {

                $param_id = $_SESSION['id'];
                $sql = "INSERT INTO clients (user_id) VALUE ('$param_user_id')";
                $result = mysqli_query($link, $sql);
                $_SESSION['recup_id'] = mysqli_insert_id($link);

                if ($result) {

                    mysqli_close($link);
                } else {
                    echo "Oops! erreur inattendu, rééssayez ultérieusement";
                }

                $nom = $prenom = $tel = $adresse = $complement = $cp = $ville = '';
            }
        } else {
            echo "Oops ! erreur inattendu, rééssayez plus tard !!!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>client</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/style2.CSS">
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Mon espace client</h2>
                    <p>Changez les valeurs et validez !!!</p>
                </div>
                <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="post">
                    <div class="form-group">
                        <label>Nom</label>
                        <input type="text" name="nom" class="form-control <?php echo (!empty($nom_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nom; ?>">
                        <span class="invalid-feedback"><?php echo $nom_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Prénom</label>
                        <input type="text" name="prenom" class="form-control <?php echo (!empty($prenom_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $prenom; ?>">
                        <span class="invalid-feedback"><?php echo $prenom_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Téléphone</label>
                        <input type="text" name="tel" class="form-control <?php echo (!empty($tel_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $tel; ?>">
                        <span class="invalid-feedback"><?php echo $tel_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Adresse</label>
                        <input type="text" name="adresse" class="form-control <?php echo (!empty($adresse_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $adresse; ?>">
                        <span class="invalid-feedback"><?php echo $adresse_err; ?></span>
                    </div>
                    <!-- ... Repeat similar structure for other form fields ... -->

                    <div class="form-group">
                        <label>Complément d'adresse</label>
                        <input type="text" name="complement" class="form-control <?php echo (!empty($complement_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $complement; ?>">
                        <span class="invalid-feedback"><?php echo $complement_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Code postal</label>
                        <input type="text" name="cp" class="form-control <?php echo (!empty($cp_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $cp; ?>">
                        <span class="invalid-feedback"><?php echo $cp_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Ville</label>
                        <input type="text" name="ville" class="form-control <?php echo (!empty($ville_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $ville; ?>">
                        <span class="invalid-feedback"><?php echo $ville_err; ?></span>
                    </div>

                    <input type="hidden" name="id" value="<?= $_SESSION['recup_id'] ?>" />
                    <input type="submit" class="btn btn-primary" value="Enregistrer">
                    <a href="../../index.php" class="btn btn-secondary ml-2">Annuler</a>
            </div>
        </div>
    </div>

</body>

</html>