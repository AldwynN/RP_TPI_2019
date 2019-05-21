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
    <?php include_once '../inc/head.php'; ?>
</head>

<body>
    <div class='container col-md-12'>
        <div class='row'>
            <?php include_once '../inc/navbar.php'; ?>
        </div>
        <div class='row justify-content-center'>
            <div class='col-md-7'>
                <form method='POST' class='m-1'>
                    <div class='form-row'>
                        <div class='form-group col-8'>
                            <input type='text' class='form-control m-1' name='searchContent' placeholder="Chercher par canton, ville, code postal, score, titre et description d'une annonce">
                        </div>
                        <div class='form-group col'>
                            <button type='submit' class='form-control btn btn-outline-primary my-btn m-1' name='search'><span class='fas fa-search'></span></button>
                        </div>
                        <?php if (isset($_SESSION['email'])) : ?>
                            <div class='form-group col'>
                                <a href='../controllers/createAd.php' class='form-control btn btn-outline-success my-btn '><span class='fas fa-plus-circle'></span></a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class='form-row m-1'>
                        <div class='form-group'>
                            <input type='checkbox' id='bio' name='searchOrganic'>
                            <label for='bio'>Bio <span class="fa fa-seedling" style='color: rgb(57, 192, 39)'></span></label>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class='row justify-content-center'>
            <?php if (count($ads) > 0) :
                foreach ($ads as $ad) :
                    $u = UserManager::GetUserByEmail($ad->userEmail);
                    $score = RatingManager::GetScoreOfAnAd($ad->idAdvertisement);
                    ?>
                    <div class='media border rounded col-md-10 my-ad'>
                        <div class='media-body'>
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
                            <p>Annonceur : <?= $ad->userEmail ?></p>
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
                                <?php if (isset($_SESSION['email']) && $ad->userEmail == $_SESSION['email']) : ?>
                                    <a class='btn btn-outline-warning my-btn' href='../controllers/updateAd.php?idAd=<?= $ad->idAdvertisement ?>'><span class='fas fa-pencil-alt'></span></a>
                                    <a class='btn btn-outline-danger my-btn' href='../controllers/deleteAd.php?idAd=<?= $ad->idAdvertisement ?>'><span class='fas fa-trash-alt'></span></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <h2>Aucune annonce avec cette recherche</h2>
            <?php endif; ?>
        </div>
        <div class='row'>
            <?php include_once '../inc/footer.php'; ?>
        </div>
    </div>
</body>

</html>