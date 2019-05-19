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
        $req = 'SELECT idAdvertisement, title, description, organic, valid, creationDate, email FROM advertisements WHERE valid = 1 ORDER BY creationDate DESC';
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
        $req = 'SELECT idAdvertisement, title, description, organic, valid, creationDate, email FROM advertisements WHERE valid = 0 ORDER BY creationDate DESC';
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
        Database::beginTransaction();
        try {
            if ($statement->execute(array(
                ':t' => $a->title,
                ':d' => $a->description,
                ':o' => $a->organic,
                ':e' => $a->userEmail
            ))) {
                if ($_FILES['pictures']['error'][0] != 4) {
                    if (PictureManager::CreatePicture(Database::lastInsertId()) == false) {
                        Database::rollBack();
                        return false;
                    }
                }
                Database::commit();
                return true;
            }
        } catch (PDOException $e) {
            Database::rollBack();
            echo 'Problème lors de la création en base : ' . $e->getMessage();
        }

        return false;
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
        $req = 'UPDATE advertisements SET title = :t, description = :d, organic = :o WHERE idAdvertisement = :id';
        $statement = Database::prepare($req);
        Database::beginTransaction();
        try {
            if ($statement->execute(array(
                ':t' => $a->title,
                ':d' => $a->description,
                ':o' => $a->organic,
                ':id' => $a->idAdvertisement
            ))) {
                //Si des images sont séléctionner
                if ($_FILES['pictures']['error'][0] != 4) {
                    if (PictureManager::CreatePicture($a->idAdvertisement) == false) {
                        Database::rollBack();
                        return false;
                    }
                }
                Database::commit();
                return true;
            }
        } catch (PDOException $e) {
            Database::rollBack();
            echo 'Problème lors de la modification en base : ' . $e->getMessage();
        }
        return false;
    }

    /**
     * @brief Valide une annonce
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

        // Suppression des images liées avec cette annonce
        if (PictureManager::DeletePicturesOfAnAd($idAd) == false) {
            return false;
        }

        // Suppression des évalutations liées avec cette annonce
        if(RatingManager::DeleteRatingsOfAnAd($idAd) == false){
            return false;
        }

        try {
            $statement->execute(array(':idAd' => $idAd));
        } catch (PDOException $e) {
            echo 'Problème de lecture de la base de données: ' . $e->getMessage();
            return false;
        }

        return true;
    }

    /**
     * @brief Suppression de toutes les annonces d'un utilisateur
     * @param string email L'email de l'utilisateur.
     * @return boolean True  Ok.
     * 				   False Une erreur est survenue.
     */
    public static function DeleteAdsOfUser($email)
    {
        $ads = AdvertisementManager::GetAdsByUserEmail($email);

        foreach ($ads as $ad) {
            if (AdvertisementManager::DeleteAd($ad->idAdvertisement) == false) {
                return false;
            }
        }
        return true;
    }



    /**
     * @brief Retourne les annonces en rapport avec la recherche
     * @param string searchContent La recherche de l'utilisateur.
     * @param boolean organic Si l'utilisateur recherche que des annonces bio.
     * @return array Un tableau contenant toutes les annonces de type "Advertisement".
     * 		   False Une erreur est survenue.
     */
    public static function Research($searchContent, $organic)
    {
        $arr = array();

        $baseReq = "SELECT DISTINCT a.idAdvertisement, a.title, a.description, a.organic, a.valid, a.creationDate, a.email FROM users AS u, advertisements AS a WHERE ";

        $withContent = "u.email = a.email AND u.city LIKE :s OR u.canton LIKE :s OR u.postCode LIKE :s OR a.title LIKE :s OR a.description LIKE :s OR
        :sc = ( SELECT FORMAT(AVG(r.rating), 'N') FROM rates AS r WHERE r.idAdvertisement = a.idAdvertisement) ";

        $withOrganic = "AND a.organic = 1";

        $onlyOrganic = "a.organic = 1";

        $finalReq = "";

        if ($searchContent != "" && $organic) {
            $finalReq .= $baseReq . $withContent . $withOrganic;
        } else if ($searchContent != "" && !$organic) {
            $finalReq .= $baseReq . $withContent;
        } else if ($searchContent == "" && $organic) {
            $finalReq .= $baseReq . $onlyOrganic;
        } else {
            return false;
        }

        $statement = Database::prepare($finalReq);

        try {
            $statement->execute(array(
                ':s' => '%' . $searchContent . '%',
                ':sc' => $searchContent
            ));
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
}
