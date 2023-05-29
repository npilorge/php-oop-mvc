<?php
namespace App\Models;

use App\Models\Connector;

/**
 * Class CarModel
 * Prepares car data
 *
 * @package App\Models
 */
class CarModel
{
    /**
     * Connector instance
     *
     * @var Connector
     */
    private $connexion;

    /**
     * Class constructor
     */
    public function __construct() 
    {
        $this->connexion = new Connector();
    }

    /**
     * Get all the car to the database
     * 
     * @return array[] The associative arrays representing all the cars
     */
    public function getAll()
    {
        try
        {
            // Prepare the request
            $statement = $this->connexion->prepare("SELECT * FROM voiture");

            // Executes the request
            $statement->execute();   

            return $statement->fetchAll();
        } 
        catch(PDOException $error) 
        {    
            // Display an error if the request fails
            echo "Erreur lors de la lecture de la base de données : " . $error->getMessage();
        }
    }

    /**
     * Get a car to the database
     *
     * @param int $id The id of the car
     * 
     * @return array[] The associative arrays representing the car
     */
    public function getByID($id)
    {
        try
        {
            // Prepare the request
            $statement = $this->connexion->prepare("SELECT * FROM Voiture WHERE id = ?");

            $statement->bindParam(1,$id);

            // Executes the request
            $statement->execute();

            return $statement->fetchAll();
        } 
        catch(PDOException $error)
        {
            // Display an error if the request fails
            echo "Erreur lors de la lecture de la base de données : " . $error->getMessage();
        }

    }	 

    /**
     * Add a car to the database
     *
     * @param array $data The data of the car
     */
    public function create($data)
    {
        try
        {
            // Prepare the request
            $statement = $this->connexion->prepare(
                "INSERT INTO Voiture (marque, modele, immatriculation, carburant, prix, type_vente, reserve) VALUES (?, ?, ?, ?, ?, ?, ?)" 
            );

            $statement->bindParam(1,$data['marque']);
            $statement->bindParam(2,$data['modele']);
            $statement->bindParam(3,$data['immatriculation']);
            $statement->bindParam(4,$data['carburant']);
            $statement->bindParam(5,$data['prix']);
            $statement->bindParam(6,$data['type_vente']);
            $statement->bindParam(7,$data['reserve']);

            // Executes the request
            $statement->execute();
        } 
        catch(PDOException $error) 
        {
            // Display an error if the request fails
            echo "Erreur lors de l'ajout à la base de données : " . $error->getMessage();
        }
    }

    /**
     * Update a car to the database
     *
     * @param array $data The data of the car
     */
    public function update($data)
    {
        try
        {
            // Prepare the request
            $statement = $this->connexion->prepare(
                "UPDATE Voiture SET marque = ?, modele = ?, immatriculation = ?, carburant = ?, prix = ?, type_vente = ?, reserve = ? 
                WHERE id = ?" 
            );

            $statement->bindParam(1,$data['marque']);
            $statement->bindParam(2,$data['modele']);
            $statement->bindParam(3,$data['immatriculation']);
            $statement->bindParam(4,$data['carburant']);
            $statement->bindParam(5,$data['prix']);
            $statement->bindParam(6,$data['type_vente']);
            $statement->bindParam(7,$data['reserve']);
            $statement->bindParam(8,$data['id']);

            // Executes the request
            $statement->execute();    
        } 
        catch(PDOException $error) 
        {
            // Display an error if the request fails
            echo "Erreur lors de mise à jour de la base de données : " . $error->getMessage();
        }
    }

    /**
     * Delete a car to the database
     *
     * @param int $id The id of the car
     */
    public function delete($id)
    {
        try
        {
            // Prepare the request
            $statement = $this->connexion->prepare("DELETE FROM Voiture WHERE id = ?");

            $statement->bindParam(1,$id);

            // Executes the request
            $statement->execute();
        } 
        catch(PDOException $error)
        {
            // Display an error if the request fails
            echo "Erreur lors de la suppression de la base de données : " . $error->getMessage();
        }
    }

}