<?php

/* Titre : Classe "User"
 * Date : Jeudi, 09.05.2019
 * Auteurs : Romain Peretti
 * Version : 1.0
 * Description : Création de la classe "User" et initialisation des principaux champs de cette classe
 */

/**
 * @brief   Objet User
 * @remark  Cet objet est utilisé comme conteneur en référence avec la table "users"
 * 
 *          Exemple d'utilisation 1
 *          $u = new User();
 *          $u->email = "romain.prtt@eduge.ch";
 *          $u->password = SHA1("1234");
 *          $u->city = "Genève";
 *          $u->canton = "Genève";
 *          $u->postCode = "1232";
 *          $u->streetAndNumber = "Joseph-Berthet 14";
 *          $u->description = "J'aime la photographie";
 *          $u->salt = "aocnNfNfgoitrosOAInrERXccpvw$w";
 *          $u->roles_code = 1;
 * 
 * 
 *          Exemple d'utilisation 2
 *          $u = new User("romain.prtt@eduge.ch", SHA1("1234"), "Genève", "Genève", "1232", "Joseph-Berthet 14", "J'aime la photographie", "aocnNfNfgoitrosOAInrERXccpvw$w", 1);
 */
class User
{

    /**
     * @brief	Le Constructor appelé au moment de la création de l'objet. Ie. new User();
     * @param InEmail	L'email de l'utilisateur. Defaut ""
     * @param InPassword		Le mot de passe de l'utilisateur. Defaut ""
     * @param InCity	    La ville de l'utilisateur. Defaut ""
     * @param InCanton	    Le canton de l'utilisateur. Defaut ""
     * @param InPostCode	    Le code postal de l'utilisateur. Defaut ""
     * @param InStreetAndNumber	    Le numéro et le nom de la rue de l'utilisateur. Defaut ""
     * @param InDescription	    La description de l'utilisateur. Defaut ""
     * @param InSalt	    Le salt du mot de passe de l'utilisateur. Defaut ""
     * @param InRoleCode	    Le code du rôle de l'utilisateur. Defaut ""
	  */
    public function __construct($InEmail = "", $InPassword = "", $InCity = "", $InCanton = "", $InPostCode = "", $InStreetAndNumber = "", $InDescription = "", $InSalt = "", $InRoleCode = "")
    {
        $this->email = $InEmail;
        $this->password = $InPassword;
        $this->city = $InCity;
        $this->canton = $InCanton;
        $this->postCode = $InPostCode;
        $this->streetAndNumber = $InStreetAndNumber;
        $this->description = $InDescription;
        $this->salt = $InSalt;
        $this->roleCode = $InRoleCode;
    }

    /** @var string L'email de l'utilisateur */
    public $email;

    /** @var string Le mot de passe encrypté de l'utilisateur */
    public $password;

    /** @var string La ville de l'utilisateur */
    public $city;

    /** @var string Le canton de l'utilisateur */
    public $canton;

    /** @var string Le code postal de l'utilisateur */
    public $postCode;

    /** @var string La rue et le numéro de l'utilisateur */
    public $streetAndNumber;

    /** @var string La description de l'utilisateur */
    public $description;

    /** @var string Le hash utilisé pour le mdp de l'utilisateur */
    public $salt;

    /** @var int Code du role de l'utilisateur */
    public $roleCode;
}
