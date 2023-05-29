<?php
require_once __DIR__ . '/vendor/autoload.php';

use App\Router;

// Instance the router
$router = new Router();

// Add routes
$router->addRoute('GET', '#^/cars_dashboard/$#', 'DashboardController', 'index');
$router->addRoute('POST', '#^/cars_dashboard/showCars$#', 'DashboardController', 'showAll');
$router->addRoute('POST', '#^/cars_dashboard/getCar$#', 'DashboardController', 'getByID');
$router->addRoute('POST', '#^/cars_dashboard/createCar$#', 'DashboardController', 'create');
$router->addRoute('POST', '#^/cars_dashboard/updateCar$#', 'DashboardController', 'update');
$router->addRoute('POST', '#^/cars_dashboard/deleteCar$#', 'DashboardController', 'delete');

// Match the routes and controllers
$router->route();