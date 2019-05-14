<?php

require_once '../inc/inc.all.php';

header('Content-Type: application/json');

// Initialisation des variables
$email = '';
$password = '';

// Récupération des champs
if (isset($_POST['email'])) {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
}
if (isset($_POST['password'])) {
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
}

// Récupération de l'utilisateur
$result = UserManager::Login($email, $password);

if ($result === null) {
    // Utilisateur inconnue
    echo '{"ReturnCode": 1, "Message": "Email inconnu."}';
    exit();
}
if ($result) {
    $u = UserManager::GetUserByEmail($email);
    $_SESSION['email'] = $email;
    $_SESSION['role'] = $u->roles_code;
    echo '{"ReturnCode": 2, "Message": "Email et mot de passe valide"}';
    exit();
}

// Email ou mot de passe invalide
echo '{"ReturnCode": 0, "Message": "Email ou mot de passe invalide"}';
