<?php

/* Titre : Classe "Rating"
 * Date : Jeudi, 09.05.2019
 * Auteurs : Romain Peretti
 * Version : 1.0
 * Description : Création de la classe "Rating" et initialisation des principaux champs de cette classe
 */

class Rating
{
    /**
     * @brief	Le Constructor appelé au moment de la création de l'objet. Ie. new Rating(); 
     * @param InUserEmail   L'email de l'utilisateur ayant mit un commentaire. Defaut ""
     * @param InIdAdvertisement	    L'id de l'annonce auquel le commentaire est assigné. Defaut ""
     * @param InRating		La note donné par l'utilisateur. Defaut ""
     * @param InComment     Le commentaire laisser sous le commentaire. Defaut ""
     * @param InPostDate    La date de création du commentaire. Defaut ""
	  */
    public function __construct($InUserEmail = "", $InIdAdvertisement = "", $InRating = "", $InComment = "", $InPostDate = "")
    {
        $this->rating = $InRating;
        $this->comment = $InComment;
        $this->postDate = $InPostDate;
        $this->userEmail = $InUserEmail;
        $this->idAdvertisement = $InIdAdvertisement;
    }

    /** @var string L'email de l'utilisateur */
    public $userEmail;

    /** @var int L'id de l'annonce */
    public $idAdvertisement;

    /** @var int La note donné par l'utilisateur */
    public $rating;

    /** @var string Le commentaire de l'utilisateur */
    public $comment;

    /** @var int La date de création du commentaire */
    public $postDate;
}
