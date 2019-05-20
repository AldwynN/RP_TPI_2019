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
    <?php include_once '../inc/head.php'; ?>
</head>

<body>
    <div class='container col-md-12'>
        <div class='row'>
            <?php include_once '../inc/navbar.php'; ?>
        </div>
        <div class='row justify-content-center'>
            <div class="col-md-8">
                <div class="media-body">
                    <form method="POST" class='m-4'>
                        <div class="form-group">
                            <label for="newPassword">Nouveau mot de passe</label>
                            <input type="password" class="form-control my-input" name="newPassword" id="newPassword">
                        </div>
                        <div class="form-group">
                            <label for="repeatNewPassword">Confirmer le mot de passe</label>
                            <input type="password" class="form-control my-input" name="repeatNewPassword" id="repeatNewPassword">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="canton">Canton</label>
                                    <input type="text" class="form-control my-input" name="canton" id="canton" required value='<?= $u->canton ?>'>
                                </div>
                                <div class="col-md-6">
                                    <label for="city">Ville</label>
                                    <input type="text" class="form-control my-input" name="city" id="city" required value='<?= $u->city ?>'>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="postCode">Code postal</label>
                                    <input type="text" class="form-control my-input" name="postCode" id="postCode" required value='<?= $u->postCode ?>'>
                                </div>
                                <div class="col-md-9">
                                    <label for="streetAndNumber">Rue et numéro</label>
                                    <input type="text" class="form-control my-input" name="streetAndNumber" id="streetAndNumber" required value='<?= $u->streetAndNumber ?>'>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control my-input" id="description"><?= $u->description ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="password">Entrez votre mot de passe actuel pour appliquer les modifications</label>
                            <input type="password" class="form-control my-input" name="password" id="password" required> 
                        </div>
                        <button type="submit" class="btn btn-outline-primary my-btn" name="send">Modifier</button>
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