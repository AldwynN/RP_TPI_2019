<?php
/*
Titre : Contrôleur de création d'une annonce
Date : Mardi, 15 mai 2019
Auteur : Romain Peretti
Version : 1.0
Description : Cette page inclut la vue.
*/

require_once '../inc/inc.all.php';

if (isset($_POST['send'])) {
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
    $organic = filter_input(INPUT_POST, 'organic', FILTER_SANITIZE_STRING);

    $a = new Advertisement(null, $title, $description, (isset($organic) ? 1 : 0), null, null, $_SESSION['email']);
    $result = AdvertisementManager::CreateAd($a);
    if ($result === false) {
        echo '<div class="alert alert-danger mb-0" role="alert">Message d\'erreur : "Erreur lors de la création"</div>';
    }
    if ($result) {
        echo '<div class="alert alert-success mb-0" role="alert">Création d\'une annonce réussi, en attente de redirection</div>';
        echo '<meta http-equiv="refresh" content="2;URL=home.php">';
    }
}

$pageName = 'Création d\'une annonce';

include_once '../views/showCreateAd.php';
