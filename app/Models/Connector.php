<?php 
namespace App\Models;

use \PDO;

/**
 * Class Connector
 * Connection to the database
 *
 * @package App\Models
 */
class Connector extends PDO 
{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $name = "dev";
	
    /**
     * Class constructor
     */
	public function __construct() 
    {
        try 
        {
            $dsn = "mysql:host=". $this->host .";dbname=". $this->name .";charset=utf8";
            parent::__construct($dsn, $this->username, $this->password);
        } 
        catch (PDOException $error) 
        {
            echo "Erreur de connexion à la base de données : " . $error->getMessage();
        }
	}

}
