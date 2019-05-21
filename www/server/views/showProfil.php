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
            <div class='media border col-md-10 my-profil'>
                <div class='media-body'>
                    <h2><?= $u->email ?></h2>
                    <p>Ville : <?= $u->city ?></p>
                    <p>Canton : <?= $u->canton ?></p>
                    <p>Code postal : <?= $u->postCode ?></p>
                    <p>Rue et n° : <?= $u->streetAndNumber ?></p>
                    <p class='text-justify'>Description : <?= $u->description ?></p>
                    <div class='row justify-content-end'>
                        <a class='btn btn-outline-warning my-btn' href='../controllers/updateProfil.php?email=<?= $u->email ?>'><span class='fas fa-pencil-alt'></span></a>
                        <a class='btn btn-outline-danger my-btn' href='../controllers/deleteProfil.php?email=<?= $u->email ?>'><span class='fas fa-trash-alt'></span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class='row justify-content-center'>
            <?php foreach ($ads as $ad) :
                $u = UserManager::GetUserByEmail($ad->userEmail);
                $score = RatingManager::GetScoreOfAnAd($ad->idAdvertisement)
                ?>
                <div class='media border rounded col-md-5 my-ad'>
                    <div class='media-body '>
                        <h4><?= $ad->title ?></h4>
                        <p class='text-justify'><?= $ad->description ?></p>
                        <?php if ($ad->organic == 1) : ?>
                            <span class="fa fa-seedling" style='color: rgb(57, 192, 39)'></span>
                            <label>Produit bio</label>
                        <?php else : ?>
                            <label>Produit non bio</label>
                        <?php endif; ?>
                        <p><?= 'Vente au ' . $u->streetAndNumber . ' ' . $u->city . ', ' . $u->postCode . ' ' . $u->canton ?></p>
                        <p><?= 'Posté le ' . date_format(date_create($ad->creationDate), 'd M Y \à H:i:s') ?></p>
                        <p>Annonce : <?= ($ad->valid == 1 ? 'Validée' : 'Pas validée') ?></p>
                        <?php if ($score == 0) : ?>
                            <p>Il n'y a aucune évalution de cette annonce</p>
                        <?php else : ?>
                            <p>Évalutation de l'annonce par les autres utilisateurs :
                                <?php for ($i = 1; $i <= MAX_STARS_RATING; $i++) : ?>
                                    <?php if ($i <= $score) : ?>
                                        <span class='fas fa-star' style='color:gold'></span>
                                    <?php else : ?>
                                        <span class='far fa-star'></span>
                                    <?php endif; ?>
                                <?php endfor; ?>
                            </p>
                        <?php endif; ?>
                        <div class='row justify-content-end'>
                            <a class='btn btn-outline-primary my-btn' href='../controllers/adDetails.php?idAd=<?= $ad->idAdvertisement ?>'><span class='fas fa-stream'></span></a>
                            <a class='btn btn-outline-warning my-btn' href='../controllers/updateAd.php?idAd=<?= $ad->idAdvertisement ?>'><span class='fas fa-pencil-alt'></span></a>
                            <a class='btn btn-outline-danger my-btn' href='../controllers/deleteAd.php?idAd=<?= $ad->idAdvertisement ?>'><span class='fas fa-trash-alt'></span></a>
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