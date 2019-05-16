<!--
Titre : Page de suppression d'une annonce
Date : 8 mai 2019
Auteur : Romain Peretti
Version : 1.0
Description : La vue de la page de suppression d'une annonce contenant un formulaire de validation
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
                <form method='POST' class='m-4'>
                    <fieldset class='form-group'>
                        <legend class='col-form-label'>Voulez-vous vraiment supprimer l'annonce intitulée '<?= $a->title ?>' ?</legend>
                        <div class="form-row">
                            <a href='../controllers/adDetails.php?idAd=<?= $a->idAdvertisement ?>' class='btn btn-outline-primary my-btn'>Annuler</a>
                            <input type='submit' class='btn btn-outline-danger my-btn' name='send' value='Confirmer'>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
        <div class='row'>
            <?php include_once '../inc/footer.php'; ?>
        </div>
    </div>
</body>

</html>