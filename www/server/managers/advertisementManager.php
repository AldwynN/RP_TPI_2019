<?php
/*
Titre : Manageur des annonces
Date : 9 mai 2019
Auteur : Romain Peretti
Version : 1.0
Description : Cette classe contient toutes les fonctions en rapport avec les annonces utilisées sur le site.
              Chaque fonctions envoie une requête SQL
*/

require_once '../database/database.php';
require_once '../classes/Advertisement.php';

class AdvertisementManager
{
    /**
     * @brief Retourne toutes les annonces validées par l'administrateur
     * @return array Un tableau contenant toutes les annonces de type "Advertisement".
     * 		   False Une erreur est survenue.
     */
    public static function GetValidatedAds()
    {
        $arr = array();

        //Initialisation de la requête
        $req = 'SELECT idAdvertisement, title, description, organic, valid, creationDate, email FROM advertisements WHERE valid = 1';
        $statement = Database::prepare($req);

        try {
            $statement->execute();
        } catch (PDOException $e) {
            echo 'Problème de lecture de la base de données: ' . $e->getMessage();
            return false;
        }

        //Tant qu'il y a des entrées
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            //On crée une variable de la classe Advertisement
            $a = new Advertisement($row['idAdvertisement'], $row['title'], $row['description'], $row['organic'], $row['valid'], $row['creationDate'], $row['email']);
            //Et on l'ajoute dans le tableau qu'on retourne à la fin
            array_push($arr, $a);
        }

        return $arr;
    }

    /**
     * @brief Retourne toutes les annonces non validées par l'administrateur
     * @return array Un tableau contenant toutes les annonces de type "Advertisement".
     * 		   False Une erreur est survenue.
     */
    public static function GetInvalidAds()
    {
        $arr = array();

        //Initialisation de la requête
        $req = 'SELECT idAdvertisement, title, description, organic, valid, creationDate, email FROM advertisements WHERE valid = 0';
        $statement = Database::prepare($req);

        try {
            $statement->execute();
        } catch (PDOException $e) {
            echo 'Problème de lecture de la base de données: ' . $e->getMessage();
            return false;
        }

        //Tant qu'il y a des entrées
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            //On crée une variable de la classe Advertisement
            $a = new Advertisement($row['idAdvertisement'], $row['title'], $row['description'], $row['organic'], $row['valid'], $row['creationDate'], $row['email']);
            //Et on l'ajoute dans le tableau qu'on retourne à la fin
            array_push($arr, $a);
        }

        return $arr;
    }

    /**
     * @brief Retourne l'annonce que l'on recherche par son identifiant
     * @param int idAd L'id de l'annonce que l'on recherche.
     * @return [Advertisement] L'annonce de type "Advertisement".
     * 		    False Une erreur est survenue.
     *          Null  L'annonce n'est pas trouvée.
     */
    public static function GetAdById($idAd)
    {
        $a = null;

        //Initialisation de la requête
        $req = 'SELECT idAdvertisement, title, description, organic, valid, creationDate, email FROM advertisements WHERE idAdvertisement = :idAd';
        $statement = Database::prepare($req);

        try {
            $statement->execute(array(':idAd' => $idAd));
        } catch (PDOException $e) {
            echo 'Problème de lecture de la base de données: ' . $e->getMessage();
            return false;
        }

        //On récupère le premier élément
        if ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
            $a = new Advertisement($row['idAdvertisement'], $row['title'], $row['description'], $row['organic'], $row['valid'], $row['creationDate'], $row['email']);
        }

        return $a;
    }

    /**
     * @brief Retourne l'annonce que l'on recherche par l'identifiant de son annonceur
     * @param string email L'email de l'annonceur.
     * @return array Un tableau contenant toutes les annonces de type "Advertisement".
     * 		   False Une erreur est survenue.
     */
    public static function GetAdsByUserEmail($email)
    {
        $arr = array();

        //Initialisation de la requête
        $req = 'SELECT idAdvertisement, title, description, organic, valid, creationDate, email FROM advertisements WHERE email = :e';
        $statement = Database::prepare($req);

        try {
            $statement->execute(array(':e' => $email));
        } catch (PDOException $e) {
            echo 'Problème de lecture de la base de données: ' . $e->getMessage();
            return false;
        }

        // Tant qu'il y a des entrées
        while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
            $a = new Advertisement($row['idAdvertisement'], $row['title'], $row['description'], $row['organic'], $row['valid'], $row['creationDate'], $row['email']);

            array_push($arr, $a);
        }

        return $arr;
    }

    /**
     * @brief Ajout d'une annonce
     * @param [Advertisement] L'objet "Advertisement" qu'on veut insérer dans la base.
     * @return boolean True  Ok.
     * 				   False Une erreur est survenue.
     */
    public static function CreateAd($a)
    {
        //Initialisation de la requête
        $req = 'INSERT INTO advertisements (title, description, organic, valid, email) VALUES (:t, :d, :o, 0, :e)';
        $statement = Database::prepare($req);

        try {
            $statement->execute(array(
                ':t' => $a->title,
                ':d' => $a->description,
                ':o' => $a->organic,
                ':e' => $a->userEmail
            ));
        } catch (PDOException $e) {
            echo 'Problème de lecture de la base de données: ' . $e->getMessage();
            return false;
        }

        return true;
    }

    /**
     * @brief Modification d'une annonce
     * @param [Advertisement] L'objet "Advertisement" qu'on veut modifier dans la base.
     * @return boolean True  Ok.
     * 				   False Une erreur est survenue.
     */
    public static function UpdateAd($a)
    {
        //Initialisation de la requête
        $req = 'UPDATE advertisements SET title = :t, description = :d, organic = :o';
        $statement = Database::prepare($req);

        try {
            $statement->execute(array(
                ':t' => $a->title,
                ':d' => $a->description,
                ':o' => $a->organic
            ));
        } catch (PDOException $e) {
            echo 'Problème de lecture de la base de données: ' . $e->getMessage();
            return false;
        }

        return true;
    }

    /**
     * @brief Validation d'une annonce
     * @param int idAd L'id de l'annonce que l'on veut validée.
     * @return boolean True  Ok.
     * 				   False Une erreur est survenue.
     */
    public static function UpdateAdToValid($idAd)
    {
        //Initialisation de la requête
        $req = 'UPDATE advertisements SET valid = :v WHERE idAdvertisement = :idAd';
        $statement = Database::prepare($req);

        try {
            $statement->execute(array(
                ':v' => 1,
                ':idAd' => $idAd
            ));
        } catch (PDOException $e) {
            echo 'Problème de lecture de la base de données: ' . $e->getMessage();
            return false;
        }

        return true;
    }

    /**
     * @brief Suppression d'une annonce
     * @param int idAd L'id de l'annonce qu'on veut supprimer.
     * @return boolean True  Ok.
     * 				   False Une erreur est survenue.
     */
    public static function DeleteAd($idAd)
    {
        //Initialisation de la requête
        $req = 'DELETE FROM advertisements WHERE idAdvertisement = :idAd';
        $statement = Database::prepare($req);

        try {
            $statement->execute(array(':idAd' => $idAd));
        } catch (PDOException $e) {
            echo 'Problème de lecture de la base de données: ' . $e->getMessage();
            return false;
        }

        return true;
    }
}
