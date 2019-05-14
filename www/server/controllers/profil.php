<?php
/*
Titre : Contrôleur du profil
Date : Mardi, 14 mai 2019
Auteur : Romain Peretti
Version : 1.0
Description : Cette page inclut les détails de l'utilisateur et ses annonces
*/

require_once '../inc/inc.all.php';

$email =  filter_input(INPUT_GET, 'email', FILTER_SANITIZE_STRING);

$u = UserManager::GetUserByEmail($email);
$ads = AdvertisementManager::GetAdsByUserEmail($email);

include_once '../views/showProfil.php';