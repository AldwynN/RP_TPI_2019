<!--
Titre : Page d'accueil
Date : 8 mai 2019
Auteur : Romain Peretti
Version : 1.0
Description : La vue de la page d'accueil contenant toutes les annonces valides
-->
<!DOCTYPE html>
<html>

<head>
    <title>Accueil</title>
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
            <div class='col-md-10'>
                <form class='form-row'>
                    <input type='text' class='form-control col-7' name='searchContent' placeholder='Mettez votre recherche ici'>
                    <input type='submit' class='btn btn-primary col-3' value='Rechercher'>
                    <?php if (isset($_SESSION['email'])) : ?>
                        <a href='../controllers/createAd.php' class='btn btn-success col-2'>+</a>
                    <?php endif; ?>
                </form>
            </div>
        </div>

        <div class='row justify-content-center'>
            <?php foreach ($ads as $ad) :
                $u = UserManager::GetUserByEmail($ad->userEmail);
                ?>
                <div class='media border rounded col-md-10'>
                    <div class='media-body'>
                        <h4><?= $ad->title ?></h4>
                        <p class='text-justify'><?= $ad->description ?></p>
                        <input type='radio' id='bio' <?= ($ad->organic == 1 ? 'checked' : '') ?>>
                        <label for='bio'>Produit bio</label>
                        <p><?= 'Vente au ' . $u->streetAndNumber . ', ' . $u->postCode . ' ' . $u->canton ?></p>
                        <p><?= 'Posté le ' . date_format(date_create($ad->creationDate), 'd M Y \à H:i:s') ?></p>
                        <div class='row justify-content-end'>
                            <a class='btn btn-primary' href='../controllers/adDetails.php?idAd=<?= $ad->idAdvertisement ?>'>Détails</a>
                            <?php if (isset($_SESSION['email']) && $ad->userEmail == $_SESSION['email']) : ?>
                                <a class='btn btn-warning' href='../controllers/updateAd.php?idAd=<?= $ad->idAdvertisement ?>'>Modifier</a>
                                <a class='btn btn-danger' href='../controllers/deleteAd.php?idAd=<?= $ad->idAdvertisement ?>'>Supprimer</a>
                            <?php endif; ?>
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