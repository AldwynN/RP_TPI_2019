<?php
/*
Titre : Controlleur de l'inscription
Date : Lundi, 13 mai 2019
Auteur : Romain Peretti
Version : 1.0
Description : Cette page inclut la création d'une annonce avec le formulaire et la vue
*/

require_once '../inc/inc.all.php';

if (isset($_POST['send'])) {

    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $repeatPassword = filter_input(INPUT_POST, 'repeatPassword', FILTER_SANITIZE_STRING);
    if ($password == $repeatPassword) {

        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $canton = filter_input(INPUT_POST, 'canton', FILTER_SANITIZE_STRING);
            $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
            $postCode = filter_input(INPUT_POST, 'postCode', FILTER_SANITIZE_STRING);
            $streetAndNumber = filter_input(INPUT_POST, 'streetAndNumber', FILTER_SANITIZE_STRING);
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);

            $u = new User($email, $password, $city, $canton, $postCode, $streetAndNumber, $description, null, null);
            $result = UserManager::CreateUser($u);

            if ($result === false) {
                echo '<div class="alert alert-danger mb-0" role="alert">Message d\'erreur : "Erreur lors de la création"</div>';
            }
            if ($result === null) {
                echo '<div class="alert alert-danger mb-0" role="alert">Cet email est déjà utilisé</div>';
            }
            if ($result) {
                echo '<div class="alert alert-success mb-0" role="alert">Compte créé, en attente de redirection</div>';
                echo '<meta http-equiv="refresh" content="1;URL=login.php">';
            }
        } else {
            echo '<div class="alert alert-danger mb-0" role="alert">Veuillez rentrer un email valide</div>';
        }
    } else {
        echo '<div class="alert alert-danger mb-0" role="alert">Les mots de passe ne sont pas pareil</div>';
    }
}

$pageName = 'Inscription';

include_once '../views/showSignIn.php';
