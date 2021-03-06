<?php

/* Titre : Classe "Rating"
 * Date : Jeudi, 09.05.2019
 * Auteurs : Romain Peretti
 * Version : 1.0
 * Description : Création de la classe "Rating" et initialisation des principaux champs de cette classe
 */

/**
 * @brief   Objet Rating
 * @remark  Cet objet est utilisé comme conteneur en référence avec la table "rates"
 * 
 *          Exemple d'utilisation 1
 *          $r = new Rating();
 *          $r->idRate = null;
 *          $r->rating = 4;
 *          $r->comment = "Ce blé est vraiment idéal pour faire du pain";
 *          $r->postDate = "2019-05-13 10:00:00";
 *          $r->userEmail = "romain.prtt@eduge.ch";
 *          $r->idAdvertisement = 1;
 * 
 * 
 *          Exemple d'utilisation 2
 *          $r = new Rating(null, 4, "Ce blé est vraiment idéal pour faire du pain", "2019-05-13 10:00:00", "romain.prtt@eduge.ch", 1);
 */
class Rating
{
    /**
     * @brief	Le Constructor appelé au moment de la création de l'objet. Ie. new Rating(); 
     * @param InIdRate  L'id de l'évaluation. Default null
     * @param InRating		La note donné par l'utilisateur. Defaut ""
     * @param InComment     Le commentaire. Defaut ""
     * @param InPostDate    La date de création de l'évaluation. Defaut ""
     * @param InUserEmail   L'email de l'utilisateur ayant mis un commentaire. Defaut ""
     * @param InIdAdvertisement	   L'id de l'annonce auquel l’évaluation est assignée. Defaut ""
	  */
    public function __construct($InIdRate = null, $InRating = "", $InComment = "", $InPostDate = "", $InUserEmail = "", $InIdAdvertisement = "")
    {
        $this->idRate = $InIdRate;
        $this->rating = $InRating;
        $this->comment = $InComment;
        $this->postDate = $InPostDate;
        $this->userEmail = $InUserEmail;
        $this->idAdvertisement = $InIdAdvertisement;
    }

    /** @var int L'id de l'évaluation */
    public $idRate;

    /** @var int La note donné par l'utilisateur */
    public $rating;

    /** @var string Le commentaire de l'utilisateur */
    public $comment;

    /** @var int La date de création du commentaire */
    public $postDate;

    /** @var string L'email de l'utilisateur */
    public $userEmail;

    /** @var int L'id de l'annonce */
    public $idAdvertisement;
}
