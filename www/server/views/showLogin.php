<!--
Titre : Page de connexion
Date : 8 mai 2019
Auteur : Romain Peretti
Version : 1.0
Description : La vue de la page connexion contenant un formulaire
-->
<!DOCTYPE html>
<html>

<head>
    <title>Connexion</title>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <!-- Bootstrap CSS & JS -->
    <link href='../../css/bootstrap/css/bootstrap.min.css' rel='stylesheet' type='text/css' />
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'></script>
    <script src='../../css/bootstrap/js/bootstrap.min.js' type='text/javascript'></script>
</head>

<body>
    <div class='container col-md-12'>
        <div class='row'>
            <?php include_once '../inc/navbar.php'; ?>
        </div>
        <div class='row justify-content-center'>
            <div class='col-md-6'>
                <form method='POST' >
                    <div class='form-group'>
                        <label for='email'>Adresse email</label>
                        <input type='email' class='form-control' name='email' id='email' placeholder='Entrez un email valide'>
                    </div>
                    <div class='form-group'>
                        <label for='password'>Mot de passe</label>
                        <input type='password' class='form-control' name='password' id='password'>
                    </div>
                    <div class='form-group'>
                        <small><a href='../controllers/signIn.php'>Pas encore de compte ?</a></small>
                    </div>
                    <button type='submit' class='btn btn-primary' name='send'>Connexion</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>