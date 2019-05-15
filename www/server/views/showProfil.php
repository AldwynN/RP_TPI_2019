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
    <?php include_once '../inc/head.php'; ?>
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
                        <a class='btn btn-outline-warning myBtn' href='../controllers/updateProfil.php?email=<?= $u->email ?>'>Modifier</a>
                        <a class='btn btn-outline-danger myBtn' href='../controllers/deleteProfil.php?email=<?= $u->email ?>'>Supprimer</a>
                    </div>
                </div>
            </div>
        </div>
        <div class='row justify-content-center'>
            <?php foreach ($ads as $ad) :
                $u = UserManager::GetUserByEmail($ad->userEmail);
                ?>
                <div class='media border rounded col-md-5'>
                    <div class='media-body '>
                        <h4><?= $ad->title ?></h4>
                        <p class='text-justify'><?= $ad->description ?></p>
                        <input type='radio' id='bio' <?= ($ad->organic == 1 ? 'checked' : '') ?>>
                        <label for='bio'>Produit bio</label>
                        <p><?= 'Vente au ' . $u->streetAndNumber . ', ' . $u->postCode . ' ' . $u->canton ?></p>
                        <p><?= 'Posté le ' . date_format(date_create($ad->creationDate), 'd M Y \à H:i:s') ?></p>
                        <p>Annonce : <?= ($ad->valid == 1 ? 'Validée' : 'Pas validée') ?></p>
                        <div class='row justify-content-end'>
                            <a class='btn btn-outline-primary myBtn' href='../controllers/adDetails.php?idAd=<?= $ad->idAdvertisement ?>'>Détails</a>
                            <a class='btn btn-outline-warning myBtn' href='../controllers/updateAd.php?idAd=<?= $ad->idAdvertisement ?>'>Modifier</a>
                            <a class='btn btn-outline-danger myBtn' href='../controllers/deleteAd.php?idAd=<?= $ad->idAdvertisement ?>'>Supprimer</a>
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