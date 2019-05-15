<?php
/*
Titre : Contrôleur de la modification d'une annonce
Date : Mardi, 14 mai 2019
Auteur : Romain Peretti
Version : 1.0
Description : Cette page inclut la vue.
*/

require_once '../inc/inc.all.php';

if (isset($_GET['idAd'])) {
    $idAd = filter_input(INPUT_GET, 'idAd', FILTER_SANITIZE_NUMBER_INT);
}

$ad = AdvertisementManager::GetAdById($idAd);
$pictures = PictureManager::GetPicturesByAdId($idAd);

if (isset($_POST['send'])) {
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
    $organic = filter_input(INPUT_POST, 'organic');

    $a = new Advertisement($ad->idAdvertisement, $title, $description, (isset($organic) ? 1 : 0), null, null, $ad->userEmail);
    $result = AdvertisementManager::UpdateAd($a);
    if ($result === false) {
        echo '<div class="alert alert-danger mb-0" role="alert">Message d\'erreur : "Erreur lors de la modification"</div>';
    }
    if ($result) {
        echo '<div class="alert alert-success mb-0" role="alert">Modification d\'une annonce réussi</div>';
        echo '<meta http-equiv="refresh" content="2;URL=home.php">';
    }
}

if(isset($_POST['delete'])){
    if (isset($_POST['idPic'])) {
        $idPic = filter_input(INPUT_POST, 'idPic', FILTER_SANITIZE_NUMBER_INT);
    
        PictureManager::DeletePicture($idPic);
        
        echo '<div class="alert alert-success mb-0" role="alert">Image en cours de suppression</div>';
        echo '<meta http-equiv="refresh" content="2;URL=updateAd.php?idAd=' . $idAd . '">';
    }
}

$pageName = 'Modification d\'une annonce';

include_once '../views/showUpdateAd.php';
