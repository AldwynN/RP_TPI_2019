<?php
//Démarrage de la session
session_start();

//Variables de session pour éviter de se reconnecter tous le temps
//$_SESSION['email'] = 'romain.prtt@eduge.ch';
//$_SESSION['role'] = '2';

// Fichier de connexion à la base
require_once '../database/database.php';

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