<!--
Titre : Page d'inscription
Date : 8 mai 2019
Auteur : Romain Peretti
Version : 1.0
Description : La vue de la page d'inscription contenant un formulaire
-->
<!DOCTYPE html>
<html>

<head>
    <title>Inscription</title>
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
            <div class="col-md-8">
                <div class="media-body">
                    <form method="POST" action="../controllers/signIn.php">
                        <div class="form-group">
                            <label for="email">Adresse email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Entrez un email valide">
                        </div>
                        <div class="form-group">
                            <label for="password">Mot de passe</label>
                            <input type="password" class="form-control" name="password" id="password">
                        </div>
                        <div class="form-group">
                            <label for="repeatPassword">Confirmer le mot de passe</label>
                            <input type="password" class="form-control" name="repeatPassword" id="repeatPassword">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="canton">Canton</label>
                                    <input type="text" class="form-control" name="canton" id="canton" placeholder="Vaud">
                                </div>
                                <div class="col-md-6">
                                    <label for="city">Ville</label>
                                    <input type="text" class="form-control" name="city" id="city" placeholder="Lausanne">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="postCode">Code postal</label>
                                    <input type="text" class="form-control" name="postCode" id="postCode" placeholder="1007">
                                </div>
                                <div class="col-md-9">
                                    <label for="streetAndNumber">Rue et numéro</label>
                                    <input type="text" class="form-control" name="streetAndNumber" id="streetAndNumber" placeholder="14 Rue Jean-Dujardin">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" rows="5" cols="40" id="description"></textarea>
                        </div>
                        <div class="form-group">
                            <small><a href="../controllers/login.php">Déjà un compte ?</a></small>
                        </div>
                        <button type="submit" class="btn btn-primary" name="send">Inscription</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>