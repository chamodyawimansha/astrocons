<?php
/**
 * Parent controller file
 * php version 7.4.2
 *
 * @category Core_Class
 * @package  SimplePHP
 * @author   Chamodya Wimansha <chamodyawimansha@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU Gene
 * @link     https://github.com/chamodyawimansha/SimplePHP
 */

namespace Framework\Core;

/**
 * Controller Class - Parent class of the Controller classes
 * php version 7.4.2
 *
 * @category Core_Class
 * @package  SimplePHP
 * @author   Chamodya Wimansha <chamodyawimansha@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU Gene
 * @link     https://github.com/chamodyawimansha/SimplePHP
 */
class Controller
{

    /**
     * Returns a Model class
     *
     * @param String $model - name of the Model class
     *
     * @return Model
     */
    protected function model(String $model)
    {
        if (\file_exists(MODEL_FOLDER . $model. ".php")) {
            $model = "\App\Models\\" . $model;
            
            if (\class_exists($model)) {
                return new $model;
            }
        }
        // Log the error
        \error_log($model . " - model Not Found");
        // send error to the user
        \header(
            $_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error',
            true,
            500
        );
        die("");
    }

    /**
     * View a Model class
     *
     * @param String $view - name of the View Class
     * @param Array  $data - data to show in the view file
     *
     * @return View
     */
    protected function view(String $view, $data = [])
    {
        if (\file_exists(VIEW_FOLDER . $view. ".view.php")) {
            $viewData = $data;
         
            return include VIEW_FOLDER . $view . ".view.php";
        }
        // Log the error
        \error_log($view . " - view Not Found");
        // send error to the user
        \header(
            $_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error',
            true,
            500
        );
        die("");
    }

    /**
     * Loads helper functions
     *
     * @param Array $helpers - Accepts array of helper file names.
     *
     * @return Array assoc array of helper functions
     */
    protected function helpers(array $helpers)
    {
        $funcs = [];

        foreach ($helpers as $func) {
            $file = strtolower($func);

            if (\file_exists(HELPERS_FOLDER . $file. '.php')) {
                $funcs[$func] = include HELPERS_FOLDER . $file . ".php";
            } else {
                // if function not found in the functions folder log the error
                \error_log($class . ' Library file missing');
            }
        }

        return $funcs;
    }

    /**
     * Redirect to controllers with data
     * 
     * @param $route  - controller/method
     * @param $params - data to send 
     * 
     * @return Controller
     */
    protected function redirect($route = "index/index", $params = [])
    {   
        if (!isset($_SESSION["params"])) {
            $_SESSION["params"] = [];
        }
        // save the data on the session with the key
        array_walk(
            $params, function ($value, $key) { 
                $_SESSION["params"][$key] = $value;
            }
        );

        return header("Location:/".$route);
    }

    /**
     *  Returns data from the session and release the data
     * 
     * @param $key - parameter key
     * 
     * @return Controller
     */
    protected function getParams($key)
    {   
        if (isset($_SESSION["params"][$key])) {
            $param = $_SESSION["params"][$key]; 
            // clears the data in session after retrieved.
            $_SESSION["params"][$key] = "";

            return $param;
        } 
        
        return [];
    }
}
