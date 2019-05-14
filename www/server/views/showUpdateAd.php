<!--
Titre : Page de modification d'une annonce
Date : 8 mai 2019
Auteur : Romain Peretti
Version : 1.0
Description : La vue de la page de modification d'une annonce contenant le formulaire rempli avec les données de la base
-->
<!DOCTYPE html>
<html>

<head>
    <title>Modification d'une annonce</title>
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
                        <input type="text" class="form-control" name="title" id="title" required value='<?= $ad->title ?>'>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" id="description" required><?= $ad->description ?></textarea>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="organic" id="organic" value="true" <?= ($ad->organic == 1 ? 'checked' : '') ?>>
                        <label for="organic">Produit bio</label>
                    </div>
                    <div class="form-group">
                        <label for="file">Image(s) du produit</label>
                        <input type="file" class="form-control-file" id="file" name='pictures[]' accept='image/jpeg, image/png, image/jpg' multiple>
                    </div>
                    <div class='form-row'>
                        <?php foreach ($pictures as $p) : ?>
                            <div class='text-center col-md-3'>
                                <div class='card'>
                                    <img src='<?= $p->picture ?>' class='card-img-top mx-auto d-block' style='max-height: 125px; max-width: 125px' alt='imgProduct'>
                                    <div class='card-body'>
                                        <button class='btn btn-danger' id='delete' name='<?= $p->idPicture ?>'>X</button>
                                    </div>
                                </div>
                            </div>


                        <?php endforeach; ?>
                    </div>
                    <div class='form-group'>
                        <button type="submit" class="btn btn-primary" name="send">Modifier</button>
                    </div>
                </form>
            </div>
        </div>
        <div class='row'>
            <?php include_once '../inc/footer.php'; ?>
        </div>
    </div>
</body>
<script>
    const VALIDATE_URL = '';
    const ON_SUCCESS_URL = '';
    $(document).ready(function() {
        $('#delete').click(deletePicture)
    });

    function deletePicture(event){
        // Prevent form submission
        if (event) {
            event.preventDefault();
        }
        // Récupération de l'id de l'image à supprimer
$('#delete').name()
    }
</script>

</html>