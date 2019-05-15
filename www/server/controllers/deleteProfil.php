<?php
/*
Titre : Contrôleur de la suppression du profil
Date : Mardi, 14 mai 2019
Auteur : Romain Peretti
Version : 1.0
Description : Cette page inclut la vue.
*/

require_once '../inc/inc.all.php';

$email = filter_input(INPUT_GET, 'email', FILTER_SANITIZE_STRING);

$u = UserManager::GetUserByEmail($email);

if (isset($_POST['send'])) {
    $radio = filter_input(INPUT_POST, 'radio');

    if (isset($radio) && $radio == 'yes') {
        $result = UserManager::DeleteUser($idAd);
        if ($result === false) {
            echo '<div class="alert alert-danger mb-0" role="alert">Message d\'erreur : "Erreur lors de la suppression"</div>';
        }
        if ($result) {
            echo '<div class="alert alert-success mb-0" role="alert">Suppression réussi, en attente de redirection</div>';
            echo '<meta http-equiv="refresh" content="2;URL=home.php">';
        }
    }
}

$pageName = 'Suppression de votre compte';

include_once '../views/showDeleteProfil.php';