<?php
session_start();

/*
$_SESSION['idUser'] = 1;
$_SESSION['name'] = "Romain Peretti";
$_SESSION['connected'] = false;
*/

require_once $_SERVER['DOCUMENT_ROOT'] . '/DirectProd/server/database/database.php';

require_once 'constante.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/DirectProd/server/class/Advertisement.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/DirectProd/server/class/User.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/DirectProd/server/class/Rating.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/DirectProd/server/manager/advertisementManager.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/DirectProd/server/manager/userManager.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/DirectProd/server/manager/ratingManager.php';
