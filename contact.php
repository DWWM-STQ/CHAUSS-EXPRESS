<?php
require_once "./php/crud/config.php";

$nom = $mail = $sujet = $message = "";
$nom_err = $mail_err = $sujet_err = $message_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $input_nom = trim($_POST["nom"]);
    if (empty($input_nom)) {
        $nom_err = "Entrer un nom";
    } else {
        $nom = $input_nom;
    }

    $input_mail = trim($_POST["mail"]);
    if (empty($input_mail)) {
        $mail_err = "Entrer une adresse mail";
    } else {
        $mail = $input_mail;
    }

    $input_sujet = trim($_POST["sujet"]);
    if (empty($input_sujet)) {
        $sujet_err = "Entrer un sujet";
    } else {
        $sujet = $input_sujet;
    }

    $input_message = trim($_POST["message"]);
    if (empty($input_message)) {
        $message_err = "Entrer un message";
    } else {
        $message = $input_message;
    }

    if (empty($nom_err) && empty($mail_err) && empty($sujet_err) && empty($message_err)) {

        $param_nom = $nom;
        $param_mail = $mail;
        $param_sujet = $sujet;
        $param_message = $message;

        $sql = "INSERT INTO contact (nom, mail, sujet, message) VALUES ('$param_nom', '$param_mail', '$param_sujet', '$param_message')";

        $result = mysqli_query($link, $sql);

        if ($result) { // Utiliser $result au lieu de mysqli_stmt_execute($stmt)

            header("location: ./index.php");
            exit();
        } else {
            echo "UNE ERREUR INATTENDUE ! VEUILLEZ RÉESSAYER PLUS TARD !"; // Corrigé le message d'erreur
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
</head>

<body>
    <?php include './php/includes/menu.php'; ?>
    <a href="./panier.php" class="link">Panier<span><?= array_sum($_SESSION['panier']) ?></span></a>

    <h1 style="font-size: 55pt;">Contact</h1>
    <form method="post" class="form-contact">
        <div class="form-group mt-2">
            <label for="name" class="text-white">Votre nom</label>
            <input type="text" class="form-control" placeholder="Entrez votre nom" name="nom">
            <!-- type="text" au lieu de type="name" -->
        </div>
        <div class="form-group mt-2">
            <label for="mail" class="text-white">Votre mail</label>
            <input type="email" class="form-control" placeholder="Entrez votre adresse mail" name="mail">
            <!-- type="email" au lieu de type="mail" -->
            <small id="emailHelp" class="form-text text-white">Nous ne partageons pas votre mail avec qui que ce soit</small>
        </div>
        <div class="form-group mt-2">
            <label for="sujet" class="text-white">Sujet de votre message</label>
            <input type="text" class="form-control" placeholder="Sujet" name="sujet">
        </div>

        <label for="message" class="text-white">Votre message</label>
        <textarea class="mt-2" id="story" rows="5" cols="35" placeholder="Écrivez votre message ici ..." name="message"></textarea>

        <button type="submit" class="btn btn-dark btn-lg mt-2 w-10">Envoyer</button>
    </form>

    <?php include './php/includes/footer.php'; ?>
</body>

</html>