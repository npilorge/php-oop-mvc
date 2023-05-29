<?php
namespace App\Controllers;

use App\Models\CarModel;

/**
 * Class DashboardController
 * Process cars data
 *
 * @package App\Controllers
 */
class DashboardController
{
    /**
     * CarModel instance
     *
     * @var CarModel
     */
    private $carModel;

    /**
     * Class constructor
     */
    public function __construct() 
    {
        $this->carModel = new CarModel();
    }

    /**
     * Displays the index
     */
    public function index()
    {
        require_once __DIR__ . "/../Views/IndexView.php";
    }

    /**
     * Displays all cars
     */
    public function showAll() {
        $html = '';

        // Generates the display of each car
        foreach ($this->getAll() as $car)
        {
            $reserve = $car['reserve'] == 1 ? 'Oui':'Non';

            $html .= '<tr>';
            $html .= '<td>' . $car['marque'] . '</td>';
            $html .= '<td>' . $car['modele'] . '</td>';
            $html .= '<td>' . $car['immatriculation'] . '</td>';
            $html .= '<td>' . $car['carburant'] . '</td>';
            $html .= '<td>' . $car['prix'] . '€</td>';
            $html .= '<td>' . $car['type_vente'] . '</td>';
            $html .= '<td>' . $reserve . '</td>';
            $html .= '<td><button class="btn btn-secondary edit-button" data-car-id="' . $car['id'] . '">Modifier</button></td>';
            $html .= '<td><button class="btn btn-danger delete-button" data-car-id="' . $car['id'] . '">Supprimer</button></td>';
            $html .= '</tr>';
        }

        echo $html;
    }

    /**
     * Get all cars
     *
     * @return array[] The associative arrays representing all the cars
     */
    public function getAll()
    {
        // Call the modal function
        return $this->carModel->getAll();
    }

    /**
     * Get a car
     */
    public function getByID()
    {
        // Call the modal function
        echo json_encode( $this->carModel->getByID($_POST['carId']) );
    }

    /**
     * Create a car
     */
    public function create()
    {
        $data = [
            'id' => $_POST['car-id'],
            'marque' => $_POST['marque'],
            'modele' => $_POST['modele'],
            'immatriculation' => $_POST['immatriculation'],
            'carburant' => $_POST['carburant'],
            'prix' => $_POST['prix'],
            'type_vente' => $_POST['type-vente'],
            'reserve' => isset($_POST['reserve']) ? '1' : '0'
        ];

        // Call the modal function
        $this->carModel->create($data);
    }

    /**
     * Update a car
     */
    public function update()
    {
        $data = [
            'id' => $_POST['car-id'],
            'marque' => $_POST['marque'],
            'modele' => $_POST['modele'],
            'immatriculation' => $_POST['immatriculation'],
            'carburant' => $_POST['carburant'],
            'prix' => $_POST['prix'],
            'type_vente' => $_POST['type-vente'],
            'reserve' => isset($_POST['reserve']) ? "1" : "0"
        ];

        // Call the modal function
        $this->carModel->update($data);
    }

    /**
     * Delete a car
     */
    public function delete()
    {
        // Call the modal function
        $this->carModel->delete($_POST['carId']);
    }
}