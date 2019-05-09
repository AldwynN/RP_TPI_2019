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

        $req = 'SELECT idPicture, picture, idAdvertisement WHERE idPicture = :id';
        $statement = Database::prepare($req);

        try {
            $statement->execute(array(':id' => $idPicture));
        } catch (PDOException $e) {
            echo 'Problème de lecture de la base de données: ' . $e->getMessage();
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
        $req = 'SELECT idPicture, picture, idAdvertisement WHERE idAdvertisement = :id';
        $statement = Database::prepare($req);

        try {
            $statement->execute(array(':id' => $idAd));
        } catch (PDOException $e) {
            echo 'Problème de lecture de la base de données: ' . $e->getMessage();
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
     * @param [Picture] L'objet "Picture".
     * @return boolean True Ok.
     * 		           False Une erreur est survenue.
     */
    public static function CreatePicture($p)
    {
        //Initialisation de la requête
        $req = 'INSERT INTO picture (picture, idAdvertisement) VALUES (:p, :id)';
        $statement = Database::prepare($req);

        try {
            $statement->execute(array(
                ':t' => $p->picture,
                ':d' => $p->idAdvertisement
            ));
        } catch (PDOException $e) {
            echo 'Problème de lecture de la base de données: ' . $e->getMessage();
            return false;
        }

        return true;
    }

    /**
     * @brief Suppression d'une image
     * @param int idPicture L'id de l'image à supprimer.
     * @return boolean True Ok.
     * 		           False Une erreur est survenue.
     */
    public static function DeletePicture($idPicture)
    { 
        //Initialisation de la requête
        $req = 'DELETE FROM picture WHERE idPicture = :id';
        $statement = Database::prepare($req);

        try {
            $statement->execute(array(':id' => $idPicture));
        } catch (PDOException $e) {
            echo 'Problème de lecture de la base de données: ' . $e->getMessage();
            return false;
        }

        return true;
    }
}
