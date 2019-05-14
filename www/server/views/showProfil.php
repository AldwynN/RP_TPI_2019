<!--
Titre : Page de détails de l'utilisateur
Date : 9 mai 2019
Auteur : Romain Peretti
Version : 1.0
Description : La vue de la page connexion contenant les détails de l'utilisateur ainsi que toutes ses annonces
-->
<!DOCTYPE html>
<html>

<head>
    <title>Détails de votre compte</title>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <!-- Bootstrap CSS & JS -->
    <link href='../../css/bootstrap/css/bootstrap.min.css' rel='stylesheet' type='text/css' />
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'></script>
    <script src='../../css/bootstrap/js/bootstrap.min.js' type='text/javascript'></script>
</head>

<body>
    <div class='container col-md-12'>
        <div class='row'>
            <?php include_once '../inc/navbar.php'; ?>
        </div>
        <div class='row justify-content-center'>
            <div class='media border col-md-10'>
                <div class='media-body'>
                    <h2><?= $u->email ?></h2>
                    <p>Ville : <?= $u->city ?></p>
                    <p>Canton : <?= $u->canton ?></p>
                    <p>Code postal : <?= $u->postCode ?></p>
                    <p>Rue et n° : <?= $u->streetAndNumber ?></p>
                    <p class='text-justify'>Description : <?= $u->description ?></p>
                    <div class='row justify-content-end'>
                        <a class='btn btn-warning' href='../controllers/updateProfil.php?email=<?= $u->email ?>'>Modifier</a>
                        <a class='btn btn-danger' href='../controllers/deleteProfil.php?email=<?= $u->email ?>'>Supprimer</a>
                    </div>
                </div>
            </div>
        </div>
        <div class='row justify-content-center'>
            <?php foreach ($ads as $ad) :
                $u = UserManager::GetUserByEmail($ad->userEmail);
                ?>
                <div class='media border rounded col-md-5'>
                    <div class='media-body'>
                        <h4><?= $ad->title ?></h4>
                        <p class='text-justify'><?= $ad->description ?></p>
                        <input type='radio' id='bio' <?= ($ad->organic == 1 ? 'checked' : '') ?>>
                        <label for='bio'>Produit bio</label>
                        <p><?= 'Vente au ' . $u->streetAndNumber . ', ' . $u->postCode . ' ' . $u->canton ?></p>
                        <p><?= 'Posté le ' . date_format(date_create($ad->creationDate), 'd M Y \à H:i:s') ?></p>
                        <p>Annonce : <?= ($ad->valid == 1 ? 'Validée' : 'Pas validée') ?></p>
                        <div class='row justify-content-end'>
                            <a class='btn btn-primary' href='../controllers/adDetails.php?idAd=<?= $ad->idAdvertisement ?>'>Détails</a>
                            <a class='btn btn-warning' href='../controllers/updateAd.php?idAd=<?= $ad->idAdvertisement ?>'>Modifier</a>
                            <a class='btn btn-danger' href='../controllers/deleteAd.php?idAd=<?= $ad->idAdvertisement ?>'>Supprimer</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class='row'>
            <?php include_once '../inc/footer.php'; ?>
        </div>
    </div>
</body>

</html>