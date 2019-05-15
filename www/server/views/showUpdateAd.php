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

                    </div>
                    <div class='form-group'>
                        <input type="submit" class="btn btn-primary" name="send" value='Modifier'>
                    </div>
                </form>
                <?php foreach ($pictures as $p) : ?>
                    <div class='text-center col-lg-4'>
                        <img src='<?= $p->picture ?>' class='' style='max-height: 250px; max-width: 300px' alt='imgProduct'>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-outline-danger my-btn" data-toggle="modal" data-target="#exampleModal<?= $p->idPicture ?>">
                            X
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal<?= $p->idPicture ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel" style='color:black;'>Êtes-vous sur de vouloir supprimer cette image ?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-footer">
                                        <form method='POST'>
                                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Fermer</button>
                                            <input type="submit" class="btn btn-outline-danger" value='Confirmer' name='delete'>
                                            <input type='hidden' name='idPic' value='<?= $p->idPicture ?>'>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class='row'>
            <?php include_once '../inc/footer.php'; ?>
        </div>
    </div>
</body>
<script>
    $('#myModal').on('shown.bs.modal', function() {
        $('#myInput').trigger('focus')
    });
</script>


</html>