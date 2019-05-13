<?php
session_start();


$_SESSION['email'] = 'romain.prtt@eduge.ch';
/*
$_SESSION['name'] = "Romain Peretti";
$_SESSION['connected'] = false;
*/

require_once '../database/database.php';

require_once '../classes/Advertisement.php';
require_once '../classes/User.php';
require_once '../classes/Rating.php';
require_once '../classes/Picture.php';

require_once '../managers/advertisementManager.php';
require_once '../managers/userManager.php';
require_once '../managers/ratingManager.php';
require_once '../managers/pictureManager.php';