<?php

/* Titre : Classe "Picture"
 * Date : Lundi, 13.05.2019
 * Auteurs : Romain Peretti
 * Version : 1.0
 * Description : Création de la classe "Picture" et initialisation des principaux champs de cette classe
 */

class Picture
{
    /**
     * @brief	Le Constructor appelé au moment de la création de l'objet. Ie. new Rating(); 
     * @param InIdPicture	L'id de l'image. Defaut ""
     * @param InPicture		L'image. Defaut ""
     * @param InIdAdvertisement    L'id de l'annonce auquel l'image est assignée. Defaut ""
	  */
    public function __construct($InIdPicture = "", $InPicture = "", $InIdAdvertisement = "")
    {
        $this->idPicture = $InIdPicture;
        $this->picture = $InPicture;
        $this->idAdvertisement = $InIdAdvertisement;
    }

    /** @var int L'id de l'image */
    public $idPicture;

    /** @var string L'image encodée en base 64 */
    public $picture;

    /** @var int L'id de l'annonce auquel est assignée l'image */
    public $idAdvertisement;
}
