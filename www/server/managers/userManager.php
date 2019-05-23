<?php
/*
Titre : Manageur des utilisateurs
Date : 9 mai 2019
Auteur : Romain Peretti
Version : 1.0
Description : Cette classe contient toutes les fonctions en rapport avec les utilisateur utilisées sur le site.
              Chaque fonctions envoie une requête SQL
*/

require_once '../database/database.php';
require_once '../classes/User.php';
require_once '../managers/AdvertisementManager.php';

class UserManager
{

    /**
     * @brief Retourne un utilisateur en fonction de son email
     * @param string email L'email de l'utilisateur qu'on recherche.
     * @return [User] L'utilisateur de type User.
     *          False Une erreur est survenue.
     *          Null  L'utilisateur n'est pas trouvé.
     */
    public static function GetUserByEmail($email)
    {
        $u = null;

        //Initialisation de la requête
        $req = 'SELECT email, password, city, canton, postCode, streetAndNumber, description, salt, roleCode FROM users WHERE email = :e';
        $statement = Database::prepare($req);

        try {
            $statement->execute(array(':e' => $email));
        } catch (PDOException $e) {
            return false;
        }

        //On récupère le premier élément
        if ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
            $u = new User($row['email'], $row['password'], $row['city'], $row['canton'], $row['postCode'], $row['streetAndNumber'], $row['description'], $row['salt'], $row['roleCode']);
        }

