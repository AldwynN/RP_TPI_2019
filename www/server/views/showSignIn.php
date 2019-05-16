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
                    <form method="POST">
                        <div class="form-group">
                            <label for="email">Adresse email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Entrez un email valide" required value="<?= (isset($_POST['email']) ? $_POST['email'] : '') ?>">
                        </div>
                        <div class="form-group">
                            <label for="password">Mot de passe</label>
                            <input type="password" class="form-control" name="password" id="password" required>
                        </div>
                        <div class="form-group">
                            <label for="repeatPassword">Confirmer le mot de passe</label>
                            <input type="password" class="form-control" name="repeatPassword" id="repeatPassword" required>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="canton">Canton</label>
                                    <input type="text" class="form-control" name="canton" id="canton" placeholder="Vaud" required value="<?= (isset($_POST['canton']) ? $_POST['canton'] : '') ?>">
                                </div>
                                <div class=" col-md-6">
                                    <label for="city">Ville</label>
                                    <input type="text" class="form-control" name="city" id="city" placeholder="Lausanne" required value="<?= (isset($_POST['city']) ? $_POST['city'] : '') ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="postCode">Code postal</label>
                                    <input type="text" class="form-control" name="postCode" id="postCode" placeholder="1007" required value="<?= (isset($_POST['postCode']) ? $_POST['postCode'] : '') ?>">
                                </div>
                                <div class="col-md-9">
                                    <label for="streetAndNumber">Rue et numéro</label>
                                    <input type="text" class="form-control" name="streetAndNumber" id="streetAndNumber" placeholder="14 Rue Jean-Dujardin" required value="<?= (isset($_POST['streetAndNumber']) ? $_POST['streetAndNumber'] : '') ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" id="description"><?= (isset($_POST['description']) ? $_POST['description'] : '') ?></textarea>
                        </div>
                        <div class="form-group">
                            <small><a href="../controllers/login.php">Déjà un compte ?</a></small>
                        </div>
                        <button type="submit" class="btn btn-outline-primary my-btn" name="send">Inscription</button>
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