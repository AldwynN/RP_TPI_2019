<!--
Titre : Page de modification de son profil
Date : 9 mai 2019
Auteur : Romain Peretti
Version : 1.0
Description : La vue de la page de modification de son profil contenant le formulaire rempli avec les données de la base
-->
<!DOCTYPE html>
<html>

<head>
    <title>Modification de votre profil</title>
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
                    <form method="POST">
                        <div class="form-group">
                            <label for="newPassword">Nouveau mot de passe</label>
                            <input type="password" class="form-control" name="newPassword" id="newPassword">
                        </div>
                        <div class="form-group">
                            <label for="repeatNewPassword">Confirmer le mot de passe</label>
                            <input type="password" class="form-control" name="repeatNewPassword" id="repeatNewPassword">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="canton">Canton</label>
                                    <input type="text" class="form-control" name="canton" id="canton" required value='<?= $u->canton ?>'>
                                </div>
                                <div class="col-md-6">
                                    <label for="city">Ville</label>
                                    <input type="text" class="form-control" name="city" id="city" required value='<?= $u->city ?>'>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="postCode">Code postal</label>
                                    <input type="text" class="form-control" name="postCode" id="postCode" required value='<?= $u->postCode ?>'>
                                </div>
                                <div class="col-md-9">
                                    <label for="streetAndNumber">Rue et numéro</label>
                                    <input type="text" class="form-control" name="streetAndNumber" id="streetAndNumber" required value='<?= $u->streetAndNumber ?>'>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" id="description"><?= $u->description ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="password">Entrez votre mot de passe actuel pour appliquer les modifications</label>
                            <input type="password" class="form-control" name="password" id="password" required> 
                        </div>
                        <button type="submit" class="btn btn-primary" name="send">Modifier</button>
                    </form>
                </div>
            </div>
        </div>
        <div class='row'>
            <?php include_once '../inc/footer.php'; ?>
        </div>
    </div>
</body>

</html>