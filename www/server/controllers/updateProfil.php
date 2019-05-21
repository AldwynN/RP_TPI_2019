<?php
/*
Titre : Contrôleur de la modification du profil
Date : Mardi, 14 mai 2019
Auteur : Romain Peretti
Version : 1.0
Description : Cette page inclut la vue.
*/

require_once '../inc/inc.all.php';

$email = filter_input(INPUT_GET, 'email', FILTER_SANITIZE_STRING);

$u = UserManager::GetUserByEmail($email);

if ($_SESSION['email'] != $email) {
    header('Location: home.php');
}

if (isset($_POST['send'])) {

    $state;
    $finalPwd;

    $pwd  = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    if (sha1($pwd . $u->salt) == $u->password) {
        $newPwd  = filter_input(INPUT_POST, 'newPassword', FILTER_SANITIZE_STRING);
        $repeatNewPwd  = filter_input(INPUT_POST, 'repeatNewPassword', FILTER_SANITIZE_STRING);

        if ($newPwd != "" && $repeatNewPwd != "") {
            if ($newPwd == $repeatNewPwd) {
                // Changement du MDP
                $finalPwd = $newPwd;
                $state = OK;
            } else {
                // Erreur répétition du nouveau MDP
                $state = NEW_PWD_NOT_EQUAL;
            }
        } else {
            // Pas de changement du MDP
            $finalPwd = $pwd;
            $state = OK;
        }
    } else {
        // Erreur de MDP
        $state = PWD_NOT_VALID;
    }

    switch ($state) {
        case OK:
            $canton  = filter_input(INPUT_POST, 'canton', FILTER_SANITIZE_STRING);
            $city  = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
            $postCode  = filter_input(INPUT_POST, 'postCode', FILTER_SANITIZE_STRING);
            $streetAndNumber  = filter_input(INPUT_POST, 'streetAndNumber', FILTER_SANITIZE_STRING);
            $description  = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);

            $u = new User($_SESSION['email'], $finalPwd, $city, $canton, $postCode, $streetAndNumber, $description, null, null);

            if (UserManager::UpdateUser($u)) {
                echo '<div class="alert alert-success mb-0" role="alert">Modification effectuée, en attente de redirection</div>';
                echo '<meta http-equiv="refresh" content="1;URL=profil.php?email=' . $_SESSION['email'] . '">';
            } else {
                echo '<div class="alert alert-danger mb-0" role="alert">Message d\'erreur : "Erreur lors de la modification"</div>';
            }
            break;
        case PWD_NOT_VALID:
            echo '<div class="alert alert-danger mb-0" role="alert">Message d\'erreur : "Le mot de passe actuel est faux"</div>';
            break;
        case NEW_PWD_NOT_EQUAL:
            echo '<div class="alert alert-danger mb-0" role="alert">Message d\'erreur : "Les nouveaux mot de passe ne sont pas les mêmes"</div>';
            break;
    }
}

$pageName = 'Modification de votre profil';

include_once '../views/showUpdateProfil.php';
