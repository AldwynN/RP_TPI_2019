<!--
Titre : Page de suppression d'un utilisateur
Date : 9 mai 2019
Auteur : Romain Peretti
Version : 1.0
Description : La vue de la page de suppression d'une annonce contenant un formulaire de validation
-->
<!DOCTYPE html>
<html>

<head>
    <title>Suppression de votre compte</title>
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
            <div class='col-md-6'>
                <form method='POST'>
                    <fieldset class='form-group'>
                        <legend class='col-form-label'>Voulez-vous vraiment supprimer votre compte (<?= $u->email ?>) ?</legend>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="radio" id="radioYes" value="yes">
                            <label class="form-check-label" for="radioYes">Oui</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="radio" id="radioNo" value="no" checked>
                            <label class="form-check-label" for="radioNo">Non</label>
                        </div>
                    </fieldset>
                    <button type='submit' class='btn btn-primary' name='send'>Supprimer</button>
                </form>
            </div>
        </div>
        <div class='row'>
            <?php include_once '../inc/footer.php'; ?>
        </div>
    </div>
</body>

</html>