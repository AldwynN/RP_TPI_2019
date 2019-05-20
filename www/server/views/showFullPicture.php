<?php
require_once '../inc/inc.all.php';

$idPic = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$p = PictureManager::GetPictureById($idPic);
?>

<!DOCTYPE html>
<html>
<head>
    <?php 
    $pageName = 'Image';
    include_once '../inc/head.php';
    ?>
</head>
<body>
    <div class='row col-12 justify-content-center'>
        <div style='margin-top: 50vh;transform: translateY(-50%);'>
            <img src='<?= $p->picture ?>' class='mx-auto d-block'>
        </div>
    </div>
</body>

</html>