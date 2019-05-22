<?php
/*
Titre : Manageur des images
Date : Lundi, 13 mai 2019
Auteur : Romain Peretti
Version : 1.0
Description : Cette classe contient toutes les fonctions en rapport avec les images utilisées sur le site.
              Chaque fonctions envoie une requête SQL
*/

require_once '../database/database.php';
require_once '../classes/Picture.php';

class PictureManager
{
    /**
     * @brief Retourne l'annonce que l'on recherche par l'identifiant de son annonceur
     * @param int idPicture L'id de l'image qu'on recherche.
     * @return [Picture] L'image de type "Picture".
     * 		   False Une erreur est survenue.
     *         Null Aucune image.
     */
    public static function GetPictureById($idPicture)
    {
        $p = null;

        $req = 'SELECT idPicture, picture, idAdvertisement FROM pictures WHERE idPicture = :id';
        $statement = Database::prepare($req);

        try {
            $statement->execute(array(':id' => $idPicture));
        } catch (PDOException $e) {
            return false;
        }

        //Récupératin le premier élément
        if ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
            $p = new Picture($row['idPicture'], $row['picture'], $row['idAdvertisement']);
        }

        return $p;
    }

    /**
     * @brief Retourne les images en rapport avec l'annonce spécifié
     * @param int idPicture L'id de l'annonce qu'on recherche.
     * @return array Un tableau contenant toutes les images.
     * 		   False Une erreur est survenue.
     */
    public static function GetPicturesByAdId($idAd)
    {
        $arr = array();

        //Initialisation de la requête
        $req = 'SELECT idPicture, picture, idAdvertisement FROM pictures WHERE idAdvertisement = :id';
        $statement = Database::prepare($req);

        try {
            $statement->execute(array(':id' => $idAd));
        } catch (PDOException $e) {
            return false;
        }

        //Tant qu'il y a des entrées
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            //On crée une variable de la classe Picture
            $p = new Picture($row['idPicture'], $row['picture'], $row['idAdvertisement']);
            //Et on l'ajoute dans le tableau qu'on retourne à la fin
            array_push($arr, $p);
        }

        return $arr;
    }

    /**
     * @brief Ajout d'une image
     * @param int idAd L'id de l'annonce auquel est lié l'image.
     * @return boolean True Ok.
     * 		           False Une erreur est survenue.
     */
    public static function CreatePicture($idAd)
    {
        for ($i = 1; $i <= count($_FILES['pictures']['name']); $i++) {

            // Index pour la superglobal $_FILES car on commence avec $i = 1
            $index = $i - 1;

            // Si la taille de fichier est inférieure à 3 Mo et que son extension fait partie des extensions autorisés
            if ($_FILES['pictures']['size'][$index] < MAX_FILE_SIZE && in_array($_FILES['pictures']['type'][$index], EXTENSION_AUTHORIZED)) {

                // vérification que le transfert c'est bien déroulé
                if (!isset($_FILES['pictures']['name'][$index]) || !is_uploaded_file($_FILES['pictures']['tmp_name'][$index])) {
                    echo ('<div class="alert alert-danger mb-0" role="alert">Probleme de transfert - fichier(s) invalide(s)</div>');
                    return false;
                }
                // Récupération du fichier temporaire
                $data = file_get_contents($_FILES['pictures']['tmp_name'][$index]);
                // Récupération du MIME
                $finfo = new finfo(FILEINFO_MIME_TYPE); //Pas oublier dans php.ini de dé-commenter "extension=php_fileinfo.dll"
                $mime = $finfo->file($_FILES['pictures']['tmp_name'][$index]);
                // Création de la chaine en base 64
                $src = 'data:' . $mime . ';base64,' . base64_encode($data);

                // Initialisation de la requête
                $req = 'INSERT INTO pictures(picture, idAdvertisement) VALUES (:p, :id)';
                $statement = Database::prepare($req);

                try {
                    if ($statement->execute(array(':p' => $src, ':id' => $idAd))) {
                        if (count($_FILES['pictures']['name']) == $i) {
                            return true;
                        }
                    }
                } catch (PDOException $e) {
                    return false;
                }
            }
        }
    }

    /**
     * @brief Suppression d'une image
     * @param int idPictu re L'id de l'image à supprimer.
     * @return boolean True Ok.
     *                    False Une erreur est survenue.
     */
    public static function DeletePicture($idPicture)
    {
        //Initialisation de la requête
        $req = 'DELETE FROM pictures WHERE idPicture = :id';
        $statement = Database::prepare($req);

        try {
            $statement->execute(array(':id' => $idPicture));
        } catch (PDOException $e) {
            return false;
        }

        return true;
    }

    /**
     * @brief Suppression des images lié à une annonce
     * @param int idAd L'id de l'annonce.
     * @return boolean True Ok.
     * 		           False Une erreur est survenue.
     */
    public static function DeletePicturesOfAnAd($idAd)
    {
        //Initialisation de la requête
        $req = 'DELETE FROM pictures WHERE idAdvertisement = :id';
        $statement = Database::prepare($req);
        try {
            $statement->execute(array(':id' => $idAd));
        } catch (PDOException $e) {
            return false;
        }
        return true;
    }
}
