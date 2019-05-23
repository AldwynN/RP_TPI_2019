<?php

/* Titre : Classe "Advertisement"
 * Date : Jeudi, 09.05.2019
 * Auteurs : Romain Peretti
 * Version : 1.0
 * Description : Création de la classe "Advertisement" et initialisation des principaux champs de cette classe
 */

/**
 * @brief   Objet Advertisement
 * @remark  Cet objet est utilisé comme conteneur en référence avec la table "advertisements"
 * 
 *          Exemple d'utilisation 1
 *          $a = new Advertisement();
 *          $a->idAdvertisement = null;
 *          $a->title = "Farine de blé";
 *          $a->description = "Farine de blé complet";
 *          $a->organic = true;
 *          $a->valid = true;
 *          $a->creationDate = "2019-05-13 10:00:00";
 *          $a->userEmail = "romain.prtt@eduge.ch";
 * 
 * 
 *          Exemple d'utilisation 2
 *          $a = new Advertisement(null, "Farine de blé", "Farine de blé complet", true, true, "2019-05-13 10:00:00", "romain.prtt@eduge.ch");
 */
class Advertisement
{

    /**
     * @brief	Le Constructor appelé au moment de la création de l'objet. Ie. new Advertisement();
     * @param InIdAdvertisement		L'id de l'annonce. Defaut null
     * @param InTitle	    Le Titre de l'annonce. Defaut ""
     * @param InDescription	    La description de l'annonce. Defaut ""
     * @param InOrganic	    Un bool définissant si l'annonce est organique ou non. Defaut ""
     * @param InValid	    Un bool définissant si l'annonce est validé par l'admin. Defaut null
     * @param InCreationDate    La date de création de l'annonce. Defaut null
     * @param InUserEmail	    L'email de l'utilisateur auquel l'annonce est assigné. Defaut ""
	  */
    public function __construct($InIdAdvertisement = null, $InTitle = "", $InDescription = "", $InOrganic = "", $InValid = null, $InCreationDate = null, $InUserEmail = "")
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
