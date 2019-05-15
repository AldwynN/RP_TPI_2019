<!--
Titre : Page de création d'une annonce
Date : 8 mai 2019
Auteur : Romain Peretti
Version : 1.0
Description : La vue de la page de création d'une annonce contenant le formulaire à remplir
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
            <div class='col-md-6'>
                <form method='POST' enctype='multipart/form-data' class='m-4'>
                    <div class="form-group">
                        <label for="title">Titre</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="Salade Romaine" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" id="description" required></textarea>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="organic" id="organic" value="true">
                        <label for="organic">Produit bio</label>
                    </div>
                    <div class="form-group">
                        <label for="file">Image(s) du produit</label>
                        <input type="file" class="form-control-file" id="file" name='pictures[]' accept='image/jpeg, image/png, image/jpg' multiple>
                    </div>
                    <button type="submit" class="btn btn-primary" name="send">Créer</button>
                </form>
            </div>
        </div>
        <div class='row'>
            <?php include_once '../inc/footer.php'; ?>
        </div>
    </div>
</body>

</html>