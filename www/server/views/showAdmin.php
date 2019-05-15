<!--
Titre : Page d'administration des nouvelles annonces
Date : 9 mai 2019
Auteur : Romain Peretti
Version : 1.0
Description : La vue de la page d'administration contenant un tableaux avec toutes les nouvelles annonces en attente d'être validée
-->
<!DOCTYPE html>
<html>

<head>
    <?php include_once '../inc/head.php'; ?>
</head>

<body>
    <div class='container col-md-12'>
        <div class='row'>
            <?php include_once '../inc/navbar.php'; ?>
        </div>
        <div class='row justify-content-center'>
            <div class='col-md-10'>
                <?php if (isset($ads)) : ?>
                    <table class='table table-striped'>
                        <thead>
                            <th scope='col'>Titre</th>
                            <th scope='col'>Description</th>
                            <th scope='col'>Date</th>
                            <th scope='col'>Annonceur</th>
                            <th scope='col'>#</th>
                        </thead>
                        <tbody>
                            <?php foreach ($ads as $ad) :
                                $u = UserManager::GetUserByEmail($ad->userEmail)
                                ?>
                                <tr>
                                    <td><?= $ad->title ?></td>
                                    <td><?= $ad->description ?></td>
                                    <td><?= date_format(date_create($ad->creationDate), 'd M Y \à H:i:s') ?></td>
                                    <td><?= $u->email ?></td>
                                    <td>
                                        <a class='btn btn-outline-primary myBtn' href='../controllers/adDetails.php?idAd=<?= $ad->idAdvertisement ?>'>Détails</a>
                                        <a class='btn btn-outline-success myBtn' href='../controllers/admin.php?idAd=<?= $ad->idAdvertisement ?>'>Valider</a>
                                        <a class='btn btn-outline-danger myBtn' href='../controllers/deleteAd.php?idAd=<?= $ad->idAdvertisement ?>'>Supprimer</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else : ?>
                    <h1 class='text-center'>Aucune nouvelles annonces</h1>
                <?php endif; ?>
            </div>
        </div>
        <div class='row'>
            <?php include_once '../inc/footer.php'; ?>
        </div>
    </div>
</body>

</html>