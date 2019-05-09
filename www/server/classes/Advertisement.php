<?php

/* Titre : Classe "Advertisement"
 * Date : Jeudi, 09.05.2019
 * Auteurs : Romain Peretti
 * Version : 1.0
 * Description : Création de la classe "Advertisement" et initialisation des principaux champs de cette classe
 */

class Advertisement
{

    /**
     * @brief	Le Constructor appelé au moment de la création de l'objet. Ie. new Advertisement();
     * @param InIdAdvertisement		L'id de l'annonce. Defaut ""
     * @param InTitle	    Le Titre de l'annonce. Defaut ""
     * @param InDescription	    La description de l'annonce. Defaut ""
     * @param InOrganic	    Un boolean définissant si l'annonce est organique ou non. Defaut ""
     * @param InValid	    Un boolean définissant si l'annonce est validé par l'admin. Defaut ""
     * @param InCreationDate    La date de création de l'annonce. Defaut ""
     * @param InUserEmail	    L'email de l'utilisateur auquel l'annonce est assigné. Defaut ""
	  */
    public function __construct($InIdAdvertisement = "", $InTitle = "", $InDescription = "", $InOrganic = "", $InValid = "", $InCreationDate = "", $InUserEmail = "")
    { 
        $this->idAdvertisement = $InIdAdvertisement;
        $this->title = $InTitle;
        $this->description = $InDescription;
        $this->organic = $InOrganic;
        $this->valid = $InValid;
        $this->creationDate = $InCreationDate;
        $this->userEmail = $InUserEmail;
    }

    /** @var int L'id de l'annonce */
    public $idAdvertisement;

    /** @var string Le titre de l'annonce*/
    public $title;

    /** @var string La description de l'annonce*/
    public $description;

    /** @var bool Si l'annonce est organique ou pas*/
    public $organic;

    /** @var bool Si l'annonce est toujours valide*/
    public $valid;

    /** @var string La date de création de l'annonce*/
    public $creationDate;

    /** @var int L'email de l'utilisateur ayant créé l'annonce*/
    public $userEmail;
}