        return $u;
    }

    /**
     * @brief Retourne tous les utilisateurs (non admin)
     * @return array Un tableau contenant tous les utilisateurs de type "User"
     *          False Une erreur est survenue.
     */
    public static function GetUsers()
    {
        $arr = array();

        //Initialisation de la requête
        $req = 'SELECT email, password, city, canton, postCode, streetAndNumber, description, salt, roleCode FROM users';
        $statement = Database::prepare($req);

        try {
            $statement->execute();
        } catch (PDOException $e) {
            return false;
        }

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            //On crée une variable de la classe User
            $u = new User($row['email'], $row['password'], $row['city'], $row['canton'], $row['postCode'], $row['streetAndNumber'], $row['description'], $row['salt'], $row['roleCode']);
            //Et on l'ajoute dans le tableau qu'on retourne à la fin
            array_push($arr, $u);
        }

        return $arr;
    }

    /**
     * @brief Ajoute un utilisateur
     * @param [User] L'objet User que l'on veut insérer.
     * @return boolean True  Ok.
     *                 False Une erreur est survenue.
     *                 Null  L'utilisateur existe déjà.
     */
    public static function CreateUser($u)
    {
        //Vérification que l'email n'est pas déjà utilisé
        if (UserManager::UserExist($u->email)) {
            return null;
        }

        //Initialisation de la requête
        $req = 'INSERT INTO users (email, password, city, canton, postCode, streetAndNumber, description, salt, roleCode) VALUES (:e, :pwd, :ci, :ca, :po, :st, :d, :sa, :r)';
        $statement = Database::prepare($req);

        //Création d'un hash
        $salt = uniqid(mt_rand(), true);
        //Encryption du mot de passe et du hash en sha1
        $encryptedPassword = sha1($u->password . $salt);
        $roles = USER_CODE;

        try {
            $statement->execute(array(
                ':e' => $u->email,
                ':pwd' => $encryptedPassword,
                ':ci' => $u->city,
                ':ca' => $u->canton,
                ':po' => $u->postCode,
                ':st' => $u->streetAndNumber,
                ':d' => $u->description,
                ':sa' => $salt,
                ':r' => $roles
            ));
        } catch (PDOException $e) {
            return false;
        }

        return true;
    }

    /**
     * @brief Modifie un utilisateur
     * @param [User] L'objet User que l'on veut modifier.
     * @return boolean True  Ok.
     *                 False Une erreur est survenue.
     */
    public static function UpdateUser($u)
    {
        //Initialisation de la requête
        $req = 'UPDATE users SET password = :pwd, city = :ci, canton = :ca, postCode = :po, streetAndNumber = :st, description = :d, salt = :s WHERE email = :e';
        $statement = Database::prepare($req);

        //Création d'un nouveau hash
        $salt = uniqid(mt_rand(), true);
        //Encryption du mot de passe et du nouveau hash en sha1
        $encryptedPassword = sha1($u->password . $salt);

        try {
            $statement->execute(array(
                ':pwd' => $encryptedPassword,
                ':ci' => $u->city,
                ':ca' => $u->canton,
                ':po' => $u->postCode,
                ':st' => $u->streetAndNumber,
                ':d' => $u->description,
                ':s' => $salt,
                ':e' => $u->email
            ));
        } catch (PDOException $e) {
            return false;
        }

        return true;
    }

    /**
     * @brief Modifie un utilisateur en administrateur
     * @param string email L'email de l'utilisateur que l'on veut modifier.
     * @return boolean True  Ok.
     *                 False Une erreur est survenue.
     */
    public static function UpdateUserToAdmin($email)
    {
        //Initialisation de la requête
        $req = 'UPDATE users SET roleCode = ' . ADMINISTRATOR_CODE . ' WHERE email = :e';
        $statement = Database::prepare($req);

        try {
            $statement->execute(array(':e' => $email));
        } catch (PDOException $e) {
            return false;
        }

        return true;
    }

    /**
     * @brief Modifie un administrateur en utilisateur
     * @param string email L'email de l'utilisateur que l'on veut modifier.
     * @return boolean True  Ok.
     *                 False Une erreur est survenue.
     */
    public static function UpdateAdminToUser($email)
    { 
        //Initialisation de la requête
        $req = 'UPDATE users SET roleCode = ' . USER_CODE . ' WHERE email = :e';
        $statement = Database::prepare($req);

        try {
            $statement->execute(array(':e' => $email));
        } catch (PDOException $e) {
            return false;
        }

        return true;
    }

    /**
     * @brief Supprime un utilisateur en fonction de son email
     * @param string email L'email de l'utilisateur qu'on veut supprimer.
     * @return boolean True  Ok.
     *                 False Une erreur est survenue.
     */
    public static function DeleteUser($email)
    {
        //Initialisation de la requête
        $req = 'DELETE FROM users WHERE email = :e';
        $statement = Database::prepare($req);

        Database::beginTransaction();

        try {
            // Suppression des annonces et des évalutions de l'utilisateur
            if (AdvertisementManager::DeleteAdsOfUser($email) == false) {
                Database::rollBack();
                return false;
            }
            $statement->execute(array(':e' => $email));
            Database::commit();
            return true;
        } catch (PDOException $e) {
            Database::rollBack();
        }
        return false;
    }

    /**
     * @brief Vérifie si un utilisateur existe déjà avec l'email spécifié
     * @param string email L'email de l'utilisateur qu'on recherche.
     * @return boolean True  L'utilisateur existe.
     *                 False Une erreur est survenue.
     *                 Null  L'utilisateur n'existe pas.
     */
    public static function UserExist($email)
    {
        //Initialisation de la requête
        $req = 'SELECT * FROM users WHERE email = :e';
        $statement = Database::prepare($req);

        try {
            $statement->execute(array(':e' => $email));
        } catch (PDOException $e) {
            return false;
        }

        //On vérifie si la requête retourne quelque chose
        if (count($statement->fetchAll()) > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @brief Essaie de connecter l'utilisateur
     * @param string email L'email de l'utilisateur.
     * @param string password Le mot de passe de l'utilisateur.
     * @return boolean True  La connexion a réussie.
     *                 False Une erreur est survenue.
     *                 Null  L'utilisateur n'existe pas
     */
    public static function Login($email, $password)
    {
        // Vérification que l'email est utilisé
        if (!UserManager::UserExist($email)) {
            return null;
        }

        //Initialisation de la requête
        $req = 'SELECT password, salt FROM users WHERE email = :e';
        $statement = Database::prepare($req);

        try {
            $statement->execute(array(':e' => $email));
        } catch (PDOException $e) {
            return false;
        }

        if ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            //Vérification que le mot de passe entré correspond bien
            if (sha1($password . $row['salt']) == $row['password']) {
                return true;
            }
        }

        return false;
    }
}
