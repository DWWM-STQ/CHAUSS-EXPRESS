<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>CGU</title>
</head>

<body>
    <?php include './php/includes/menu.php'; ?>

    <h1 class="m-2">Conditions Générales d'Utilisation (CGU)</h1>

    <div class="bg-light w-75 p-3 text-center mx-auto my-5 rounded ">
        <p>

        <h4 class="m-2">Date d'entrée en vigueur : 21/08/2023</h4>

        Les présentes Conditions Générales d'Utilisation (CGU) régissent l'utilisation du service fourni par
        Chauss'Express (ci-après dénommé "nous", "notre" ou "nos").
        En accédant et en utilisant notre service, vous acceptez pleinement et sans réserve l'ensemble des termes et
        conditions énoncés dans les présentes CGU. Si vous n'êtes pas d'accord avec ces termes, veuillez ne pas utiliser
        notre service.

        <h4 class="m-2">Acceptation des CGU</h4>

        En utilisant notre service, vous déclarez avoir lu, compris et accepté les présentes CGU dans leur intégralité.
        Vous reconnaissez également que vous êtes lié(e) par ces CGU et que vous vous engagez à les respecter en tout
        temps.

        <h4 class="m-2">Utilisation du Service</h4>

        Vous acceptez d'utiliser notre service conformément à toutes les lois et réglementations applicables, ainsi
        qu'aux dispositions des présentes CGU.
        Vous ne devez pas utiliser le service à des fins illégales, abusives, frauduleuses ou nuisibles à autrui.
        Vous êtes responsable du maintien de la confidentialité de vos informations d'identification et de la sécurité
        de votre compte. Toute activité effectuée sous votre compte est de votre entière responsabilité.
        Contenu de l'Utilisateur

        En utilisant notre service, vous pouvez soumettre du contenu tel que des commentaires, des images, des textes,
        etc. Vous conservez tous les droits sur le contenu que vous soumettez.
        En soumettant du contenu, vous garantissez que vous avez les droits nécessaires pour le faire et que le contenu
        est conforme à toutes les lois et réglementations en vigueur.
        Nous nous réservons le droit de supprimer tout contenu qui enfreint les présentes CGU ou qui est jugé offensant,
        illégal ou inapproprié.
        Propriété Intellectuelle

        Notre service et tout le contenu associé (textes, images, logos, etc.) sont protégés par des droits de propriété
        intellectuelle et appartiennent à [Nom de l'entreprise ou de la plateforme].
        Vous n'êtes pas autorisé(e) à copier, distribuer, reproduire, modifier, ou créer des œuvres dérivées à partir de
        notre contenu sans notre consentement écrit préalable.
        Modification des CGU

        Nous nous réservons le droit de modifier, mettre à jour ou réviser les présentes CGU à tout moment. Les
        modifications seront effectives dès leur publication sur notre service. Il vous incombe de vérifier
        régulièrement les CGU pour vous tenir au courant des éventuelles modifications.

        <h4 class="m-2">Limitation de Responsabilité</h4>

        Nous nous efforçons de maintenir notre service accessible et fonctionnel, mais nous ne pouvons garantir son
        absence d'interruptions, d'erreurs ou de bogues. En aucun cas, nous ne pourrons être tenus responsables des
        dommages directs, indirects, spéciaux, consécutifs ou punitifs résultant de l'utilisation de notre service.

        <h4 class="m-2">Résiliation</h4>

        Nous nous réservons le droit de résilier ou de suspendre votre accès à notre service, à notre seule discrétion
        et sans préavis, en cas de violation des présentes CGU.

        <h4 class="m-2">Loi Applicable</h4>

        Les présentes CGU sont régies par les lois en vigueur en France. Tout litige découlant de l'utilisation de notre
        service sera soumis à la compétence exclusive des tribunaux français.

        En acceptant ces CGU, vous reconnaissez avoir lu, compris et accepté l'ensemble des termes et conditions énoncés
        dans ce document. Si vous avez des questions ou des préoccupations concernant ces CGU, veuillez nous contacter à
        chauss'express@contact.fr.

        Fait à Saint-Quentin, le 21/08/2023.

        Chauss'Express Cie
        Chauss'Express
        06.66.66.66.66
        chauss'express@compagnie.com

        </p>
        <div class="buttons-container mt-4">
            <button id="acceptButton" class="btn btn-primary" name="accept">Accepter</button>
            <button id="refuseButton" class="btn btn-danger" name="refuse">Refuser</button>

        </div>
    </div>

    <script>
document.getElementById("acceptButton").addEventListener("click", function() {
    // Rediriger vers l'index du site
    window.location.href = "./index.php";
});

document.getElementById("refuseButton").addEventListener("click", function() {
    // Rediriger vers Google
    window.location.href = "https://www.google.com";
});
</script>
    <?php include './php/includes/footer.php'; ?>
</body>

</html>