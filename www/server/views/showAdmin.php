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
            <div class='col-md-10 mb-5'>
                <?php if (count($ads) > 0) : ?>
                    <div class='text-center'>
                        <h2>Annonce en attente de validation</h2>
                    </div>
                    <table class='table table-striped m-2'>
                        <thead>
                            <th scope='col'>#</th>
                            <th scope='col'>Titre</th>
                            <th scope='col'>Description</th>
                            <th scope='col'>Date</th>
                            <th scope='col'>Annonceur</th>
                            <th scope='col'></span></th>
                        </thead>
                        <tbody>
                            <?php foreach ($ads as $ad) :
                                $u = UserManager::GetUserByEmail($ad->userEmail);
                                $adsNumber++;
                                ?>
                                <tr class='my-tr'>
                                    <th scope='row'><?= $adsNumber ?></th>
                                    <td><?= $ad->title ?></td>
                                    <td><?= $ad->description ?></td>
                                    <td><?= date_format(date_create($ad->creationDate), 'd M Y \à H:i:s') ?></td>
                                    <td><?= $u->email ?></td>
                                    <td class='text-center'>
                                        <a class='btn btn-outline-primary my-btn' href='../controllers/adDetails.php?idAd=<?= $ad->idAdvertisement ?>'><span class='fas fa-stream'></span></a>
                                        <a class='btn btn-outline-success my-btn' href='../controllers/admin.php?idAd=<?= $ad->idAdvertisement ?>'><span class='fas fa-check'></span></a>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-outline-danger my-btn" data-toggle="modal" data-target="#exampleModal<?= $ad->idAdvertisement ?>"><span class='fas fa-trash-alt'></span></button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal<?= $ad->idAdvertisement ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel" style='color:black;'>Êtes-vous sur de vouloir supprimer cette annonce ?</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form method='POST'>
                                                            <button type="button" class="btn btn-outline-secondary " data-dismiss="modal">Fermer</button>
                                                            <input type="submit" class="btn btn-outline-danger" value='Confirmer' name='delete'>
                                                            <input type='hidden' name='idAd' value='<?= $ad->idAdvertisement ?>'>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
        <div class='row justify-content-center'>
            <div class='col-md-10'>
                <?php if (count($users) > 0) : ?>
                    <div class='text-center'>
                        <h2>Liste des utilisateurs enregistrés</h2>
                    </div>
                    <table class='table table-striped m-2'>
                        <thead>
                            <th scope='col'>#</th>
                            <th scope='col'>Email</th>
                            <th scope='col'>Ville</th>
                            <th scope='col'>Canton</th>
                            <th scope='col'>Rue et N°</th>
                            <th scope='col'>Description</th>
                            <th scope='col' class='text-center'>Admin ?</th>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $u) :
                                $usersNumber++;
                                ?>
                                <tr class='my-tr'>
                                    <th scope='row'><?= $usersNumber ?></th>
                                    <td><?= $u->email ?></td>
                                    <td><?= $u->city ?></td>
                                    <td><?= $u->canton ?></td>
                                    <td><?= $u->streetAndNumber ?></td>
                                    <td><?= $u->description ?></td>
                                    <td class='text-center'>
                                        <form method='POST'>
                                            <?php if ($u->roleCode == USER_CODE) : ?>
                                                <button type='submit' name='updateToAdmin' class='btn btn-outline-success my-btn'>
                                                    <span class='fas fa-check'></span>
                                                </button>
                                                <input type='hidden' name='userEmail' value='<?= $u->email ?>'>
                                            <?php else : ?>
                                                <button type='submit' name='updateToUser' class='btn btn-outline-danger my-btn'>
                                                    <span class='fas fa-times'></span>
                                                </button>
                                                <input type='hidden' name='userEmail' value='<?= $u->email ?>'>
                                            <?php endif; ?>

                                        </form>
                                    </td>
                                <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
        <div class='row'>
            <?php include_once '../inc/footer.php'; ?>
        </div>
    </div>
</body>
<script>
    $('#myModal').on('shown.bs.modal', function() {
        $('#myInput').trigger('focus')
    });
</script>

</html>