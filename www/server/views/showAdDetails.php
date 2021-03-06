<!--
Titre : Page de détails d'une annonce
Date : 8 mai 2019
Auteur : Romain Peretti
Version : 1.0
Description : La vue de la page de détails d'une annonce contenant un les informations et les images de l'annonce 
              ainsi que les commentaires des autres utilisateurs.
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
            <div class='media border rounded col-md-10 m-1'>
                <div class='media-body'>
                    <h2><?= $ad->title ?></h2>
                    <p class='text-justify'><?= $ad->description ?></p>
                    <?php if ($ad->organic == 1) : ?>
                        <span class="fa fa-seedling" style='color: rgb(57, 192, 39);'></span>
                        <label>Produit bio</label>
                    <?php else : ?>
                        <label>Produit non bio</label>
                    <?php endif; ?>
                    <p>Vente au <?= $u->streetAndNumber . ', ' . $u->postCode . ' ' . $u->canton ?></p>
                    <p>Posté le <?= date_format(date_create($ad->creationDate), 'd M Y \à H:i:s') ?></p>
                    <p>Annonceur : <?= $ad->userEmail ?></p>
                    <?php if ($score == 0) : ?>
                        <p>Il n'y a aucune évalution de cette annonce</p>
                    <?php else : ?>
                        <p>Évalutation de l'annonce par les autres utilisateurs :
                            <?php for ($i = 1; $i <= 5; $i++) : ?>
                                <?php if ($i <= $score) : ?>
                                    <span class='fas fa-star' style='color:gold'></span>
                                <?php else : ?>
                                    <span class='far fa-star'></span>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </p>
                    <?php endif; ?>
                    <div class='row'>
                        <?php foreach ($pics as $p) : ?>
                            <div class=' text-center col-md-4'>
                                <a href='../views/showFullPicture.php?id=<?= $p->idPicture ?>'>
                                    <img src='<?= $p->picture ?>' class='img-fluid'>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php if (isset($_SESSION['email']) && $_SESSION['email'] == $ad->userEmail) : ?>
                        <div class='row justify-content-end'>
                            <a class='btn btn-outline-warning my-btn' href='../controllers/updateAd.php?idAd=<?= $ad->idAdvertisement ?>'><span class='fas fa-pencil-alt'></span></a>
                            <a class='btn btn-outline-danger my-btn' href='../controllers/deleteAd.php?idAd=<?= $ad->idAdvertisement ?>'><span class='fas fa-trash-alt'></span></a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class='row justify-content-center'>
            <?php foreach ($rates as $rate) : ?>
                <div class='col-md-5 border m-1'>
                    <h4><?= $rate->userEmail ?></h4>
                    <p class='text-justify'><?= $rate->comment ?></p>
                    <p>
                        <?php for ($i = 1; $i <= 5; $i++) : ?>
                            <?php if ($i <= $rate->rating) : ?>
                                <span class='fas fa-star' style='color:gold'></span>
                            <?php else : ?>
                                <span class='far fa-star'></span>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>
        <?php if (isset($_SESSION['email'])) : ?>
            <div class='row justify-content-center'>
                <div class='col-md-5 border m-1'>
                    <h3>Poster un commentaire</h3>
                    <form method='POST'>
                        <div class='form-group row'>
                            <label for='comment' class='col-sm-2 col-form-label'>Commentaire</label>
                            <div class='col-sm-10'>
                                <textarea class='form-control' id='comment' name='comment' required></textarea>
                            </div>
                        </div>
                        <fieldset class='form-group'>
                            <div class='row'>
                                <legend class='col-sm-2 col-form-label pt-0'>Note</legend>
                                <div class='col-sm-10'>
                                    <div class='form-check form-check-inline'>
                                        <input class='form-check-input' type='radio' name='grade' id='radio1' value='1' checked>
                                        <label class='form-check-label' for='radio1'>1</label>
                                    </div>
                                    <div class='form-check form-check-inline'>
                                        <input class='form-check-input' type='radio' name='grade' id='radio2' value='2'>
                                        <label class='form-check-label' for='radio1'>2</label>
                                    </div>
                                    <div class='form-check form-check-inline'>
                                        <input class='form-check-input' type='radio' name='grade' id='radio3' value='3'>
                                        <label class='form-check-label' for='radio1'>3</label>
                                    </div>
                                    <div class='form-check form-check-inline'>
                                        <input class='form-check-input' type='radio' name='grade' id='radio4' value='4'>
                                        <label class='form-check-label' for='radio1'>4</label>
                                    </div>
                                    <div class='form-check form-check-inline'>
                                        <input class='form-check-input' type='radio' name='grade' id='radio5' value='5'>
                                        <label class='form-check-label' for='radio1'>5</label>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-outline-primary my-btn" name='send'>Envoyer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <?php endif; ?>
        <div class='row'>
            <?php include_once '../inc/footer.php'; ?>
        </div>
    </div>
</body>

</html>