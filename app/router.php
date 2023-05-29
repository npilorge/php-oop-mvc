<?php
namespace App;

use App\Controllers\DashboardController;

/**
 * Class Router
 * Register and match routes
 *
 * @package App
 */
class Router
{
    /**
     * All project routes
     *
     * @var array
     */
	private $routes;

    /**
     * Register the project routes
     *
     * @param string $method The request method to access the page
     * @param string $path The request URI to access the page
     * @param string $controller The controller called
     * @param string $action The controller action called
     */
    public function addRoute($method, $path, $controller, $action)
    {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'controller' => $controller,
            'action' => $action
        ];
    }

    /**
     * Match the project routes with controllers
     */
    public function route()
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestUri = $_SERVER['REQUEST_URI'];

        try
        {
            foreach ($this->routes as $route) {
                if ($route['method'] === $requestMethod && preg_match($route['path'], $requestUri, $matches)) {

                    $class = "App\Controllers\\".$route['controller'];
                    $controller = new $class;
                    $action = $route['action'];

                    // Extract parameters from the URL
                    $params = array_slice($matches, 1);

                    // Call the controller method with the parameters
                    call_user_func_array([$controller, $action], $params);
                    return;
                }
            }
        }
        catch(Exception $error)
        {
            // No matching route found
            echo "404 Not Found :" . $error->getMessage();
        }
    }
}