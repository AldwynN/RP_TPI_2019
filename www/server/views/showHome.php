<!--
Titre : Page d'accueil
Date : 8 mai 2019
Auteur : Romain Peretti
Version : 1.0
Description : La vue de la page d'accueil contenant toutes les annonces valides
-->
<!DOCTYPE html>
<html>

<head>
    <title>Accueil</title>
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
        <div></div>
        <div class='row justify-content-center'>
            <div class='media border rounded col-md-10'>
                <div class='media-body'>
                    <h4>Farine de blé</h4>
                    <p class='text-justify'>Farine de blé composé à 95% ...</p>
                    <input type='radio' id='bio' checked>
                    <label for='bio'>Produit bio</label>
                    <p>Vente au Joseph-Berthet 14, 1232 Genève</p>
                    <p>Posté le 28 mars 2019 à 11h30</p>
                    <div class='row justify-content-end'>
                        <a class='btn btn-primary'>Détails</a>
                        <a class='btn btn-warning'>Modifier</a>
                        <a class='btn btn-danger'>Supprimer</a>
                    </div>
                </div>
            </div>
            <div class='media border rounded col-md-10'>
                <div class='media-body'>
                    <h4>Farine de blé</h4>
                    <p class='text-justify'>Farine de blé composé à 95% ...</p>
                    <input type='radio' id='bio' checked>
                    <label for='bio'>Produit bio</label>
                    <p>Vente au Joseph-Berthet 14, 1232 Genève</p>
                    <p>Posté le 28 mars 2019 à 11h30</p>
                    <div class='row justify-content-end'>
                        <a class='btn btn-primary'>Détails</a>
                        <a class='btn btn-warning'>Modifier</a>
                        <a class='btn btn-danger'>Supprimer</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>