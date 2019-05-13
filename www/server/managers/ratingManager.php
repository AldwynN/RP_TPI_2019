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
        $req = 'SELECT email, idAdvertisement, rating, comment, postDate FROM rates WHERE idAdvertisement = :idAd';
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
            $r = new Rating($row['email'], $row['idAdvertisement'], $row['rating'], $row['comment'], $row['postDate']);
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
            $score = $row['score'];
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
        $req = 'INSERT INTO rates (email, idAdvertisement, rating, comment) VALUES (:e, :idAd, :r, :c)';
        $statement = Database::prepare($req);

        try {
            $statement->execute(array(
                ':e' => $r->userEmail,
                ':idAd' => $r->idAdvertisement,
                ':r' => $r->rating,
                ':c' => $r->comment
            ));
        } catch (PDOException $e) {
            echo 'Problème de lecture de la base de données: ' . $e->getMessage();
            return false;
        }

        return true;
    }
}
