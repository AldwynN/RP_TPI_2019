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
    <title>Création d'une annonce</title>
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
                <form method='POST' enctype='multipart/form-data'>
                    <div class="form-group">
                        <label for="title">Titre</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="Salade Romaine">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" id="description"></textarea>
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