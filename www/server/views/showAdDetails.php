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
    <title>Détails d'une annonce</title>
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
            <div class='media border rounded col-md-10'>
                <div class='media-body'>
                    <h2>Farine de blé</h2>
                    <p class='text-justify'>Farine de blé composé à 95% ...</p>
                    <input type='radio' id='bio' checked>
                    <label for='bio'>Produit bio</label>
                    <p>Vente au Joseph-Berthet 14, 1232 Genève</p>
                    <p>Posté le 28 mars 2019 à 11h30</p>
                    <div class='row justify-content-end'>
                        <a class='btn btn-warning'>Modifier</a>
                        <a class='btn btn-danger'>Supprimer</a>
                    </div>
                </div>
            </div>
        </div>
        <div class='row justify-content-center'>
            <div class='col-md-5 border'>
                <h4>romain.prtt@eduge.ch</h4>
                <p class='text-justify'>Cette farine est vraiment un délice, je l'ai utilisée pour en faire du bon pain !</p>
                <p>4/5</p>
            </div>
            <div class='col-md-5 border'>
                <h4>romain.prtt@eduge.ch</h4>
                <p class='text-justify'>Cette farine est vraiment un délice, je l'ai utilisée pour en faire du bon pain !</p>
                <p>4/5</p>
            </div>
            <div class='col-md-5 border'>
                <h4>romain.prtt@eduge.ch</h4>
                <p class='text-justify'>Cette farine est vraiment un délice, je l'ai utilisée pour en faire du bon pain !</p>
                <p>4/5</p>
            </div>
        </div>
        <div class='row justify-content-center'>
            <div class='col-md-5 border'>
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
                                <div class='form-check form-check-inline'>
                                    <input class='form-check-input' type='radio' name='grade' id='radio6' value='6'>
                                    <label class='form-check-label' for='radio1'>6</label>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary" name='send'>Envoyer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class='row'>
            <?php include_once '../inc/footer.php'; ?>
        </div>
    </div>
</body>

</html>