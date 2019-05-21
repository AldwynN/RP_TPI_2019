<?php
/*
Titre : Contrôleur du profil
Date : Lundi, 13 mai 2019
Auteur : Romain Peretti
Version : 1.0
Description : Cette page récupère tous les fichiers nécessaire pour le site
*/

//Démarrage de la session
session_start();

//Variables de session pour éviter de se reconnecter tous le temps
//$_SESSION['email'] = 'romain.prtt@eduge.ch';
//$_SESSION['role'] = '2';

// Fichier de connexion à la base
require_once '../database/database.php';

// Fichier de constantes
require_once '../constants/constants.php';

// Classes
require_once '../classes/Advertisement.php';
require_once '../classes/User.php';
require_once '../classes/Rating.php';
require_once '../classes/Picture.php';

// Manageurs
require_once '../managers/advertisementManager.php';
require_once '../managers/userManager.php';
require_once '../managers/ratingManager.php';
require_once '../managers/pictureManager.php';