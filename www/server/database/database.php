<?php
/*
Auteur : M. Aigroz
Date : 3 avril 2019
*/


require_once 'config.php';

/**
 * Retourne un objet PDO connecté à la base de données
 * @return \PDO
 */
class Database
{

    private static $pdoInstance;

    /**
     * @brief   Class Constructor - Créer une nouvelle connexion à la database si la connexion n'existe pas
     *          On la met en privé pour que personne puisse créer une nouvelle instance via ' = new Database();'
     */
    private function __construct()
    { }

    /**
     * @brief   Comme le constructeur, on rend __clone privé pour que personne ne puisse cloner l'instance
     */
    private function __clone()
    { }

    /**
     * @brief   Retourne l'instance de la Database ou créer une connexion initiale
     * @return $objInstance;
     */
    public static function getInstance()
    {
        if (self::$pdoInstance == null) {
            try {
                $dsn = DB_TYPE . ':host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME . ';charset=utf8;';
                self::$pdoInstance = new PDO($dsn, DB_USER, DB_PASSWORD, null);
                self::$pdoInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "EDatabase Error: " . $e->getMessage();
            }
        }
        return self::$pdoInstance;
    }

    # end method
    /**
     * @brief   Passes on any static calls to this class onto the singleton PDO instance
     * @param   $chrMethod      The method to call
     * @param   $arrArguments   The method's parameters
     * @return  $mix            The method's return value
     */

    final public static function __callStatic($chrMethod, $arrArguments)
    {
        $pdo = self::getInstance();
        return call_user_func_array(array($pdo, $chrMethod), $arrArguments);
    }

    # end method
}
 