<?php
/*
Titre : Manageur des commentaires et des notes
Date : 9 mai 2019
Auteur : Romain Peretti
Version : 1.0
Description : Cette classe contient toutes les fonctions en rapport avec les commentaires et les notes utilisées sur le site.
              Chaque fonctions envoie une requête SQL
*/

require_once '../database/database.php';
require_once '../classes/Rating.php';

class RatingManager
{
    /**
     * @brief Retourne toutes les commentaires et notes en rapport avec l'annonce spécifié
     * @param int idAd L'id de l'annonce qu'on recherche
     * @return array Un tableau contenant toutes les commentaires et notes de type "Rating".
     * 		   False Une erreur est survenue.
     */
    public static function GetRatingsOfAnAd($idAd)
    {
        $arr = array();

        //Initialisation de la requête
        $req = 'SELECT idRate, rating, comment, postDate, email, idAdvertisement FROM rates WHERE idAdvertisement = :idAd';
        $statement = Database::prepare($req);

        try {
            $statement->execute(array(':idAd' => $idAd));
        } catch (PDOException $e) {
            echo 'Problème de lecture de la base de données: ' . $e->getMessage();
            return false;
        }

        //Tant qu'il y a des entrées
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            //On crée une variable de la classe Rating
            $r = new Rating(null, $row['rating'], $row['comment'], $row['postDate'], $row['email'], $row['idAdvertisement']);
            //Et on l'ajoute dans le tableau qu'on retourne à la fin
            array_push($arr, $r);
        }

        return $arr;
    }

    /**
     * @brief Retourne le score donné par tous les commentaires des utilisateurs
     * @param int idAd L'id de l'annonce qu'on recherche
     * @return float Un nombre avec un chiffre derrière la virgule étant la moyenne de tous les commentaires.
     * 		   False Une erreur est survenue.
     */
    public static function GetScoreOfAnAd($idAd)
    {
        $score = 0;

        //Initialisation de la requête
        $req = 'SELECT AVG(rating) AS score FROM rates WHERE idAdvertisement = :idAd';
        $statement = Database::prepare($req);

        try {
            $statement->execute(array(':idAd' => $idAd));
        } catch (PDOException $e) {
            echo 'Problème de lecture de la base de données: ' . $e->getMessage();
            return false;
        }

        if ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
            // On garde qu'une décimal
            $score = number_format($row['score'], 0);
        }

        return $score;
    }

    /**
     * @brief Ajout d'un commentaire et d'une note
     * @param [Rating] Le commentaire et la note de type "Rating"
     * @return boolean True Ok.
     * 		           False Une erreur est survenue.
     */
    public static function CreateRating($r)
    {
        //Initialisation de la requête
        $req = 'INSERT INTO rates (rating, comment, email, idAdvertisement) VALUES (:r, :c, :e, :idAd)';
        $statement = Database::prepare($req);

        try {
            $statement->execute(array(
                ':e' => $r->userEmail,
                ':idAd' => $r->idAdvertisement,
                ':r' => $r->rating,
                ':c' => $r->comment
            ));
        } catch (PDOException $e) {
            echo 'Problème de création : ' . $e->getMessage();
            return false;
        }

        return true;
    }

    /**
     * @brief Suppression de toutes les évaluations d'une annonce
     * @param int idAd L'id de l'annonce.
     * @return boolean True Ok.
     * 		           False Une erreur est survenue.
     */
    public static function DeleteRatingsOfAnAd($idAd)
    {
        //Initialisation de la requête
        $req = 'DELETE FROM rates WHERE idAdvertisement = :id';
        $statement = Database::prepare($req);
        try {
            $statement->execute(array(':id' => $idAd));
        } catch (PDOException $e) {
            echo 'Problème de suppression : ' . $e->getMessage();
            return false;
        }
        return true;
    }

    /**
     * @brief Suppression de toutes les évaluations d'un utilisateur
     * @param string email L'email de l'utilisateur.
     * @return boolean True Ok.
     * 		           False Une erreur est survenue.
     */
    public static function DeleteRatingsOfUser($email)
    {
        //Initialisation de la requête
        $req = 'DELETE FROM rates WHERE email = :e';
        $statement = Database::prepare($req);

        try {
            $statement->execute(array(':e' => $email));
        } catch (PDOException $e) {
            echo 'Problème de suppression : ' . $e->getMessage();
            return false;
        }

        return true;
    }
}
