<!--
Titre : Page de détails de l'utilisateur
Date : 9 mai 2019
Auteur : Romain Peretti
Version : 1.0
Description : La vue de la page connexion contenant les détails de l'utilisateur ainsi que toutes ses annonces
-->
<!DOCTYPE html>
<html>

<head>
    <title>Détails de votre compte</title>
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
            <div class='media border col-md-10'>
                <div class='media-body'>
                    <h2>romain.prtt@eduge.ch</h2>
                    <p>Ville : </p>
                    <p>Canton : </p>
                    <p>Code postal : </p>
                    <p>Rue et n° : </p>
                    <p class='text-justify'>Description : </p>
                    <div class='row justify-content-end'>
                        <a class='btn btn-warning' href='#'>Modifier</a>
                        <a class='btn btn-danger' href='#'>Supprimer</a>
                    </div>
                </div>
            </div>
        </div>
        <div class='row justify-content-center'>
            <div class='media border rounded col-md-10'>
                <div class='media-body'>
                    <h2>Farine de blé</h2>
                    <p class='text-justify'>Farine de blé composé à 95% ...</p>
                    <input type='radio' id='bio' checked>
                    <label for='bio'>Produit bio</label>
                    <p>Vente au Joseph-Berthet 14, 1232 Genève</p>
                    <p>Posté le 28 mars 2019 à 11h30</p>
                    <div class='row justify-content-end'>
                        <a class='btn btn-primary' href='#'>Détails</a>
                        <a class='btn btn-warning' href='#'>Modifier</a>
                        <a class='btn btn-danger' href='#'>Supprimer</a>
                    </div>
                </div>
            </div>
        </div>
        <div class='row'>
            <?php include_once '../inc/footer.php'; ?>
        </div>
    </div>
</body>

</html>